<?php

Route::get('testimonials', [
    'as' => 'admin.testimonials.index',
    'uses' => 'TestimonialController@index',
    'middleware' => 'can:admin.reviews.index',
]);


// store
Route::post('testimonials', [
    'as' => 'admin.testimonials.store',
    'uses' => 'TestimonialController@store',
    'middleware' => 'can:admin.reviews.edit',
]);


// create
Route::get('testimonial/create', [
    'as' => 'admin.testimonials.create',
    'uses' => 'TestimonialController@create',
    'middleware' => 'can:admin.reviews.edit',
]);

// create
Route::patch('testimonials/{id}', [
    'as' => 'admin.testimonials.update',
    'uses' => 'TestimonialController@update',
    'middleware' => 'can:admin.reviews.edit',
]);


// get edit
Route::get('testimonials/{id}', [
    'as' => 'admin.testimonials.edit',
    'uses' => 'TestimonialController@edit',
    'middleware' => 'can:admin.reviews.edit',
]);

// delete
Route::delete('testimonials/{id}', [
    'as' => 'admin.testimonials.destroy',
    'uses' => 'TestimonialController@destroy',
    'middleware' => 'can:admin.reviews.destroy',
]);

