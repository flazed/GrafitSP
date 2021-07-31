<?php

use Illuminate\Support\Facades\Route;
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

Auth::routes();

// Главная страница
Route::get('/', 'PageController@main')->name('main');
// Страница "Продукция"
Route::get('/products', 'PageController@products')->name('products');
// Страница "Порфтолио"
Route::get('/portfolio', 'PageController@portfolio')->name('portfolio');
// Страница "Прайс-лист"
Route::get('/price-list', 'PageController@priceLists')->name('prices');
// Страница "Контакты"
Route::get('/contacts', 'PageController@contacts')->name('contacts');
Route::post('/contacts', 'PageController@contactsPost');
// Страница "Корзина"
Route::get('/basket', 'PageController@basket')->name('basket');

// Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', 'UserController@orders')->name('UserOrders');

    Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
        Route::prefix('portfolio')->group(function () {
            Route::get('/', 'PortfolioController@index')->name('AdminPortfolio');
            Route::get('/create', 'PortfolioController@create')->name('AdminPortfolioCreate');
            Route::get('/{id}', 'PortfolioController@show')->name('AdminPortfolioView');
            Route::get('/{id}/edit', 'PortfolioController@edit')->name('AdminPortfolioEdit');
            Route::post('/{id}/edit', 'PortfolioController@update');
            Route::get('/{id}/delete', 'PortfolioController@delete')->name('AdminPortfolioDelete');
            Route::post('/{id}/delete', 'PortfolioController@destroy');
        });

        Route::prefix('products')->group(function () {
            Route::get('/', 'ProductsController@index')->name('AdminProducts');
            Route::get('/create', 'ProductsController@create')->name('AdminProductsCreate');
            Route::get('/{id}', 'ProductsController@show')->name('AdminProductsView');
            Route::get('/{id}/edit', 'ProductsController@edit')->name('AdminProductsEdit');
            Route::post('/{id}/edit', 'ProductsController@update');
            Route::get('/{id}/delete', 'ProductsController@delete')->name('AdminProductsDelete');
            Route::post('/{id}/delete', 'ProductsController@destroy');
        });

        Route::prefix('materials')->group(function () {
            Route::get('/', 'MaterialsController@index')->name('AdminMaterials');
            Route::get('/create', 'MaterialsController@create')->name('AdminMaterialsCreate');
            Route::post('/create', 'MaterialsController@store');
            Route::get('/{id}', 'MaterialsController@show')->name('AdminMaterialsView');
            Route::get('/{id}/edit', 'MaterialsController@edit')->name('AdminMaterialsEdit');
            Route::post('/{id}/edit', 'MaterialsController@update');
            Route::get('/{id}/delete', 'MaterialsController@delete')->name('AdminMaterialsDelete');
            Route::post('/{id}/delete', 'MaterialsController@destroy');
        });

        Route::prefix('orders')->group(function () {
            Route::get('/', 'OrdersController@index')->name('AdminOrders');
            Route::get('/{id}/edit', 'OrdersController@edit')->name('AdminOrdersEdit');
            Route::post('/{id}/edit', 'OrdersController@update');
            Route::get('/{id}/delete', 'OrdersController@delete')->name('AdminOrdersDelete');
            Route::post('/{id}/delete', 'OrdersController@destroy');
        });
    });
});
