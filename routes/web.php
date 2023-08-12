<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

 // branch
 Route::controller(ClientController::class)->group(function(){
    Route::get('/all/client','index')->name('all.client');
    Route::get('/add/client','create')->name('add.client');
    Route::post('/store/client','store')->name('client.store');
    Route::get('/edit/client/{id}','edit')->name('edit.client');
    Route::post('/update/client/{id}','update')->name('client.update');
    Route::get('/delete/client/{id}','destroy')->name('delete.client');
    Route::post('dropzone/store', 'dropzoneStore')->name('photos.store');

});
