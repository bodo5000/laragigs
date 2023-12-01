<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\GoogleAuthController;

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


Route::get('/', [JobController::class, 'index']);

Route::middleware(['auth'])->group(function () {

    Route::get('/listings/create', [JobController::class, 'create']);
    Route::post('/listings', [JobController::class, 'store']);

    Route::get('/listings/{listing}/edit', [JobController::class, 'edit']);
    Route::put('/listings/{listing}', [JobController::class, 'update']);
    Route::delete('/listings/{listing}', [JobController::class, 'destroy']);

    // manage listings
    Route::get('/listings/manage/{user}', [JobController::class, 'manage']);

    // single listing
    Route::get('/listings/{listing}', [JobController::class, 'show']);

    // logout
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware(['guest'])->group(function () {

    // register
    Route::get('/register', [AuthController::class, 'create']);
    Route::post('/users', [AuthController::class, 'store']);

    // login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/users/authenticate', [AuthController::class, 'authenticate']);

    // login with google
    Route::get('/auth/google', [GoogleAuthController::class, 'redirect_google'])->name('google_auth');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback_google']);

    // forgetPassword
    Route::get('/forget_password', [ForgetPasswordController::class, 'start_forgetPassword'])->name('start_forgetPassword');
    Route::post('/forget_password', [ForgetPasswordController::class, 'forgetPassword'])->name('forgetPassword');

    // resetPassword
    Route::get('/password_reset{token}', [ForgetPasswordController::class, 'password_reset'])->name('password.reset');
    Route::post('/password_reset', [ForgetPasswordController::class, 'password_update'])->name('password.update');
});





















// Route::get(
//     '/hello',
//     fn () => response('<h1>Hello World</h1>', 200)
//         ->header('content_type', 'text/plain')
//         ->header('foo', 'bar')
// );

// i send path with the request
// Route::get('posts/{<id:slug></id:slug>}', function ($id) {
//     return response('post ' . $id);
// })->where('id', '[0-9]+');

//i send parameters to url='search?name=abdo&city=cairo'
// Route::get('/search', function (Request $request) {
//     return $request->name . ' ' . $request->city;
// });
