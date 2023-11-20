<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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


Route::get('/', [ListingController::class, 'index']);

Route::middleware(['auth'])->group(function () {

    Route::get('/listings/create', [ListingController::class, 'create']);
    Route::post('/listings', [ListingController::class, 'store']);

    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);
    Route::put('/listings/{listing}', [ListingController::class, 'update']);
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);

    // manage listings
    Route::get('/listings/manage/{user}', [ListingController::class, 'manage']);

    // single listing
    Route::get('/listings/{listing}', [ListingController::class, 'show']);

    // logout
    Route::post('/logout', [UserController::class, 'logout']);
});


Route::middleware(['guest'])->group(function () {

    // register
    Route::get('/register', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);

    // login
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/users/authenticate', [UserController::class, 'authenticate']);
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
