<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'admin'], function() {
    Route::post('article', 'Article@index');
    Route::post('preprocessing', 'Article@preprocessing');
    Route::post('crawl', 'Article@crawl');
    Route::post('dice', 'Article@dice');
    Route::post('jaccard', 'Article@jaccard');
    Route::post('similarity', 'Article@similarity');    
    Route::post('compare', 'Article@compare');
    Route::post('lasthistory', 'Article@lasthistory');

    Route::get('getRecomendation', 'Article@getRecomendation');

    // insert
    Route::post('engage', 'Article@engage');
});