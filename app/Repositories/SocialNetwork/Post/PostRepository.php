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

    public function create($data) : Model
    {
            if($data->has('tag_ids'))
            {
                try {
                    DB::beginTransaction();
                    $post = $this->model::create([
                       'content' => $data->content,
                       'user_id' => Auth::id(),
                    ]);
                    $post->tags()->attach($data->tag_ids);
                    DB::commit();
                    return $post;
                }catch (\Exception $ex)
                {
                    DB::rollback();
                    throw  new UnexpectedException($ex->getMessage());
                }
            }
         return $this->model::create([
            'content' => $data->content,
            'user_id' => Auth::id(),
        ]);
    }

    public function update($id,$data)
    {
        if($data->has('tag_ids'))
        {
            try {
                DB::beginTransaction();
                $post = $this->model::findOrFail($id);
                $post->update([
                    'content' => $data->content,
                    'user_id' => Auth::id(),
                ]);
                $post->tags()->sync($data->tag_ids);
                DB::commit();
                return $post;
            }catch (\Exception $ex)
            {
                DB::rollback();
                throw  new UnexpectedException($ex->getMessage());
            }
        }
        $post = $this->model::findOrFail($id);
        $post->update([
            'content' => $data->content,
            'user_id' => Auth::id(),
        ]);
        return $post;
    }

    public function showUserPosts(int $user_id, ?int $paginatePerPage, bool $paginate = true) : Collection | LengthAwarePaginator
    {
        if($paginate)
        {
            if($paginatePerPage)
            {
                return $this->model->latest()->paginate($paginatePerPage);
            }
            return $this->model->latest()->paginate();
        }
        return $this->model->latest()->get();
    }
}
