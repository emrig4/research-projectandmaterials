<?php

Route::get('tags', [
    'as' => 'admin.tags.index',
    'uses' => 'TagController@index',
    'middleware' => 'can:admin.tags.index',
]);

Route::get('tags/create', [
    'as' => 'admin.tags.create',
    'uses' => 'TagController@create',
    'middleware' => 'can:admin.tags.create',
]);

Route::delete('tags/{slug}', [
    'as' => 'admin.tags.destroy',
    'uses' => 'TagController@destroy',
    'middleware' => 'can:admin.tags.destroy',
]);



