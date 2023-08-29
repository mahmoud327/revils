<?php

namespace App\Models\Core;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Coins extends Model
{
    protected $guarded = [];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
