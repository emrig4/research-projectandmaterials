<?php

// Tag Routes
Route::group(['prefix' => 'tags'], function(){

	Route::get('/', 'TagController@index' )->name('tags.index');
});

	