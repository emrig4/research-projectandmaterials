<?php
use Modules\Setting\Entities\Setting as Settings;
use Modules\Ebook\Entities\Ebook;
use Modules\Category\Entities\Category;

// Purchases and Payments Routes

// Payments Routes
Route::group(['prefix' => 'ebooks'], function(){

	// Single Item Cart
	Route::get('/cart', 'CartController@singleItem')->name('ebooks.cart');

	// via Flutterwave rave
	Route::post('/buy/rave', 'RaveController@initialize')->name('ebooks.buy.rave');
	Route::get('/buy/rave', function(){
		return redirect()->route('ebooks.index');
	});
	Route::get('/rave/callback', 'RaveController@callback')->name('rave.callback');

	// via paystack
	Route::post('/buy/paystack', 'PaystackController@redirectToGateway')->name('ebooks.buy.paystack');
	Route::get('/buy/paystack', function(){
		return redirect()->route('ebooks.index');
	});
	Route::get('/paystack/callback', 'PaystackController@handleGatewayCallback')->name('paystack.callback');

	Route::get('/purchased', 'EbookController@deliverFile' )->name('ebooks.purchased');
});

	

Route::get('ebooks/test', function(){
	// $ebook = Ebook::with('tagged')->first();
	// $ebook->tag('BSc'); // attach the tag

	// DB::table('website_tags')
	// ->join('assigned_tags', 'website_tags.id', '=', 'assigned_tags.tag_id')
	// ->select('website_tags.id as id', 'website_tags.title as title', DB::raw("count(assigned_tags.tag_id) as count"))
	// ->groupBy('website_tags.id')
	// ->get();


	// $cat = \DB::table('categories')
	// ->join('ebook_categories', 'ebook_categories.category_id',  '=', 'categories.id')
	// ->join('category_translations', 'category_translations.category_id',  '=', 'categories.id')
	// ->select('categories.slug', 'categories.id', 'category_translations.name', DB::raw("count(ebook_categories.category_id) as count"))
	// ->groupBy(['categories.slug', 'categories.description', 'category_translations.name'])
	// ->orderBy('count', 'DESC')
	// ->paginate();
	
	// dd($cat );

}); 



Route::get('download', 'EbookController@index')->name('ebooks.index');
Route::get('download/{slug}', 'EbookController@show')->name('ebooks.show');
Route::post('ebooks/{slug}/unlock', 'EbookController@unlock')->name('ebooks.unlock');
Route::post('ebooks/{ebookId}/report', 'ReportEbookController@store')->name('ebooks.report.store');
Route::get('ebooks/{slug}/download/{fileId?}', 'EbookController@download')->name('ebooks.download');

// airon main file download
Route::get('ebooks/{slug}/purchased/{fileId?}', 'EbookController@mainDownload')->name('ebooks.purchased.download');

Route::get('ebook/upload', 'EbookController@create')->name('ebooks.upload');
Route::post('ebook', 'EbookController@store')->name('ebooks.create');
Route::get('ebook/{slug}/delete', 'EbookController@destroy')->name('ebooks.delete');
Route::get('ebook/{slug}/edit', 'EbookController@edit')->name('ebooks.edit');
Route::put('ebook/{id}', 'EbookController@update')->name('ebooks.update');
Route::get('epub/{slug}', 'EbookController@epubReader')->name('ebooks.epubReader');
Route::post('ebooks/{slug}/pdfviewer', 'EbookController@pdfviewer')->name('ebooks.pdfviewer');
