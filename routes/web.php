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

Route::group(["prefix"=>"admin","namespace"=>"Admin","name"=>"admin."], function() {
    Route::get('/', 'Dashboard@index')->name('dashboard');
    Route::get('operation', 'Operation@index')->name('operation');
    Route::get('preprocessing', 'Preprocessing@index')->name('preprocessing');
    Route::get('similarity', 'Similarity@index')->name('similarity');
    Route::get('history', 'History@index')->name('similarity');

});


Route::group(["namespace"=>"User",'name'=>'user.'], function() {
    Route::get('/','Homepage')->name('homepage');
    Route::get('/{slug}', 'Detail')->name('detail');
});