<?php

namespace App\Models\Core;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function states()
    {
        return $this->hasMany(State::class,'country_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class,'country_id');
    }


}
