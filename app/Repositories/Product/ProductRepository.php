<?php


namespace App\Repositories\Product;

use App\Exceptions\UnexpectedException;
use App\Models\Product\Product;
use App\Repositories\Base\BaisRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaisRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
    public function all(?int $paginatePerPage, bool $paginate = true): Collection | LengthAwarePaginator
    {
        $products = $this->model->approved()
            ->with(['user', 'category', 'attributes'])
            ->latest();
        $products->filter($products);
        if ($paginate) {
            if ($paginatePerPage) {
                return $products->paginate($paginatePerPage);
            }
            return $products->paginate();
        }
        return $products->get();
    }
    public function create($data): Model
    {
        try {
            DB::beginTransaction();
            $data['user_id'] = auth()->id();
            $product = $this->model->create($data->except(['attribute_ids', 'name_ar', 'name_en', 'description_ar', 'description_en']));
            $translations = [
                'name' => [
                    'en' => $data->name_en,
                    'ar' =>  $data->name_ar,
                ],
                'description' => [
                    'en' => $data->description_en,
                    'ar' => $data->description_ar,
                ],
            ];
            $product->updateTranslations($translations);

            $product->attributes()->attach($data->attribute_ids);
            DB::commit();

            return $this->model;
        } catch (\Exception $e) {
            DB::rollback();
            throw  new UnexpectedException($e->getMessage());
        }
    }

    public function show($id)
    {
        $product = $this->model->with(['user', 'attributes', 'category'])->findorfail($id);
        if (auth()->guard('sanctum')->check()) {
            auth()->guard('sanctum')->user()
                ->view($product);
        }
        return $product;
    }

    public function update($id, $data)
    {
        try {
            DB::beginTransaction();
            $product = $this->model->whereId($id)
                ->firstorfail();
            $product->update($data->except(['attribute_ids', 'name_ar', 'name_en', 'description_ar', 'description_en']));
            $translations = [
                'name' => [
                    'en' => $data->name_en,
                    'ar' =>  $data->name_ar,
                ],
                'description' => [
                    'en' => $data->description_en,
                    'ar' => $data->description_ar,
                ],
            ];
            $product->updateTranslations($translations);
            $product->attributes()->sync($data->attribute_ids);
            DB::commit();
            return $this->model;
        } catch (\Exception $e) {
            DB::rollback();
            throw  new UnexpectedException($e->getMessage());
        }
    }
}
