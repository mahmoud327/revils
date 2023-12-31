<?php

namespace App\Models;

use App\Enums\UserTypesEnum;
use App\Models\Core\City;
use App\Models\Core\Coins;
use App\Models\Core\Country;
use App\Models\Core\State;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\Profile\BusinessProfile;
use App\Models\Profile\UserProfile;
use App\Models\SocialNetwork\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Multicaret\Acquaintances\Traits\CanFavorite;
use Multicaret\Acquaintances\Traits\CanLike;
use Multicaret\Acquaintances\Traits\CanRate;
use Multicaret\Acquaintances\Traits\CanView;
use Multicaret\Acquaintances\Traits\Friendable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\QueryBuilder\QueryBuilder;

class User extends Authenticatable implements HasMedia
{
    use LogsActivity;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use Friendable;
    use CanLike;
    use InteractsWithMedia;
    use CanRate;
    use CanView;
    use CanFavorite;


    protected $guarded = [];


    public const CUSTOMER = 'customer';
    public const SELLER = 'seller';
    public const Admin = 'admin';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
     * ----------------------------------------------------------------- *
     * ---------------------------- Acessores --------------------------- *
     * ----------------------------------------------------------------- *
     */


    public function getCoverImageAttribute()
    {
        if (($images = $this->getMedia('cover'))->count()) {
            return asset(optional($this->getFirstMedia('cover'))->getUrl());
        }
        return asset('awarebox.jpeg');
    }

    public function getProfileUrlAttribute()
    {
        return asset($this->username);
    }

    public function getProfileImageAttribute()
    {
        if (($images = $this->getMedia('profile'))->count()) {
            return asset(optional($this->getFirstMedia('profile'))->getUrl());
        }
        return asset('awarebox.jpeg');
    }

    /*
     * ----------------------------------------------------------------- *
     * --------------------------- Relations --------------------------- *
     * ----------------------------------------------------------------- *
     */

    public function coins(): HasOne
    {
        return $this->hasOne(Coins::class, 'user_id');
    }


    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function businessProfile(): HasOne
    {
        return $this->hasOne(BusinessProfile::class, 'user_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'user_id');
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id')->with(['orderDetails', 'userAddress']);
    }

    public function userAddress(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }


    public function cartItems(): HasMany
    {
        return $this->hasMany(UserCart::class, 'user_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function tagPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'tags', 'user_id', 'post_id', 'id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }
    public function canManageSettings(): bool
    {
        return $this->can('manage.settings');
    }

    public function scopeCustomer($query)
    {
        return $query->where('account_type', UserTypesEnum::CUSTOMER);
    }

    public function scopeSeller($query)
    {
        return $query->where('account_type', UserTypesEnum::SELLER);
    }

    public function scopeFilter($query, $users)
    {

        return QueryBuilder::for($users)
            ->allowedSorts(['id'])
            ->allowedFilters('username', 'email', 'last_name', 'first_name');
    }
}
