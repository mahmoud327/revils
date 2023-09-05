<?php

namespace App\Http\Controllers\Api\SocialNetwork;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocialNetwork\PostComments\CommentPostRequest;
use App\Http\Requests\Api\SocialNetwork\PostComments\CommentRequest;
use App\Http\Requests\Api\SocialNetwork\PostComments\UpdateCommentRequest;
use App\Http\Requests\Api\SocialNetwork\PostRequest;
use App\Http\Resources\SocialNetwork\CommentResource;
use App\Http\Resources\SocialNetwork\PostResource;
use App\Http\Resources\UserResource;
use App\Models\SocialNetwork\Post;
use App\Models\User;
use App\Repositories\SocialNetwork\Post\PostRepositoryInterface;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RyanChandler\Comments\Models\Comment;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    public function __construct(public PostRepositoryInterface $postRepository)
    {
    }

    public function index()
    {
        $posts = PostResource::collection($this->postRepository->all(paginatePerPage: null))->response()->getData(true);
        $success['posts'] = $posts['data'];
        $success['meta'] = $posts['meta'];
        return responseSuccess($success);
    }


    public function store(PostRequest $request)
    {
        $this->postRepository->create(data: $request);
        return responseSuccess([], trans('socialNetwork/post.messages.created'));
    }

    public function update(PostRequest $request, $id)
    {
        try {
            $this->postRepository->update(id: $id, data: $request);
            return responseSuccess([], trans('socialNetwork/post.messages.updated'));
        } catch (UnexpectedException $ex) {
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        }
    }

    public function show($id)
    {
        return responseSuccess(new PostResource($this->postRepository->find(id: $id)));
    }
    public function destroy($id)
    {
        $this->postRepository->destroy(id: $id);
        return responseSuccess([], trans('socialNetwork/post.messages.deleted'));
    }

    public function showUserPosts()
    {
        $posts = PostResource::collection(Auth::user()->posts()->with(['user', 'tags', 'comments.user', 'likers'])->withCount('likers')->paginate())->response()->getData(true);
        $success['posts'] = $posts['data'];
        $success['meta'] = $posts['meta'];
        return responseSuccess($success);
    }

    public function likeOrUnlikePost(PostRequest $request)
    {

        $post = $this->postRepository->find(id: $request->post_id);
        $this->postRepository->likeOrUnlikePost(post: $post);
        return responseSuccess([], trans('socialNetwork/post.messages.actions.liked'));
    }

    public function favoriteOrUnfavorit(PostRequest $request)
    {
        $post = $this->postRepository->find(id: $request->post_id);
        $this->postRepository->favoriteOrUnfavorit(post: $post);
        return responseSuccess([], trans('socialNetwork/post.messages.actions.favorited'));
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
        $comment->load('user');
        $data = new CommentResource($comment);
        return responseSuccess($data);
    }

    public function showPostComment($post_id)
    {
        $post = Post::findorfail($post_id);
        return responseSuccess(CommentResource::collection($post->comments()->get()));
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
    public function taggedUser($post_id)
    {
        $users = QueryBuilder::for(User::class)
            ->whereHas('tagPosts', function ($q) use ($post_id) {
                $q->where('post_id', $post_id);
            })
            ->allowedFilters('username', 'first_name', 'last_name', 'email') // Use the allowed filter
            ->get();

        return responseSuccess(UserResource::collection($users));
    }
}
