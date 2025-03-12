<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PaymentController::class, 'index']);
Route::post('/payments', [PaymentController::class, 'store']);
Route::put('/payments/{uppdate}', [PaymentController::class, 'update']);
Route::delete('/payments/delete/{delete}', [PaymentController::class, 'delete']);
Route::get('/admin/payments', [PaymentController::class, 'allpayments']);
