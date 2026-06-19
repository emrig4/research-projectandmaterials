<?php
use Modules\Setting\Entities\Setting as Settings;
use Modules\Category\Entities\Category;

// Purchases and Payments Routes

// Payments Routes
Route::group(['prefix' => 'categories'], function(){

	Route::get('/', 'CategoryController@index' )->name('categories.index');
});

// all departments
Route::get('/all-departments', 'CategoryController@listDepartments' )->name('departments.index');
// app
Route::get('/app', 'CategoryController@listDepartments' )->name('departments.index');
	

	//project-topics-and-materials
Route::get('/project-topics-and-materials', 'CategoryController@listDepartments' )->name('departments.index');