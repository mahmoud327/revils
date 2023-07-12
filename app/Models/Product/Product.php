<?php

namespace App\Models\Product;

use App\Models\User;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\ProductStatusEnum;
use App\Enums\ProductStatusTextValueEnum;
use App\Enums\BooleanEnum;
use App\Http\Resources\Core\MediaCenterResource;
use App\Models\Core\Category;
use Multicaret\Acquaintances\Traits\CanBeRated;
use Multicaret\Acquaintances\Traits\CanBeViewed;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;




class Product extends Model implements HasMedia

{
    use HasFactory;
    use InteractsWithMedia;
    use CanBeRated;
    use CanBeViewed;
    use Translatable;


    protected $with = [
        'translations',
    ];

    protected $translationForeignKey = "product_id";
    public $translatedAttributes = ['name', 'description'];
    public $translationModel = 'App\Models\Product\Translation\Product';


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
    }
    public function getViewsAttribute()
    {
        return $this->viewersCount();
    }
    public function getRatesAttribute()
    {

        return $this->averageRating('products') ?? 0;
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

    public function scopeCategory($query, $category_id)
    {
        return $query->whereCategoryId($category_id);
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereTranslationLike('name', '%' . $search . '%')
            ->orwhereTranslationLike('description', '%' . $search . '%');
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

    public function scopeFilter($query,$products)
    {
        return QueryBuilder::for($products)
            ->allowedSorts(['id', 'price'])
            ->allowedFilters([
                AllowedFilter::scope('price_range'),
                AllowedFilter::scope('search'),
                AllowedFilter::scope('category'),
                AllowedFilter::scope('handcrafted'),
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


    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes', 'product_id', 'attribute_id')
            ->withPivot('attribute_value_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(
            AttributeValue::class,
            'product_attributes',
            'product_id',
            'attribute_value_id'
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

        foreach ($translations as $locale => $values) {
            $this->translateOrNew($locale)->name = $values['name'];
            $this->translateOrNew($locale)->description = $values['description'];
        }

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
}
