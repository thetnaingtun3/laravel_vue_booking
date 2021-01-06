<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('bookable', 'Api\BookableController@index');
// Route::get('bookables/{id}', 'Api\BookableController@show');
Route::apiResource('bookables', 'Api\BookableController')->only(['index', 'show']);
Route::get(
    'bookables/{bookable}/availability',
    'Api\BookableAvailabilityConroller'
)->name('bookables.availability.show');
