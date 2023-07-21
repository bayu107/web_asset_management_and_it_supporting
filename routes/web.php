<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\AssetController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Web\UsedAssetController;
use App\Http\Controllers\Web\ReportTroubleController;
use App\Http\Controllers\Web\MCategoryAssetController;
use App\Http\Controllers\Web\MCategoryReportController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Rute untuk register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rute untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users.index');
Route::get('/dashboard/users/create',[UserController::class, 'create'])->name('dashboard.users.create');
Route::post('/dashboard/users', [UserController::class, 'store'])->name('dashboard.users.store');
Route::get('/dashboard/users/{user}', [UserController::class, 'show'])->name('dashboard.users.show');
Route::get('/dashboard/users/{user}/edit', [UserController::class, 'edit'])->name('dashboard.users.edit');
Route::put('/dashboard/users/{user}', [UserController::class, 'update'])->name('dashboard.users.update');
Route::delete('/dashboard/users/{user}', [UserController::class, 'destroy'])->name('dashboard.users.destroy');

Route::get('/m_category_assets', [MCategoryAssetController::class, 'index'])->name('m_category_assets.index');
Route::get('/m_category_assets/create', [MCategoryAssetController::class, 'create'])->name('m_category_assets.create');
Route::post('/m_category_assets', [MCategoryAssetController::class, 'store'])->name('m_category_assets.store');
Route::get('/m_category_assets/{id}', [MCategoryAssetController::class, 'show'])->name('m_category_assets.show');
Route::get('/m_category_assets/{id}/edit', [MCategoryAssetController::class, 'edit'])->name('m_category_assets.edit');
Route::put('/m_category_assets/{id}', [MCategoryAssetController::class, 'update'])->name('m_category_assets.update');
Route::delete('/m_category_assets/{id}', [MCategoryAssetController::class, 'destroy'])->name('m_category_assets.destroy');

Route::get('/m_category_reports', [MCategoryReportController::class, 'index'])->name('m_category_reports.index');
Route::get('/m_category_reports/create', [MCategoryReportController::class, 'create'])->name('m_category_reports.create');
Route::post('/m_category_reports', [MCategoryReportController::class, 'store'])->name('m_category_reports.store');
Route::get('/m_category_reports/{id}', [MCategoryReportController::class, 'show'])->name('m_category_reports.show');
Route::get('/m_category_reports/{id}/edit', [MCategoryReportController::class, 'edit'])->name('m_category_reports.edit');
Route::put('/m_category_reports/{id}', [MCategoryReportController::class, 'update'])->name('m_category_reports.update');
Route::delete('/m_category_reports/{id}', [MCategoryReportController::class, 'destroy'])->name('m_category_reports.destroy');

Route::get('/asset', [AssetController::class, 'index'])->name('asset.index');
Route::get('/asset/create', [AssetController::class, 'create'])->name('asset.create');
Route::post('/asset', [AssetController::class, 'store'])->name('asset.store');
Route::get('/asset/{id}', [AssetController::class, 'show'])->name('asset.show');
Route::get('/asset/{id}/edit', [AssetController::class, 'edit'])->name('asset.edit');
Route::put('/asset/{id}', [AssetController::class, 'update'])->name('asset.update');
Route::delete('/asset/{id}', [AssetController::class, 'destroy'])->name('asset.destroy');

Route::get('/usedassets', [UsedAssetController::class, 'index'])->name('usedasset.index');
Route::get('/usedassets/create', [UsedAssetController::class, 'create'])->name('usedasset.create');
Route::post('/usedassets', [UsedAssetController::class, 'store'])->name('usedasset.store');
Route::get('/usedassets/{id}', [UsedAssetController::class, 'show'])->name('usedasset.show');
Route::get('/usedassets/{id}/edit', [UsedAssetController::class, 'edit'])->name('usedasset.edit');
Route::put('/usedassets/{id}', [UsedAssetController::class, 'update'])->name('usedasset.update');
Route::delete('/usedassets/{id}', [UsedAssetController::class, 'destroy'])->name('usedasset.destroy');

Route::put('/usedasset/{id}/return', [UsedAssetController::class, 'returnAsset'])->name('usedasset.return');


Route::get('/reports', [ReportTroubleController::class, 'index'])->name('report.index');
Route::get('/reports/create', [ReportTroubleController::class, 'create'])->name('report.create');
Route::post('/reports', [ReportTroubleController::class, 'store'])->name('report.store');
Route::get('/reports/{report}', [ReportTroubleController::class, 'show'])->name('report.show');
Route::get('/reports/{report}/edit', [ReportTroubleController::class, 'edit'])->name('report.edit');
Route::put('/reports/{report}', [ReportTroubleController::class, 'update'])->name('report.update');
Route::delete('/reports/{report}', [ReportTroubleController::class, 'destroy'])->name('report.destroy');

// UNTUK USER
Route::get('/reportuser', [ReportTroubleController::class, 'indexuser'])->name('reportuser.index');
Route::get('/reportuser/create', [ReportTroubleController::class, 'createuser'])->name('reportuser.create');
Route::post('/reportuser', [ReportTroubleController::class, 'storeuser'])->name('reportuser.store');
Route::get('/reportuser/{report}/edit', [ReportTroubleController::class, 'edituser'])->name('reportuser.edit');
Route::put('/reports/{report}', [ReportTroubleController::class, 'updateuser'])->name('reportuser.update');

Route::get('/assetuser', [AssetController::class, 'indexuser'])->name('assetuser.index');
Route::get('/assetuser/create', [AssetController::class, 'createuser'])->name('assetuser.create');
// Route::post('/assetuser', [AssetController::class, 'store'])->name('asset.store');
Route::get('/assetuser/{id}', [AssetController::class, 'show'])->name('assetuser.show');
Route::get('/assetuser/usedasset/{id}', [AssetController::class, 'addusedasset'])->name('assetuser.addusedasset');
// Route::get('/assetuser/{id}/edit', [AssetController::class, 'edit'])->name('asset.edit');
// Route::put('/assetuser/{id}', [AssetController::class, 'update'])->name('asset.update');
// Route::delete('/assetuser/{id}', [AssetController::class, 'destroy'])->name('asset.destroy');
