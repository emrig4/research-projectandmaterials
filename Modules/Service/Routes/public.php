<?php

use Illuminate\Support\Facades\Route;

Route::get('services', 'ServiceController@index')->name('services.index');
Route::get('services/{slug}', 'ServiceController@show')->name('services.show');

Route::post('service-requests', 'ServiceRequestController@store')->name('servicerequests.store');