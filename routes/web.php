<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view(
        'listings',
        [
            'heading' => 'Latest Listings',
            'listings' => Listing::all()
        ]
    );
});

// single listing
Route::get('/listing/{id}', function ($id) {
    return view('listing', [
        'listing' => Listing::find($id)
    ]);
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
