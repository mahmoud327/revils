<?php

namespace App\Http\Controllers\Api\SocialNetwork;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocialNetwork\FollowRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFriendshipController extends Controller
{

    public function sendFollowingRequest(FollowRequest $request)
    {
        $recipient = User::find($request->user_id);
        Auth::user()->befriend($recipient);
        return responseSuccess('','request send successfully');
    }

    public function acceptFollowRequest(FollowRequest $request)
    {
        $sender = User::find($request->user_id);
        Auth::user()->acceptFriendRequest($sender);
        return responseSuccess('','accepted successfully');
    }

    public function denyFollowRequest(FollowRequest $request)
    {
        $sender = User::find($request->user_id);
        Auth::user()->denyFriendRequest($sender);
        return responseSuccess('','denied successfully');
    }

    public function unfollow(FollowRequest $request)
    {
        $friend = User::find($request->user_id);
        Auth::user()->unfriend($friend);
        return responseSuccess('','unfollowing successfully');
    }

    public function blockFriend(FollowRequest $request)
    {
        $friend = User::find($request->user_id);
        Auth::user()->blockFriend($friend);
        return responseSuccess('','blocked successfully');
    }

    public function unblockFriend(FollowRequest $request)
    {
        $friend = User::find($request->user_id);
        Auth::user()->unblockFriend($friend);
        return responseSuccess('','unblocked successfully');
    }

    public function getAllFriendships(Request $request)
    {
           $userIds = Auth::user()->getAllFriendships()->pluck('id');
           $users = User::whereIn('id',$userIds)->get();
           if($users->isEmpty())
           {
               return responseError('there are no friends',401);
           }
        return responseSuccess(UserResource::collection($users));
    }




}
