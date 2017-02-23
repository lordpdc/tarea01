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
Route::patch('sellers/{seller}','SellerController@edit');
Route::delete('sellers/{seller}','SellerController@destroy');
//1.7 Agregar dirección al vendedor
Route::post('sellers/{seller}/addresses','SellerController@addAddress');
//1.8 Actualizar dirección del vendedor
Route::put('sellers/{seller}/addresses/{address}','SellerController@editAddress');
//******************2. Manejar Producto
//2.1 Listar productos
// Se quiere poder ver las etiquetas que tiene asociados el producto y quien es el vendedor del producto.
Route::get('products','ProductController@index');
//2.2 Mostrar información de un producto
//Se quiere poder ver las etiquetas que tiene asociados el producto y quien es el vendedor del producto.
Route::get('products/{product}','ProductController@show');
//2.3 Agregar un producto
//Nombre (String) Precio (Mayor a 0, con decimales) Descripción (Texto) Etiquetas (Array de strings, por ejemplo ['tag1', 'tag2'] ) Vendedor
//Nota: Guardar las etiquetas si no existen están en el sistema.
//(Tomar en cuenta los tags)
Route::post('products/{product}','ProductController@store');
//2.4 Actualizar un producto
//No debe permitir actualizar el producto si alguno de los atributos no se encuentra o está vacío en la solicitud HTTP.
Route::put('products/{product}','ProductController@update');
//2.5 Actualizar parcialmente un producto
//Es posible enviar en la solicitud uno o más atributos del cliente para que estos sean actualizados.
Route::patch('products/{product}','ProductController@edit');
//2.6 Eliminar un producto
// Si un producto es eliminado se deben de eliminar sus reseñas.
Route::delete('products/{product}','ProductController@destroy');
//2.7 Agregar una reseña a un producto
//Persona que realizó la reseña(String) Título (String) Contenido de la reseña (String) Fecha de la reseña (Date)
//No debe permitir guardar una reseña de un producto si alguno de los atributos no se encuentra o está vacío en la solicitud HTTP.
Route::post('products/{product}','ProductController@update');
//2.8 Listar las reseñas de un producto
Route::get('products/{product}/reviews','ProductController@indexReview');
//2.9 Eliminar una reseña de un producto
Route::delete('products/{product}/reviews/{review}','ProductController@destroyReview');
