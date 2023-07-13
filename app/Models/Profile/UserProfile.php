<?php

namespace App\Models\Profile;

use App\Models\Core\City;
use App\Models\Core\Country;
use App\Models\Core\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'city_id');
    }
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class,'state_id');
    }
}
