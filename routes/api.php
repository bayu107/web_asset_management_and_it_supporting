<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\RentAssetController;
use App\Http\Controllers\UsedAssetController;
use App\Http\Controllers\ReportTroubleController;
use App\Http\Controllers\MCategoryAssetController;
use App\Http\Controllers\MCategoryReportController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Public routes
Route::post('/login', [UserController::class, 'authenticate']);
Route::post('/register', [UserController::class, 'store']);

// Route::get('/storage/{filename}', function ($filename)
// {
//     return Image::make(storage_path('public/storage/report_picts' . $filename))->response();
// }); 

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/logout-all', [UserController::class, 'logoutAll']);

    Route::get('/category_report', [MCategoryReportController::class, 'index']);
    Route::post('/category_report', [MCategoryReportController::class, 'store']);
    Route::get('/category_report/{id}', [MCategoryReportController::class, 'show']);
    Route::put('/category_report/{id}', [MCategoryReportController::class, 'update']);
    Route::delete('/category_report/{id}', [MCategoryReportController::class, 'destroy']);

    // Route::get('/category_report', [MCategoryReportController::class, 'index']);
    // Route::post('/category_report', [MCategoryReportController::class, 'store']);
    // Route::get('/category_report/{id}', [MCategoryReportController::class, 'show']);
    // Route::put('/category_report/{id}', [MCategoryReportController::class, 'update']);
    // Route::delete('/category_report/{id}', [MCategoryReportController::class, 'destroy']);
    
    Route::get('/category_asset', [MCategoryAssetController::class, 'index']);
    Route::post('/category_asset', [MCategoryAssetController::class, 'store']);
    Route::get('/category_asset/{id}', [MCategoryAssetController::class, 'show']);
    Route::put('/category_asset/{id}', [MCategoryAssetController::class, 'update']);
    Route::delete('/category_asset/{id}', [MCategoryAssetController::class, 'destroy']);
    
    Route::get('/report-trouble', [ReportTroubleController::class, 'index']);
    Route::post('/report-trouble', [ReportTroubleController::class, 'store']);
    Route::get('/report-trouble/{report}', [ReportTroubleController::class, 'show']);
    Route::put('/report-trouble/{report}', [ReportTroubleController::class, 'update']);
    Route::delete('/report-trouble/{report}', [ReportTroubleController::class, 'destroy']);
    Route::get('/report-trouble/report-by/{reportBy}', [ReportTroubleController::class, 'showByReportBy']);

    Route::get('/assets', [AssetController::class, 'index']);
    Route::get('/assets/{id}', [AssetController::class, 'show']);
    Route::post('/assets', [AssetController::class, 'store']);
    Route::put('/assets/{id}', [AssetController::class, 'update']);
    Route::delete('/assets/{id}', [AssetController::class, 'destroy']);
    Route::get('assets/used-by/{userId}', [AssetController::class, 'getAssetsByUsedBy']);

    Route::get('/used_assets', [UsedAssetController::class, 'index']);
    Route::post('/used_assets', [UsedAssetController::class, 'store']);
    Route::get('/used_assets/{id}', [UsedAssetController::class, 'show']);
    Route::put('/used_assets/{id}', [UsedAssetController::class, 'update']);
    Route::delete('/used_assets/{id}', [UsedAssetController::class, 'destroy']);
    Route::get('used-assets/used-by/{usedBy}', [UsedAssetController::class, 'showByUsedBy']);

    Route::get('rent-assets', [RentAssetController::class, 'index']);
    Route::post('rent-assets', [RentAssetController::class, 'store']);
    Route::get('rent-assets/{id}', [RentAssetController::class, 'show']);
    Route::put('rent-assets/{id}', [RentAssetController::class, 'update']);
    Route::delete('rent-assets/{id}', [RentAssetController::class, 'destroy']);

});