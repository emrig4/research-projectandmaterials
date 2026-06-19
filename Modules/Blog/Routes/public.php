<?php

use  Modules\Blog\Http\Controllers\BinshopsBlogAdminController;

// 
// used to overide matchng package controller and method
/* Admin backend routes - CRUD for posts, categories, and approving/deleting submitted comments */
    Route::group(['prefix' => config('binshopsblog.admin_prefix', 'blog_admin')], function () {

        Route::post('/add_post',
            'BinshopsBlogAdminController@store_post', ['middleware' => 'optimizeImages'])
            ->name('binshopsblog.admin.store_post');

        Route::patch('/update_post/{id}',
            'BinshopsBlogAdminController@update_post', ['middleware' => 'optimizeImages'])
            ->name('binshopsblog.admin.update_post');
    });