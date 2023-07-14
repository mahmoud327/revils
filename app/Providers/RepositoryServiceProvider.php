<?php

namespace App\Providers;

use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\Core\BusinessType\BusinessTypeRepository;
use App\Repositories\Core\BusinessType\BusinessTypeRepositoryInterface;
use App\Repositories\Core\Category\CategoryRepository;
use App\Repositories\Core\Category\CategoryRepositoryInterface;
use App\Repositories\Core\Country\CountryRepository;
use App\Repositories\Core\Country\CountryRepositoryInterface;
use App\Repositories\Core\Coupon\CouponRepository;
use App\Repositories\Core\Coupon\CouponRepositoryInterface;
use App\Repositories\Core\Payment\PaymentRepository;
use App\Repositories\Core\Payment\PaymentRepositoryInterface;
use App\Repositories\Product\Attribute\AttributeRepository;
use App\Repositories\Product\Attribute\AttributeRepositoryInterface;
use App\Repositories\Product\Image\ImageRepository;
use App\Repositories\Product\Image\ImageRepositoryInterface;

use App\Repositories\SocialNetwork\Post\PostRepository;
use App\Repositories\SocialNetwork\Post\PostRepositoryInterface;
use App\Repositories\User\Image\ImageRepository as ImageUserRepository;
use App\Repositories\User\Image\ImageRepositoryInterface as ImageUserRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\Rate\RateRepository;
use App\Repositories\Product\Rate\RateRepositoryInterface;
use App\Repositories\Seller\SellerRepository;
use App\Repositories\Seller\SelllerRepositoryInterface;
use App\Repositories\State\StateRepository;
use App\Repositories\State\StateRepositoryInterface;
use App\Repositories\Core\Address\AddressRepository;
use App\Repositories\Core\Address\AddressRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(AttributeRepositoryInterface::class, AttributeRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);

        $this->app->bind(ImageUserRepositoryInterface::class, ImageUserRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(StateRepositoryInterface::class, StateRepository::class);
        $this->app->bind(BusinessTypeRepositoryInterface::class, BusinessTypeRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(SelllerRepositoryInterface::class, SellerRepository::class);

        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);

        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }
}
