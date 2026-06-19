<?php
namespace Modules\Ebook\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Ebook\Entities\Ebook;



class CartController extends Controller
{

   /**
   * Redirect
   * @return Url
   */
    public function index()
    {
            
    }

    public function singleItem()
    {
      $idd = request()->query('ebook');
      $ebook = Ebook::where('id', $idd)->firstOrFail();
      return view('public.ebooks.cart', ['ebook' => $ebook]);
    }
}
