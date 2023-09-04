<?php

use App\Models\Core\Coupon;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Auth;
use Spatie\Image\Image;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;

function responseSuccess($data, ?string $message = "data loaded successfully", int $code = 200)
{
    return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
    ], $code);
}

function responseError(mixed $message, ?int $code)
{
    return response()->json([
        'status' => false,
        'message' => $message,
    ], $code);
}

function getTranslation($attribute_en, $attribute_ar)
{
    if (app()->getLocale() == "ar") {
        return $attribute_ar;
    }
    return $attribute_en;
}

if (!function_exists('uploadMedia')) {
    /**
     * @param $result
     * @param $message
     */
    function uploadMedia(HasMedia $model, $images, $key = 'images')
    {
        if (blank($images)) {
            return;
        }

        $modelMedia = $model->getMedia($key);
        $position = optional($modelMedia->sortDesc()->first())->order_column ?? 0;
        $isModelHasMedia = $modelMedia->count() > 0;

        $dirName = Str::snake(Str::plural(class_basename($model)));

        $tempPath = storage_path("tmp/uploads/{$dirName}");

        collect($images)->each(function (UploadedFile $image) use ($model, &$position, $dirName, $tempPath, $key, $isModelHasMedia) {
            $fileName = $model->id . time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $originalImage = $image->move($tempPath, $fileName);

            $image = Image::load($originalImage->getRealPath())
                ->width(1200)
                // watermark
                ->save();

            $position = ++$position;
            $media = $model->addMedia($originalImage->getRealPath())
                ->setName("/uploads/{$dirName}/{$fileName}")
                ->setFileName("/uploads/{$dirName}/{$fileName}")
                ->setOrder($position);

            if (!$isModelHasMedia && $position == 1) {
                $media->withCustomProperties(['isFeatured' => true]);
            }

            $media->toMediaCollection($key);
        });
    }


    if (!function_exists('getTotalAmount')) {

        function getTotalAmount($data)
        {
            $total = 0;
            foreach ($data as $item) {
                $product = Product::find($item->product_id);
                $total += $product->price * $item->quantity; // missing the shipping cost
            }
            return $total;
        }
    }

    if (!function_exists('getTotalAmountAfterDiscount')) {

        function getTotalAmountAfterDiscount($total)
        {
            if (request()->coupon_id) {
                $coupon = Coupon::find(request()->coupon_id);

                if ($coupon) {
                    $total -= $coupon->discount($total);
                }
            }

            return  $total < 0 ? 0 : $total;
        }
    }

    if (!function_exists('getUserIdToSendNotification')) {

        function getUserIdToSendNotification($object)
        {
            if (is_object($object)) {
                if (Auth::id() == $object->user_id) {
                    return false;
                }
                return $object->user_id;
            }
            return false;
        }
    }
}
