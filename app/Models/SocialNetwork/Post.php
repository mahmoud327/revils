<?php

namespace App\Models\SocialNetwork;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $guarded = ['id'];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
