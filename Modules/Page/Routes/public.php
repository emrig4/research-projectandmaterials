<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/about-us', 'PageController@aboutUs')->name('about_us');
Route::get('/privacy-policy', 'PageController@privacy')->name('privacy_policy');
Route::get('/how-it-works', 'PageController@howItWorks')->name('how_it_works');


