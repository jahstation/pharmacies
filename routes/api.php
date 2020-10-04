<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmacieFinderController;
use App\Http\Procedures\PharmaciesProcedure;


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


Route::rpc('/SearchNearestPharmacy', [PharmaciesProcedure::class])->name('rpc.endpoint2');



