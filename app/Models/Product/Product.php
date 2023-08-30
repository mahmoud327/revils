<?php

namespace App\Models\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\ProductStatusEnum;
use App\Enums\ProductStatusTextValueEnum;
use App\Enums\BooleanEnum;
use App\Http\Resources\Core\MediaCenterResource;
use App\Models\Core\Category;
use App\Models\UserCart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Multicaret\Acquaintances\Traits\CanBeRated;
use Multicaret\Acquaintances\Traits\CanBeViewed;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia

{
    use HasTranslations;
    use LogsActivity;
    use HasFactory;
    use InteractsWithMedia;
    use CanBeRated;
    use CanBeViewed;


    public $with = ['media'];



    public $translatable = ['name', 'description'];




    protected $guarded = [];

    /*
     * ----------------------------------------------------------------- *
     * --------------------------- Acessores --------------------------- *
     * ----------------------------------------------------------------- *
     */

    public function getImagesAttribute()
    {
        if (($images = $this->getMedia('images'))->count()) {
            return MediaCenterResource::collection($images->sortBy(function ($image) {
                return !$image->getCustomProperty('isFeatured', false);
            }));
        }
        return
            [[
                'id' => 0,
                'original' => asset('awarebox.jpeg'),
                'order' => 1,
                'position' => 1,
                'is_featured' => true,
            ]];
    }
    public function getViewsAttribute()
    {
        return $this->viewersCount();
    }

    public function getUserIsAddCartAttribute()
    {
        if(Auth::guard('sanctum')->user())
        {
           return  UserCart::query()
                ->whereUserId(Auth::guard('sanctum')->id())
                ->whereProductId($this->id)
                ->exists();
        }
        return false;
    }

    public function getSizesAttribute()
    {
        return $this->attributeValues()
            ->whereHas('attribute', function ($q) {
                $q->where('name->en', 'Size');
            })
            ->pluck('value');
    }
    public function getColorsAttribute()
    {
        return $this->attributeValues()
            ->whereHas('attribute', function ($q) {
                $q->where('name->en', 'Color');
            })
            ->pluck('value');
    }
    public function getStyleAttribute()
    {
        return optional($this->attributeValues()
            ->whereHas('attribute', function ($q) {
                $q->where('name->en', 'Style');
            })
            ->first())->value;
    }

    public function getGenderAttribute()
    {
        return optional($this->attributeValues()
            ->whereHas('attribute', function ($q) {
                $q->where('name->en', 'Gender');
            })
            ->first())->value;
    }
    public function getProducedAsAttribute()
    {
        return optional($this->attributeValues()
            ->whereHas('attribute', function ($q) {
                $q->where('name->en', 'Produced as');
            })
            ->first())->value;
    }

    public function getFeaturesAttribute()
    {
        return [
            'gender' => $this->gender,
            'producedAs' => $this->produced_as,
            'style' => $this->style,
            'is_handcrafted' => $this->getIsHandcrafted(),
        ];
    }


    public function getRatesAttribute()
    {
        return $this->ratingsPure()->avg('relation_value') ?? 0;
    }

    /**
     * @return mixed
     */
    public function getFeaturedImageAttribute()
    {
        if ($this->getMedia('images')->count()) {
            return MediaCenterResource::make($this->getMedia('images', ['isFeatured' => true])->first());
        }
    }
    public function getStatus()
    {

        return  match ($this->status) {
            ProductStatusEnum::PENDING_INT => getTranslation(ProductStatusTextValueEnum::PENDING_AR, ProductStatusTextValueEnum::PENDING_EN),
            ProductStatusEnum::APPROVED_INT => getTranslation(ProductStatusTextValueEnum::APPROVED_EN, ProductStatusTextValueEnum::APPROVED_AR),
            ProductStatusEnum::REJECTED_INT => getTranslation(ProductStatusTextValueEnum::REJECTED_EN, ProductStatusTextValueEnum::REJECTED_AR),
        };
    }

    public function getIsFreeShipping()
    {
        return $this->is_free_shipping
            ? getTranslation(BooleanEnum::YES_EN, BooleanEnum::YES_AR)
            : getTranslation(BooleanEnum::NO_EN, BooleanEnum::NO_AR);
    }

    public function getIsLiquidShipping()
    {
        return $this->is_liquid_shipping
            ? getTranslation(BooleanEnum::YES_EN, BooleanEnum::YES_AR)
            : getTranslation(BooleanEnum::NO_EN, BooleanEnum::NO_AR);
    }

    public function getIsBatteriesShipping()
    {
        return $this->is_batteries_shipping
            ? getTranslation(BooleanEnum::YES_EN, BooleanEnum::YES_AR)
            : getTranslation(BooleanEnum::NO_EN, BooleanEnum::NO_AR);
    }

    public function getIsDangerousShipping()
    {
        return $this->is_dangerous_shipping
            ? getTranslation(BooleanEnum::YES_EN, BooleanEnum::YES_AR)
            : getTranslation(BooleanEnum::NO_EN, BooleanEnum::NO_AR);
    }

    public function getIsHandcrafted()
    {
        return $this->is_handcrafted
            ? getTranslation(BooleanEnum::YES_EN, BooleanEnum::YES_AR)
            : getTranslation(BooleanEnum::NO_EN, BooleanEnum::NO_AR);
    }


    /*
     * ----------------------------------------------------------------- *
     * --------------------------- Scopes --------------------------- *
     * ----------------------------------------------------------------- *
     */



    public function scopeApproved($query)
    {
        return $query->whereStatus(ProductStatusEnum::APPROVED_INT);
    }
    public function scopeRejected($query)
    {
        return $query->whereStatus(ProductStatusEnum::REJECTED_INT);
    }
    public function scopePending($query)
    {
        return $query->whereStatus(ProductStatusEnum::PENDING_INT);
    }

    public function scopeCategory($query, $category_id)
    {
        if ($category_id != 'all') {
            return $query->whereCategoryId($category_id);
        }
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name->ar', 'like', '%' . $search . '%')
            ->orwhere('name->en', 'like', '%' . $search . '%')
            ->orwhere('description->ar', 'like', '%' . $search . '%')
            ->orwhere('description->en', 'like', '%' . $search . '%');
    }

    public function scopeHandcrafted($query, $handcrafted)
    {
        return $query->whereIsHandcrafted((int)$handcrafted);
    }

    public function scopePriceRange($query, string $range)
    {
        $range = explode('-', $range);
        return $query->where(function ($query) use ($range) {
            $query->whereBetween('price', [$range[0], $range[1]]);
        });
    }
    public function scopeRate($query, $rate)
    {
        $approve = $query->approved();
        match ($rate) {
            '0' => $approve->doesntHave('ratingsPure'),
            default => $approve->whereHas('ratingsPure', function ($q) use ($rate) {
                $q->whereRelationValue($rate);
            })
        };
    }


    public function scopeFilter($query, $products)
    {
        return QueryBuilder::for($products)
            ->allowedSorts(['id', 'price'])
            ->allowedFilters([
                AllowedFilter::scope('price_range'),
                AllowedFilter::scope('search'),
                AllowedFilter::scope('category'),
                AllowedFilter::scope('handcrafted'),
                AllowedFilter::scope('rate'),
            ]);
    }
    /*
     * ----------------------------------------------------------------- *
     * ---------------------------- Mutators --------------------------- *
     * ----------------------------------------------------------------- *
     */

    /**
     * @return void
     */
    public function setImagesAttribute($images)
    {
        uploadMedia($this, $images);
    }

    /*
     * ----------------------------------------------------------------- *
     * --------------------------- Relations --------------------------- *
     * ----------------------------------------------------------------- *
     */


    // public function attributes()
    // {
    //     return $this->belongsToMany(Attribute::class, 'product_attributes', 'product_id', 'attribute_id')
    //         ->withPivot('attribute_value_id');
    // }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')
            ->withPivot('attribute_value_id');
    }


    public function relatedProducts(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id')
            ->approved()
            ->where('id', '!=', $this->id);
    }


    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attributes')
            ->withPivot('attribute_id');
    }

    public function productAttributes(): HasMany
    {
        return $this->hasMany(
            ProductAttribute::class,
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }



    public function updateTranslations(array $translations)
    {

        $this->name = $translations['name'];
        $this->description = $translations['description'];
        $this->save();
    }



    /**
     * Register the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }
}
