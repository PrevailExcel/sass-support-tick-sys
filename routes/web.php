<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationController;

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

Route::get('/', function () {
    return view('welcome');
});


//Email Verification routes
Route::controller(EmailVerificationController::class)->group(function () {
    Route::get('/email/verify', 'show')->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', 'notify')->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware('verified');
