<?php

namespace App\Models\Profile;

use App\Models\Core\BusinessType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BusinessProfile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function businessType(): HasOne
    {
        return $this->hasOne(BusinessType::class,'business_type_id');
    }
}
