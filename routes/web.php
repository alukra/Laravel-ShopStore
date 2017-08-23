<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//** Homepage
Auth::routes();
Route::get('/', 'Frontpage\HomepageController@getIndex');
Route::get('products/{type}/{category}/{order}', 'Frontpage\HomepageController@getProducts');
Route::get('category/{id}', 'Frontpage\HomepageController@getCategoryGrid');
Route::get('category/list/{id}', 'Frontpage\HomepageController@getCategoryList');
Route::get('type/{id}', 'Frontpage\HomepageController@getTypeGrid');
Route::get('type/list/{id}', 'Frontpage\HomepageController@getTypeList');
Route::get('product-detail/{id}', 'Frontpage\HomepageController@getProduct');
//Route::get('location', 'Frontpage\LocationController@getIndex');
Route::get('location/{id}', 'Frontpage\LocationController@getLocation');
//Route::get('news', 'Frontpage\LandingController@getIndex' );
Route::post('suscribe', 'Frontpage\HomepageController@postSuscribe');


Route::get('profile', 'Auth\ProfileController@getProfile');

//Backoffice
Route::get('back/login', 'Auth\BackloginController@showLogin');
Route::get('back/dashboard', 'Backoffice\DashboardController@index' );
Route::get('back/', 'Backoffice\DashboardController@index' );
Route::Resource('back/role', 'Backoffice\RolController', [
      'except' => ['destroy', 'create', 'edit'] ]);
Route::get('back/role-module/asignar-rol', 'Backoffice\AsignarRolController@getAsignarRol');
Route::post('back/role-module/asignar-rol', 'Backoffice\AsignarRolController@postAsignarRol');
Route::Resource('back/employee', 'Backoffice\EmpleadoController', [
      'except' => ['show', 'destroy'] ]);
Route::Resource('back/detail', 'Backoffice\CaracteristicaController');
Route::Resource('back/type-product', 'Backoffice\TipoController', [
      'except' => ['show', 'destroy'] ]);
Route::Resource('back/location', 'Backoffice\LocationController', [
      'except' => ['show', 'destroy'] ]);
Route::Resource('back/brand', 'Backoffice\MarcaController',
['except' => ['show'] ]);
Route::Resource('back/category', 'Backoffice\CategoriaController');
Route::Resource('back/product', 'Backoffice\ProductoController');
Route::post('back/product-more/store-category/{id}', 'Backoffice\ProductoDetallesController@storeCategory');
Route::get('back/product-more/destroy-category/{id}/{categoria}', 'Backoffice\ProductoDetallesController@destroyCategory');
Route::post('back/product-more/store-detail/{id}', 'Backoffice\ProductoDetallesController@storeDetail');
Route::get('back/product-more/destroy-detail/{id}/{caracteristica}', 'Backoffice\ProductoDetallesController@destroyDetail');
Route::post('back/product-more/store-image/{id}', 'Backoffice\ProductoDetallesController@storeImage');
Route::get('back/product-more/destroy-image/{id}/{imagen}', 'Backoffice\ProductoDetallesController@destroyImage');
Route::get('back/product-more/update-image/{id}/{imagen}', 'Backoffice\ProductoDetallesController@updateImage');
