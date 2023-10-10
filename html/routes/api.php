<?php

use App\Http\Controllers\BanksController;
use App\Http\Controllers\DealershipController;
use App\Http\Controllers\DealershipEmloyeeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\StatusesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('v1/loans', LoanController::class);
Route::resource('v1/employees', EmployeeController::class);
Route::resource('v1/dealerships', DealershipController::class);
Route::resource('v1/statuses', StatusesController::class);
Route::resource('v1/banks', BanksController::class);
Route::resource('v1/dealerships.employees', DealershipEmloyeeController::class);

