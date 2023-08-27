<?php

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

Route::get('test2',function(){
    return Auth::user();
    $user=User::find(6);
    Auth::login($user);
    return 'login';
})->name('login');
Route::get('/test', function () {
   // Auth::login(User::whereId(4)->first());
    return  $post = Post::with(['user','tags','comments.user','likers'])->withCount('likers')->whereId(7)->first();
      $prod = \App\Models\Product\Product::with(['ratingsPure.user'])->first();
    return new \App\Http\Resources\Product\ProductResource(($prod));
});

Route::get('/add-coupon', function () {
    \App\Models\Core\Coupon::create([
        'code' => 1111,
        'expiry_date' =>date('2023-12-30'),
        'value' => 10,
        'type' => 'amount'
    ]);
    return "success";

});
