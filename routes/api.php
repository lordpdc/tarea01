<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*plantilla route
Route::metodo('ruta','funcionControlador');
*/
//+++++++++Sellers++++++++
Route::get('sellers','SellerController@index');
Route::get('sellers/{seller}','SellerController@show');
Route::post('sellers','SellerController@store');
Route::put('sellers/{seller}','SellerController@update');
//1.5 Actualizar parcialmente un vendedor
//Es posible enviar en la solicitud uno o más atributos del cliente para que estos sean actualizados.
Route::patch('sellers/{seller}','SellerController@partialUpdate');
Route::delete('sellers/{seller}','SellerController@destroy');
//1.7 Agregar dirección al vendedor
Route::post('sellers/{seller}/addresses','SellerController@addAddress');
//1.8 Actualizar dirección del vendedor
Route::put('sellers/{seller}/addresses/{address}','SellerController@editAddress');
//******************2. Manejar Producto
Route::get('products','ProductController@index');
Route::get('products/{product}','ProductController@show');
Route::post('products','ProductController@store');
Route::put('products/{product}','ProductController@update');
//2.5 Actualizar parcialmente un producto
//Es posible enviar en la solicitud uno o más atributos del cliente para que estos sean actualizados.
Route::patch('products/{product}','ProductController@partialUpdate');
Route::delete('products/{product}','ProductController@destroy');
Route::post('products/{product}/reviews','ProductController@addReview');
Route::get('products/{product}/reviews','ProductController@indexReview');
Route::delete('products/reviews/{review}','ProductController@destroyReview');
