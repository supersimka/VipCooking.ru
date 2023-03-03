<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\OtherController;

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
Route::get('/', [HomeController::class, 'homepage']);

Route::group(['prefix' => 'recept'], function () {
       Route::get('/', [CatalogController::class, 'receptParent']);
       Route::get('/{alias}', [CatalogController::class, 'recept']);
   });

Route::group(['prefix' => 'catalog'], function () {
       Route::get('/', [CatalogController::class, 'catalogtParent']);
       Route::get('/{slug}', [CatalogController::class, 'catalog']);
       Route::get('/child', [CatalogController::class, 'catalogChildParent']);
       Route::get('/child/{slug}', [CatalogController::class, 'catalogClild']);
   });

Route::get('/keywords/{slug}', [OtherController::class, 'keywords']);
Route::get('/products/{slug}', [OtherController::class, 'products']);
Route::get('/getSection', [OtherController::class, 'getSection']);

Route::get('/search', [SearchController::class, 'search']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
