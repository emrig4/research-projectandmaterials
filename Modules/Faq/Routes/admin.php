<?php

// Route::get('faqs', [
//     'as' => 'admin.faqs.index',
//     'uses' => 'FAQController@index',
//     'middleware' => 'can:admin.tags.index',
// ]);

// Route::get('faqs/create', [
//     'as' => 'admin.tags.create',
//     'uses' => 'TagController@create',
//     'middleware' => 'can:admin.tags.create',
// ]);

// Route::delete('faqs/{slug}', [
//     'as' => 'admin.tags.destroy',
//     'uses' => 'TagController@destroy',
//     'middleware' => 'can:admin.tags.destroy',
// ]);


// FAQ ADMIN
Route::resource('/faqs/categories', 'CategoriesController', [
	'as' => 'faqs'
]);
Route::patch('/faqs/{faq}', 'FAQController@update' )->name('faqs.update');
Route::resource('/faqs', 'FAQController');


