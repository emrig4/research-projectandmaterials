<?php

namespace Modules\Ebook\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Ebook\Entities\Ebook;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Ebook\Http\Requests\SaveEbookRequest;
use Illuminate\Http\Request;
use Modules\Ebook\Filters\EbookFilter;
use Modules\Ebook\Entities\PurchasedEbook;
use Modules\Ebook\Entities\Customer;


class PurchasedEbookController extends Controller
{
 
    public function index(Ebook $model, EbookFilter $ebookFilter){
        $ebookIds = [];

        $purchasedEbooks = PurchasedEbook::orderBy('created_at', 'DESC')->paginate(20);

        // if (request()->has('query')) {
        //     $model = $model->search(request('query'));
        //     $ebookIds = $model->keys();
        // }

        // $query = $model->filter($ebookFilter);

        // if (request()->has('category')) {
        //     $ebookIds = (clone $query)->select('ebooks.id')->resetOrders()->pluck('id');
        // }

        // $ebooks = $query->paginate(9)
        //     ->appends(request()->query());

        // if (request()->wantsJson()) {
        //     return response()->json($ebooks);
        // }

        // event(new ShowingEbookList($ebooks));

        return view('ebook::admin.ebooks.purchases', compact('purchasedEbooks', 'ebookIds'));
    }
}
