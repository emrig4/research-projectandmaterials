<?php
namespace Modules\Ebook\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Ebook\Traits\BookPurchasedTrait;
use Paystack;

//use the Rave Facade
use Rave;

class PaystackController extends Controller
{

   /**
   * Redirect the User to Paystack Payment Page
   * @return Url
   */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return redirect()->back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
      $paymentDetails = Paystack::getPaymentData();
      if($paymentDetails['status'] == 'true'){
        $paymentData = $paymentDetails['data'];
        $paymentStatus = $paymentDetails['status'];
        $paymentMeta = $paymentData['metadata'];
        $verifiedChargeAmount = $paymentData['amount'];
        $verifiedChargeCurrency = $paymentData['currency'];


        $txMeta = [];
        foreach ($paymentMeta as $value) {
            $txMeta[ $value['metaname'] ] = $value['metavalue'];
        }

        $purchasedEbookData = [
          'ebook_id' => $txMeta['ebook_id'],
          'customer_id' => '',
          'transaction_id' => '', // local reference
          'is_delivered' => 0,
        ];

        $userId = isset($txMeta['user_id']) ? $txMeta['user_id'] : null;

        $customerData = [
          'customer_type' => $txMeta['customer_type'],
          'user_id' => $userId,
          'paystack_account_id' =>$paymentData['customer']['id'],
          'phone' => $paymentData['customer']['phone'],
          'email' => $paymentData['customer']['email'],
          'name' =>  $paymentData['customer']['first_name'],
        ];

        $transactionData = [
          'status' => $paymentStatus,
          'reference_id' => $paymentData['reference'],
          'payment_type' => '',
          'payment_aggregator' => 'paystack',
          'amount' => ($paymentData['amount']/100),
          'transaction_payload' => json_encode($paymentDetails),
          'transaction_meta' => json_encode($txMeta),
          'customer_id' => '', // references local instance
        ];

       
        $customer = BookPurchasedTrait::storeCustomer($customerData);
        $transactionData['customer_id'] = $customer->id;
        $transaction = BookPurchasedTrait::storeTransaction($transactionData);

        $purchasedEbookData['transaction_id'] = $transaction->id;
        $purchasedEbookData['customer_id'] = $customer->id;
        $purchasedEbook = BookPurchasedTrait::storePurchasedEbook($purchasedEbookData);

        // current customer info  to session
        request()->session()->put('customer', $customerData);

        // send id of purchased ebook to successful page, 
        // return redirect()->route('ebooks.purchased', ['id'=> id_encode($txMeta['ebook_id']) ]); //->with($custmerData);
        return redirect()->action([\Modules\Ebook\Http\Controllers\EbookController::class, 'deliverFile'], [ 'id'=>id_encode($txMeta['ebook_id']) ]);
    

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
      } else{
        return 'An error occured';
      }
    }

}


 // $responsePayload =  json_decode( request()->resp);
  // $tx = $responsePayload->tx; // or $responseObject->data->data
  // $txRef = $tx->txRef; // transaction reference from initial
  // $txStatus = $tx->status;
  // $txChargeAmount = $tx->amount; //amount from initial response
  // $txCurrency = $tx->currency; // currency from initial response

  // $verifiedTx = Rave::verifyTransaction($txRef);
  // if($verifiedTx){
  //     $verifiedTxchargeResponsecode = $verifiedTx->data->chargecode;
  //     $verifiedTxchargeMessage = $verifiedTx->data->chargemessage;
  //     $verifiedTxChargeAmount = $verifiedTx->data->amount;
  //     $verifiedTxChargeCurrency = $verifiedTx->data->currency;
  //     $verifiedMeta = $verifiedTx->data->meta;

  //     $txMeta = [];
  //     foreach ($verifiedMeta as $value) {
  //         $txMeta[$value->metaname] = $value->metavalue;
  //     }


  //     $purchasedEbookData = [
  //       'ebook_id' => $txMeta['ebook_id'],
  //       'customer_id' => '',
  //       'transaction_id' => '', // local reference
  //       'is_delivered' => 0,
  //     ];

  //     // if(isset($txMeta['user_id'])){
  //     //     $userId = $txMeta['user_id'];
  //     // }else{
  //     //      $userId = '';
  //     // }

  //     $userId = isset($txMeta['user_id']) ? $txMeta['user_id'] : null;

  //      $custmerData = [
  //         'customer_type' => $txMeta['customer_type'],
  //         'user_id' => $userId,
  //         'rave_account_id' => $verifiedTx->data->accountid,
  //         'phone' => $verifiedTx->data->custphone,
  //         'email' => $verifiedTx->data->custemail,
  //         'name' => $verifiedTx->data->custname,
  //     ];

  //     $transactionData = [
  //       'status' => 0,
  //       'reference_id' => $txRef,
  //       'payment_type' => $verifiedTx->data->paymenttype,
  //       'payment_aggregator' => 'rave',
  //       'amount' => $verifiedTxChargeAmount,
  //       'transaction_payload' => json_encode($verifiedTx),
  //       'transaction_meta' => json_encode($txMeta),
  //       'customer_id' => '', // references local instance
  //     ];


      // if (($verifiedTxchargeResponsecode == "00" || $verifiedTxchargeResponsecode == "0") && ($verifiedTxChargeAmount == $txChargeAmount)  && ($verifiedTxChargeCurrency == $txCurrency)) {
      //     $customer = BookPurchasedTrait::storeCustomer($custmerData);
      //     $transactionData['customer_id'] = $customer->id;
      //     $transaction = BookPurchasedTrait::storeTransaction($transactionData);

      //     $purchasedEbookData['transaction_id'] = $transaction->id;
      //     $purchasedEbookData['customer_id'] = $customer->id;
      //     $purchasedEbook = BookPurchasedTrait::storePurchasedEbook($purchasedEbookData);

      //     // current customer info  to session
      //     request()->session()->put('customer', $custmerData);

      //     // send id of purchased ebook to successful page, 
      //     // return redirect()->route('ebooks.purchased', ['id'=> id_encode($txMeta['ebook_id']) ]); //->with($custmerData);
      //     return redirect()->action([\Modules\Ebook\Http\Controllers\EbookController::class, 'deliverFile'], [ 'id'=>id_encode($txMeta['ebook_id']) ]);
      //   }else {
      //       return redirect('/failed');
      // }
  // }
