<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/test', function(){
    \Cart::clear();
    return bcrypt('password');
});

Route::get('/content', function(){
    $cart = \Cart::getContent();
    dd($cart);
});

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
    Route::get('/attribute/values', 'ProductsController@getAttributeValueById')->name('attribute.value');
    Route::resource('products', 'ProductsController');
    Route::get('/dashboard','DashboardController@index')->name('dashboard.index');

    Route::get('/order/list', 'OrdersController@allOrders')->name('all.orders');
    Route::get('/customers', 'CustomersController@allCustomers')->name('all.customers');

    Route::post('/order/status/change', 'OrdersController@changeStatus')->name('change.status');
});

Route::group(['prefix' => 'laravel-filemanager', 
'middleware' => ['web', 'auth', 'admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('index');
Route::get('/product/{slug}', 'ProductsController@productDetail')->name('front.product.detail');
Route::get('/products/{type?}/{value?}', 'ProductsController@listProducts')->name('front.products');
Route::get('/search/product', 'ProductsController@searchProduct')->name('front.products.search');
Route::resource('cart', 'CartController');
Route::resource('contact', 'ContactController');

Route::post('/add-to-cart', 'CartController@addToCart')->name('add.to.cart');

Route::get('/cart/item/remove', 'CartController@removeItem')->name('remove.item');
Route::get('/cart/item/update', 'CartController@updateItem')->name('update.item');

Route::group(['middleware' => ['web', 'auth', 'customer']], function(){
    Route::get('/checkout', 'CheckoutController@index')->name('checkout');
    Route::post('/execute', 'CheckoutController@executePayment')->name('execute.payment');

    Route::post('/add/address', 'AddressController@store')->name('add.address');
    Route::get('/address/detail', 'AddressController@getDetail')->name('address.detail');
    Route::get('/my/orders', 'OrdersController@customerOrder')->name('my.orders');

});