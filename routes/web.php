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

Route::get('/', 'LoginController@index')->name('login');
Route::post('/', 'LoginController@loginAct')->name('login-act');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::middleware([login::class])->group(function(){
    Route::get('/car-list', 'CarController@list')->name('car-list');
    Route::get('/car-add', 'CarController@carAdd')->name('car-add');
    Route::post('/car-add', 'CarController@carAddAct')->name('car-add-act');
    Route::get('/car/{id}/edit', 'CarController@edit')->name('car-edit');
    Route::post('/car/{id}/edit', 'CarController@editAct')->name('car-edit-act');
    Route::get('/car/{id}/delete', 'CarController@delete')->name('car-delete');
    
    Route::get('/transaction', 'TransactionController@new')->name('transaction');
    Route::post('/transaction', 'TransactionController@newAct')->name('transaction-act');
    Route::get('/transaction-history', 'TransactionController@history')->name('transaction-history');
});