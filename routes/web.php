<?php

use App\Models\Product\Product;
use App\Models\SocialNetwork\Post;
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

Route::get('coupon',function(){
    \App\Models\Core\Coupon::create([
        'code' => 1111,
        'expiry_date' => date('2024-08-31'),
        'value' => 5,
        'type' => 'amount',
    ]);
    return 'created';
});

