<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::get('test2',function(){
    $user=User::find(6);
    Auth::login($user);
    return 'login';
})->name('login');
Route::get('/test', function () {
      $prod = \App\Models\Product\Product::with(['ratingsPure.user'])->first();
    return new \App\Http\Resources\Product\ProductResource(($prod));
});
