<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\Core\AddressController;
use App\Http\Controllers\Api\Core\BannerController;
use App\Http\Controllers\Api\Core\BusinessTypeController;
use App\Http\Controllers\Api\Core\CategoryController;
use App\Http\Controllers\Api\Core\CountryController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\Product\AttributeController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Seller\ProductController as ProductSellerController;
use App\Http\Controllers\Api\Product\ProductImageController;
use App\Http\Controllers\Api\Product\RateController;
use App\Http\Controllers\Api\Core\PaymentController;
use App\Http\Controllers\Api\Core\SettingController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\Seller\SellerController;
use App\Http\Controllers\Api\SocialNetwork\PostController;
use App\Http\Controllers\Api\SocialNetwork\UserFriendshipController;
use App\Http\Controllers\Api\User\ImageController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

####### auth #########
Route::group(['prefix' => 'auth', 'middleware' => ['ChangeLanguage']], function () {
    Route::post('register/customer/', [AuthController::class, 'customerRegister']);
    Route::post('register/seller/', [AuthController::class, 'sellerRegister']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('verify-mobile-sms', [AuthController::class, 'verifyMobileSms']);
    Route::post('send-otp', [AuthController::class, 'sendOtp']);
    Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('validateUniqueUserNameOrEmail', [AuthController::class, 'validateUniqueUserNameOrEmail']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });

    ####### reset pass #########
    Route::group(['prefix' => 'forget-password'], function () {
        Route::post('send-otp', [ResetPasswordController::class, 'sendOtp']);
        Route::post('verify-otp', [ResetPasswordController::class, 'verifyOtp']);
        Route::post('change-password', [ResetPasswordController::class, 'changePassword']);
    });
    Route::post('resend-otp', [AuthController::class, 'resendOtp']);
    ####### end reset pass #########

});
####### end auth #########
/*core*/
####### category #########
Route::group(['middleware' => ['ChangeLanguage']], function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('business-types', [BusinessTypeController::class, 'index']);
    Route::get('attributes', [AttributeController::class, 'index']);
});
####### end category #########

####### countries - states - cities #########
Route::get('countries', [CountryController::class, 'index']);
Route::post('states', [CountryController::class, 'getStates']);
Route::post('cities', [CountryController::class, 'getCities']);
####### end auth #########
#######banners#########
Route::get('banners', [BannerController::class, 'index']);
####### end banners #########

#######banners#########
Route::get('setting',SettingController::class);
####### end banners #########


####### product  #########
Route::apiResource('products', ProductController::class)->only(['index', 'show']);

Route::group(['middleware' => ['ChangeLanguage', 'auth:sanctum']], function () {
    Route::group(['prefix' => 'seller', 'middleware' => ['ChangeLanguage', 'auth:sanctum']], function () {
        Route::apiResource('products', ProductSellerController::class);
        Route::post('products/{product}/images/{image}/mark-featured', [ProductImageController::class, 'markFeatured']);
        Route::apiResource('products.images', ProductImageController::class)->except(['update', 'show']);
    });

    ####### end product #########

    ####### coupon  #########);
    Route::post('verify-coupon', [CouponController::class, 'verifyCoupon']);
    ####### end coupon #########

    ####### payments  #########);
    Route::get('payments', [PaymentController::class, 'index']);
    ####### end payments #########

    ####### rates  #########
    Route::apiResource('products.rates', RateController::class)->only('store');
    ####### end rates #########

    ####### profile seller customer #########
    Route::post('customer/update-profile', [UserController::class, 'customerUpdateProfile']);
    Route::post('seller/update-profile', [UserController::class, 'sellerUpdateProfile']);
    Route::get('seller', [SellerController::class, 'index']);
    Route::post('profile-info', [UserController::class, 'profileInfo']);
    Route::post('change-password', [UserController::class, 'changePassword']);
    Route::post('profile-image', [ImageController::class, 'profileImage']);
    Route::post('cover-image', [ImageController::class, 'coverImage']);
    ####### end profile #########

    ####### order #########
    Route::group(['prefix' => 'user'], function () {
        Route::apiResource('orders', OrderController::class);
        Route::post('order/{id}/change-status', [OrderController::class, 'changeStatus']);
        Route::apiResource('address',AddressController::class);

    });
    ####### end order #########

    ####### cart  #########
    Route::group(['prefix' => 'cart', 'middleware' => ['ChangeLanguage', 'auth:sanctum']], function () {
        Route::get('all', [CartController::class, 'getUserCartItems']);
        Route::post('add', [CartController::class, 'addToCart']);
        Route::post('remove', [CartController::class, 'removeFromCart']);
        Route::post('update', [CartController::class, 'updateCart']);
    });
    ####### end cart #########

    /*
     *
     * Social Network
     *
     * */
    ####### posts  #########
    Route::apiResource('posts', PostController::class)->except('update');
    Route::get('user-posts', [PostController::class,'showUserPosts'])->middleware('role:customer');
    Route::post('posts/update/{post}', [PostController::class,'update']);
    Route::post('like-unlike', [PostController::class,'likeOrUnlikePost'])->middleware('role:customer');
    Route::post('favorite-unfavorite', [PostController::class,'favoriteOrUnfavorit'])->middleware('role:customer');
    ##### comments ######
    Route::post('post/add-comment', [PostController::class,'addCommentPost']);
    Route::post('post/show-comment', [PostController::class,'showCommentPost']);
    Route::put('post/update-comment', [PostController::class,'updateCommentPost']);
    Route::delete('post/delete-comment', [PostController::class,'deleteCommentPost']);
    ##### end comments ######

    ####### end posts #########


    ####### followers   #########
    Route::post('send-follow-request', [UserFriendshipController::class, 'sendFollowingRequest']);
    Route::post('accept-follow-request', [UserFriendshipController::class, 'acceptFollowRequest']);
    Route::post('deny-follow-request', [UserFriendshipController::class, 'denyFollowRequest']);
    Route::post('unfollow-friend', [UserFriendshipController::class, 'unfollow']);
    Route::post('block-friend', [UserFriendshipController::class, 'blockFriend']);
    Route::post('unblock-friend', [UserFriendshipController::class, 'unblockFriend']);
    ####### end followers #########

});
Route::get('/sms', function () {

    $curl = curl_init();
    $app_id = "x54545";
    $app_sec = "565y";
    $app_hash  = base64_encode("$app_id:$app_sec");
    $messages = [];
    $messages["messages"] = [];
    $messages["messages"][0]["text"] = "test php";
    $messages["messages"][0]["numbers"][] = "01099912408";
    $messages["messages"][0]["sender"] = "test";

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-sms.4jawaly.com/api/v1/account/area/sms/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($messages),
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Basic ' . $app_hash
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    var_dump(json_decode($response));
    //JawalySms::message("mada")->to('01099912408')->send();
});
