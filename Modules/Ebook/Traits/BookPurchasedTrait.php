<?php

namespace Modules\Ebook\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Base\Search\Searchable;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Ui\Facades\TabManager;
use Illuminate\Support\Facades\Mail;

use Modules\Ebook\Entities\Transaction;
use App\Helpers\fxExchange;
use Modules\Ebook\Entities\Customer;
use Modules\Ebook\Entities\PurchasedEbook;
use Modules\Ebook\Traits\BookPurchasedTrait;

trait BookPurchasedTrait
{
     public static function storePurchasedEbook($data){
        // TODO - move logic to trait
        $purchased = PurchasedEbook::create($data);
        return $purchased;
    }

    public static function storeTransaction($data){
        // TODO - move logic to trait
        $transaction = Transaction::create($data);
        return $transaction;
    }

    public static function storeCustomer($data){
        $existingCustomer = Customer::where('email', $data['email'])->first();
        if($existingCustomer){
            return $existingCustomer;
        }
        $customer = Customer::create($data);
        return $customer;

    }
}
