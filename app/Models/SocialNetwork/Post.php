<?php

namespace App\Models\SocialNetwork;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Multicaret\Acquaintances\Traits\CanBeLiked;
use RyanChandler\Comments\Concerns\HasComments;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use CanBeLiked, HasComments, InteractsWithMedia;

    protected $guarded = [];
    public $with = ['media'];



    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(User::class,'tags','post_id','user_id','id','id');
    }

    public function getImage()
    {
        return $this->getFirstMediaUrl('image');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image');
    }


}
