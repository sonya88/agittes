<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/sales', function () {
    return view('sales');
});
// Route::get('/home/salessummary', [SalesController::class, 'salesSummary']);/////

Route::post('/home/salessummary', [SalesController::class, 'salessummary']);
Route::get('/test-connection', function () {
    try {
        DB::connection('pgsql')->getPdo();
        return "Connected successfully to the PostgreSQL database!";
    } catch (\Exception $e) {
        return "Connection failed: " . $e->getMessage();
    }
});

Route::get('/copy', [SalesController::class, 'index2']);