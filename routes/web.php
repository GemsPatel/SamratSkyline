<?php

use App\Http\Controllers\CronController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScraperController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return "will clear the all cached!";
});

Route::get('/', [HomeController::class, 'index']);

Route::get('generateMaintanance', [CronController::class, 'maintananceInstall']);
Route::get('generateHome', [CronController::class, 'flatInstall']);
Route::get('generateHomeMaintanance', [CronController::class, 'flatMaintananceInstall']);
Route::get('report/{id}', [CronController::class, 'reportView']);

Route::get('scraper', [ScraperController::class, 'index']);