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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'API\V1'], function() {
    Route::group(['prefix' => 'campeonato'], function() {
        Route::get('/posicao/geral/{idTemporada}', 'CampeonatoController@getPosicaoGeral');
        Route::get('/posicao/dinamica/{idTemporada}', 'CampeonatoController@getPosicaoDinamica');
        Route::get('/temporadas', 'CampeonatoController@getTemporadas');
    });

    Route::group(['prefix' => 'time'], function() {
        Route::get('/resultado/ultimos/{idTemporada}/{idTime}', 'TimeController@getUltimosResultados');
    });
});
