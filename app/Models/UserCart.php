<?php

namespace App\Models;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCart extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'attributes' => 'array',
    ];

    /*
     * ----------------------------------------------------------------- *
     * ---------------------------- Relations --------------------------- *
     * ----------------------------------------------------------------- *
     */



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /*
     * ----------------------------------------------------------------- *
     * ---------------------------- Acessores --------------------------- *
     * ----------------------------------------------------------------- *
     */

    public function getTotalAmountAttribute()
    {
        return getTotalAmount(auth()->user()->cartItems);
    }

    public function getTotalAmountAfterDiscountAttribute()
    {
        return getTotalAmountAfterDiscount($this->total_amount);
    }

}
