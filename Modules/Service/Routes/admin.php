<?php

Route::get('services', [
    'as' => 'admin.services.index',
    'uses' => 'ServiceController@index',
    'middleware' => 'can:admin.services.index',
]);

Route::get('services/create', [
    'as' => 'admin.services.create',
    'uses' => 'ServiceController@create',
    'middleware' => 'can:admin.services.create',
]);

Route::post('services', [
    'as' => 'admin.services.store',
    'uses' => 'ServiceController@store',
    'middleware' => 'can:admin.services.create',
]);

Route::get('services/{id}', [
    'as' => 'admin.services.show',
    'uses' => 'ServiceController@show',
    'middleware' => 'can:admin.services.edit',
]);

Route::get('services/{id}/edit', [
    'as' => 'admin.services.edit',
    'uses' => 'ServiceController@edit',
    'middleware' => 'can:admin.services.edit',
]);

Route::patch('services/{id}', [
    'as' => 'admin.services.update',
    'uses' => 'ServiceController@update',
    'middleware' => 'can:admin.services.edit',
]);

Route::delete('services/{id}', [
    'as' => 'admin.services.destroy',
    'uses' => 'ServiceController@destroy',
    'middleware' => 'can:admin.services.destroy',
]);



// service request
Route::get('service-requests', [
    'as' => 'admin.servicerequests.index',
    'uses' => 'ServiceRequestController@index',
    'middleware' => 'can:admin.services.index',
]);

Route::get('service-requests/create', [
    'as' => 'admin.servicerequests.create',
    'uses' => 'ServiceRequestController@create',
    'middleware' => 'can:admin.services.create',
]);

Route::post('service-requests', [
    'as' => 'admin.servicerequests.store',
    'uses' => 'ServiceRequestController@store',
    'middleware' => 'can:admin.services.create',
]);

Route::get('service-requests/{id}', [
    'as' => 'admin.servicerequests.show',
    'uses' => 'ServiceRequestController@show',
    'middleware' => 'can:admin.services.edit',
]);

Route::get('service-requests/{id}/edit', [
    'as' => 'admin.servicerequests.edit',
    'uses' => 'ServiceRequestController@edit',
    'middleware' => 'can:admin.services.edit',
]);

Route::patch('service-requests/{id}', [
    'as' => 'admin.servicerequests.update',
    'uses' => 'ServiceRequestController@update',
    'middleware' => 'can:admin.services.edit',
]);

Route::delete('service-requests/{id}', [
    'as' => 'admin.servicerequests.destroy',
    'uses' => 'ServiceRequestController@destroy',
    'middleware' => 'can:admin.services.destroy',
]);




// service request proposals
Route::get('request-proposals', [
    'as' => 'admin.requestproposals.index',
    'uses' => 'RequestProposalController@index',
    'middleware' => 'can:admin.services.index',
]);

Route::get('request-proposals/create', [
    'as' => 'admin.requestproposals.create',
    'uses' => 'RequestProposalController@create',
    'middleware' => 'can:admin.services.create',
]);

Route::post('request-proposals', [
    'as' => 'admin.requestproposals.store',
    'uses' => 'RequestProposalController@store',
    'middleware' => 'can:admin.services.create',
]);

Route::get('request-proposals/{id}', [
    'as' => 'admin.requestproposals.show',
    'uses' => 'RequestProposalController@show',
    'middleware' => 'can:admin.services.edit',
]);

Route::get('request-proposals/{id}/edit', [
    'as' => 'admin.servicerequests.edit',
    'uses' => 'RequestProposalController@edit',
    'middleware' => 'can:admin.services.edit',
]);

Route::put('requestproposals/{id}', [
    'as' => 'admin.requestproposals.update',
    'uses' => 'RequestProposalController@update',
    'middleware' => 'can:admin.services.edit',
]);

Route::delete('request-proposals/{ids}', [
    'as' => 'admin.requestproposals.destroy',
    'uses' => 'RequestProposalController@destroy',
    'middleware' => 'can:admin.services.destroy',
]);
