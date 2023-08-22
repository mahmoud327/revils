<?php

namespace App\Http\Controllers\Api\SocialNetwork;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocialNetwork\PostComments\CommentPostRequest;
use App\Http\Requests\Api\SocialNetwork\PostComments\CommentRequest;
use App\Http\Requests\Api\SocialNetwork\PostComments\UpdateCommentRequest;
use App\Http\Requests\Api\SocialNetwork\PostRequest;
use App\Http\Resources\SocialNetwork\CommentResource;
use App\Http\Resources\SocialNetwork\PostResource;
use App\Models\User;
use App\Notifications\SendFirebaseNotification;
use App\Repositories\SocialNetwork\Post\PostRepositoryInterface;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use RyanChandler\Comments\Models\Comment;

class PostController extends Controller
{
    public function __construct(public PostRepositoryInterface $postRepository){}

    public function index(Request $request)
    {
        $posts = PostResource::collection($this->postRepository->all(paginatePerPage: $request->perPage));
        return responseSuccess($posts);
    }


    public function store(PostRequest $request)
    {
            $this->postRepository->create(data: $request);
            return responseSuccess([], trans('socialNetwork/post.messages.created'));
    }

    public function update(PostRequest $request, $id)
    {
        $this->postRepository->update(id: $id, data: $request);
        return responseSuccess([], trans('socialNetwork/post.messages.updated'));
    }

    public function show($id)
    {
            return responseSuccess(new PostResource($this->postRepository->find(id:$id)));
    }
    public function destroy($id)
    {
        $this->postRepository->destroy(id: $id);
        return responseSuccess([], trans('socialNetwork/post.messages.deleted'));
    }

    public function showUserPosts()
    {
        $posts = PostResource::collection(Auth::user()->posts()->with(['user','tags','comments.user','likers'])->withCount('likers')->get());
        return responseSuccess($posts);
    }

    public function likeOrUnlikePost(PostRequest $request)
    {

        $post = $this->postRepository->find(id: $request->post_id);
        $this->postRepository->likeOrUnlikePost(post: $post);
        return responseSuccess([], trans('socialNetwork/post.messages.actions.liked'));
    }

    public function addCommentPost(CommentPostRequest $request)
    {
        $post = $this->postRepository->find(id: $request->post_id);
        $post->comment($request->comment);
       // $user_id = getUserIdToSendNotification($post);
        //$user = User::find($user_id);
       // Notification::send($user, new SendFirebaseNotification($user));
        return responseSuccess([], trans('socialNetwork/post.messages.actions.commented'));
    }


    public function showCommentPost(CommentRequest $request)
    {
        $comment = Comment::whereId($request->comment_id)->whereUserId(Auth::id())->firstOrFail();
        $data = new CommentResource($comment);
        return responseSuccess($data);
    }

    public function updateCommentPost(UpdateCommentRequest $request)
    {
        $comment = Comment::whereId($request->comment_id)->whereUserId(Auth::id())->firstOrFail();
        $comment->update([
          'content' =>   $request->body
        ]);
        return responseSuccess([], trans('comment updated'));
    }

    public function deleteCommentPost(CommentRequest $request)
    {
        $comment = Comment::whereId($request->comment_id)->whereUserId(Auth::id())->firstOrFail();
        $comment->delete();
        return responseSuccess([], trans('comment deleted'));
    }


}
