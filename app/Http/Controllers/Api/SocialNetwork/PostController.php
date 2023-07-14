<?php

namespace App\Http\Controllers\Api\SocialNetwork;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocialNetwork\PostRequest;
use App\Http\Resources\SocialNetwork\PostResource;
use App\Repositories\SocialNetwork\Post\PostRepositoryInterface;
use Illuminate\Http\Request;

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
            return responseSuccess([], __('lang.socialNetwork.post.messages.created'));
    }

    public function update(PostRequest $request, $id)
    {
        $this->postRepository->update(id: $id, data: $request);
        return responseSuccess([], __('lang.socialNetwork.post.messages.updated'));
    }

    public function show($id)
    {
            return responseSuccess(new PostResource($this->postRepository->find(id:$id)));
    }
    public function destroy($id)
    {
        $this->postRepository->destroy(id: $id);
        return responseSuccess([], __('lang.socialNetwork.post.messages.deleted'));
    }
}
