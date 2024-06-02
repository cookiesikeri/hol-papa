<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', [HomeController::class, 'index']);

Route::post('/contact-us-post', [HomeController::class, 'postMessage'])->name('site.contact.post');
Route::post('/newsletter', [HomeController::class, 'postNewsLetter'])->name('site.newsletter.post');
Route::post('/submit-prayer-request', [HomeController::class, 'posPrayer'])->name('prayer.post');
Route::post('/submit-testimony', [HomeController::class, 'posTestimony'])->name('testimony.post');
