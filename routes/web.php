<?php

use App\Models\User;
use App\Models\UserOtp;
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

Route::get('/test', function () {
   $user = User::first();
   $post = \App\Models\SocialNetwork\Post::with(['tags','comments.user'])->first();
   return new \App\Http\Resources\SocialNetwork\PostResource($post);
    $post->comment('Hello, world!',$user);
    return "deeletsl";

    return $post->comments()->where('commentable_id',1)->forceDelete();
    return $post;
});

Route::get('/otps', function () {
    \App\Models\UserOtp::create([
       'mobile' => '966123456789' ,
       'otp' => '3123'
    ]);
    return "success";
});

Route::get('/otps/create', function () {
     $user_otp = new UserOtp();
    $user_otp->mobile  = '96612343513';
    $user_otp->otp  = '3456';
    $user_otp->save();
    return "succsdes";
});

Route::get('/otps/get', function () {
    return UserOtp::all();
});
