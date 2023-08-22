<?php


namespace App\Repositories\SocialNetwork\Post;

use App\Exceptions\UnexpectedException;
use App\Models\SocialNetwork\Post;
use App\Repositories\Base\BaisRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository extends BaisRepository implements PostRepositoryInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function all(?int $paginatePerPage,bool $paginate = true) : Collection | LengthAwarePaginator
    {
        if($paginate)
        {
            if($paginatePerPage)
            {
                return $this->model->with(['user','tags','comments.user','likers'])->withCount('likers')->latest()->paginate($paginatePerPage);
            }
            return $this->model->with(['user','tags','comments.user','likers'])->withCount('likers')->latest()->paginate();
        }

        return $this->model->with(['user','tags','comments.user','likers'])->withCount('likers')->latest()->get();
    }

    public function find($id): ?Model
    {
         $data = $this->model->findOrFail($id);
         return $data->load('comments.user');
    }

    public function create($data) : Model
    {
                try {
                    DB::beginTransaction();
                    $post = $this->model::create([
                       'content' => $data->content,
                       'user_id' => Auth::id(),
                    ]);
                    $post->tags()->attach($data->tag_ids);
                    $post
                        ->addMedia($data->image)
                        ->toMediaCollection();
                    DB::commit();
                    return $post;
                }catch (\Exception $ex)
                {
                    DB::rollback();
                    throw  new UnexpectedException($ex->getMessage());
                }
    }

    public function update($id,$data)
    {
            try {
                DB::beginTransaction();
                $post = $this->model::findOrFail($id);
                $post->update([
                    'content' => $data->content,
                    'user_id' => Auth::id(),
                ]);
                $post->tags()->sync($data->tag_ids);
                if ($data->hasFile('image')) {
                    $post->clearMediaCollection();
                    $post->addMedia($data->image)->toMediaCollection();
                }
                DB::commit();
                return $post;
            }catch (\Exception $ex)
            {
                DB::rollback();
                throw  new UnexpectedException($ex->getMessage());
        }
    }


    public function destroy($id): bool
    {
        $model = $this->find($id);
        $model->clearMediaCollection();
        return $model->delete();
    }

    public function likeOrUnlikePost(Post $post)
    {
        Auth::user()->toggleLike($post);
    }
}
