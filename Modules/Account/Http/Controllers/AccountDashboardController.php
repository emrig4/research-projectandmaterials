<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Ebook\Entities\Ebook;
use Modules\Ebook\Entities\Customer;
use Modules\Ebook\Entities\PurchasedEbook;

class AccountDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerPurchases = [];
        $currentCustomerEmail = auth()->user() ? auth()->user()->email : session()->get('customer.email'); 
        $customer = Customer::where('email', $currentCustomerEmail )->first();
        if($customer){
            $customerPurchases = $customer->ebookPurchases;
        }
        
        $ebooks=Ebook::forCard()
                ->where('user_id',auth()->user()->id)
                ->withoutGlobalScope('active')->latest()
                ->paginate(10);
                
        
        return view('public.account.dashboard.index', compact('ebooks', 'customerPurchases'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploads()
    {
        $ebooks=Ebook::forCard()
                ->where('user_id',auth()->user()->id)
                ->withoutGlobalScope('active')->latest()
                ->paginate(10);
                
        return view('public.account.uploads.index', compact('ebooks'));
    }
}
