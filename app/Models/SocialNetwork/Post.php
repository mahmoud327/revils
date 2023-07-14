<?php

namespace App\Models\SocialNetwork;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Multicaret\Acquaintances\Traits\CanBeLiked;
use RyanChandler\Comments\Concerns\HasComments;

class Post extends Model
{
    use CanBeLiked, HasComments;

    protected $guarded = ['id'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(User::class,'tags','post_id','user_id','id','id');
    }


}
