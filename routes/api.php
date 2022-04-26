<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




////////////////// Company Information //// ===========================================
Route::get('get-all-company', [CompanyController::class, 'getAllCompany']);
Route::post('store-company', [CompanyController::class, 'store']);
Route::post('get-company-data', [CompanyController::class, 'edit']);
Route::post('update-comapany-data', [CompanyController::class, 'update']);
Route::post('delete-company', [CompanyController::class, 'destroy']);


////////////////// Employee Information //// ===========================================
Route::post('store-employee', [EmployeeController::class, 'store']);
Route::post('get-employee-data', [EmployeeController::class, 'edit']);
Route::post('update-employee-data', [EmployeeController::class, 'update']);
Route::post('delete-employee', [EmployeeController::class, 'destroy']);
