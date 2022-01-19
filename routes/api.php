<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReportController;
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

Route::post('generate-report', [ReportController::class,'generateReport'])->name('generate.report');
Route::get('list-reports', [ReportController::class,'listReports'])->name('list.reports');
Route::get('get-report/{report_id}', [ReportController::class,'getReport'])->name('get.report');


