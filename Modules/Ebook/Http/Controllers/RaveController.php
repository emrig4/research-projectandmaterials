<?php
namespace Modules\Ebook\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Ebook\Traits\BookPurchasedTrait;

//use the Rave Facade
use Rave;

class RaveController extends Controller
{

    /**
    * Initialize Rave payment process
    * @return void
    */
    public function initialize()
    {
        //This initializes payment and redirects to the payment gateway
        //The initialize method takes the parameter of the redirect URL
        Rave::initialize(route('rave.callback'));
    }

  /**
   * Obtain Rave callback information
   * @return void
   */
    public function callback()
    {

        $responsePayload =  json_decode( request()->resp);
        $tx = $responsePayload->tx; // or $responseObject->data->data
        $txRef = $tx->txRef; // transaction reference from initial
        $txStatus = $tx->status;
        $txChargeAmount = $tx->amount; //amount from initial response
        $txCurrency = $tx->currency; // currency from initial response

        $verifiedTx = Rave::verifyTransaction($txRef);
        if($verifiedTx){
            $verifiedTxchargeResponsecode = $verifiedTx->data->chargecode;
            $verifiedTxchargeMessage = $verifiedTx->data->chargemessage;
            $verifiedTxChargeAmount = $verifiedTx->data->amount;
            $verifiedTxChargeCurrency = $verifiedTx->data->currency;
            $verifiedMeta = $verifiedTx->data->meta;

            $txMeta = [];
            foreach ($verifiedMeta as $value) {
                $txMeta[$value->metaname] = $value->metavalue;
            }


            $purchasedEbookData = [
              'ebook_id' => $txMeta['ebook_id'],
              'customer_id' => '',
              'transaction_id' => '', // local reference
              'is_delivered' => 0,
            ];

            // if(isset($txMeta['user_id'])){
            //     $userId = $txMeta['user_id'];
            // }else{
            //      $userId = '';
            // }

            $userId = isset($txMeta['user_id']) ? $txMeta['user_id'] : null;

             $custmerData = [
                'customer_type' => $txMeta['customer_type'],
                'user_id' => $userId,
                'rave_account_id' => $verifiedTx->data->accountid,
                'phone' => $verifiedTx->data->custphone,
                'email' => $verifiedTx->data->custemail,
                'name' => $verifiedTx->data->custname,
            ];

            $transactionData = [
              'status' => 0,
              'reference_id' => $txRef,
              'payment_type' => $verifiedTx->data->paymenttype,
              'payment_aggregator' => 'rave',
              'amount' => $verifiedTxChargeAmount,
              'transaction_payload' => json_encode($verifiedTx),
              'transaction_meta' => json_encode($txMeta),
              'customer_id' => '', // references local instance
            ];


            if (($verifiedTxchargeResponsecode == "00" || $verifiedTxchargeResponsecode == "0") && ($verifiedTxChargeAmount == $txChargeAmount)  && ($verifiedTxChargeCurrency == $txCurrency)) {
                $customer = BookPurchasedTrait::storeCustomer($custmerData);
                $transactionData['customer_id'] = $customer->id;
                $transaction = BookPurchasedTrait::storeTransaction($transactionData);

                $purchasedEbookData['transaction_id'] = $transaction->id;
                $purchasedEbookData['customer_id'] = $customer->id;
                $purchasedEbook = BookPurchasedTrait::storePurchasedEbook($purchasedEbookData);

                // current customer info  to session
                request()->session()->put('customer', $custmerData);

                // send id of purchased ebook to successful page, 
                // return redirect()->route('ebooks.purchased', ['id'=> id_encode($txMeta['ebook_id']) ]); //->with($custmerData);
                return redirect()->action([\Modules\Ebook\Http\Controllers\EbookController::class, 'deliverFile'], [ 'id'=>id_encode($txMeta['ebook_id']) ]);
              }else {
                  return redirect('/failed');
            }
        }
    }

}
