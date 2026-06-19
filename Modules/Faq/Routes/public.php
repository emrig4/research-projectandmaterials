<?php
use Modules\Setting\Entities\Setting as Settings;
use Modules\Category\Entities\Category;


/*
* FAQs public facing routes
*/
Route::group(['prefix' => 'faq'], function () {
    Route::get('', 'FAQController@index')->name('faq.index');
    Route::post('/question/{faq}/{type?}', 'FAQController@incrementClick');
});

	