<?php

namespace App\Models\Core;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    use HasTranslations;
    public $translatable = ['name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class,'city_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(City::class,'state_id');
    }

}
