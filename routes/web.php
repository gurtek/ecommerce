<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

// admin routes
Route::match(['get','post'],'/admin','AdminController@index')->name('admin');
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::resource('categories', 'CategoriesController');
    Route::resource('brands', 'BrandsController');
    Route::resource('attributes', 'AttributesController');
    Route::match(['get','post'],'/attribute/{attribute}/valueindex', 'AttributesController@valueindex')->name('attribute.valueindex');
    Route::get('/attribute/{attribute}/valuecreate', 'AttributesController@valuecreate')->name('attribute.valuecreate');
    Route::post('/attribute/{attribute}/valuestore', 'AttributesController@valuestore')->name('attribute.valuestore');
    Route::get('/attribute/valueedit/{attribute}/{attributevalue}', 'AttributesController@valueedit')->name('attribute.valueedit');
    Route::match(['put','post'],'/attribute/valueupdate/{attribute}/{attributevalue}', 'AttributesController@valueupdate')->name('attribute.valueupdate');
    Route::match(['delete','post'],'/attribute/{attribute}/valuedestroy', 'AttributesController@valuedestroy')->name('attribute.valuedestroy');
    Route::get('/attribute/values', 'ProductsController@getAttributeValueById')
                ->name('attribute.value');
    Route::resource('products', 'ProductsController');
    Route::get('/dashboard','DashboardController@index');
});


Route::get('/home', 'HomeController@index')->name('home');
