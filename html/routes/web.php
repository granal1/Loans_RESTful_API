<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\BanksController;
use App\Http\Controllers\DealershipController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoanController;
use App\Models\Dealership;
use App\Http\Controllers\DealershipEmloyeeController;
use App\Http\Controllers\StatusesController;

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

// Route::resource('loans', LoanController::class);
// Route::resource('employees', EmployeeController::class);
// Route::resource('dealerships', DealershipController::class);
// Route::resource('statuses', StatusesController::class);
// Route::resource('banks', BanksController::class);
// Route::resource('dealerships.employees', DealershipEmloyeeController::class);

