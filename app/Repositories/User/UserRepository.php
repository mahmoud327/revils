<?php


namespace App\Repositories\User;

use App\Exceptions\PasswordInvaild;
use App\Exceptions\UnexpectedException;
use App\Models\Core\MediaCenter;
use App\Models\Product\Attribute;
use App\Models\Product\Product;
use App\Repositories\Base\BaisRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function sellerUpdateProfile($request)
    {
        try {
            auth()->user()->update([
                'email' => $request->email,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name
            ]);
            auth()->user()->businessProfile()->update($request->except(['email', 'last_name', 'first_name']));
            return   auth()->user()->load('businessProfile');
        } catch (\Exception $e) {
            Log::warning($e);
            throw new UnexpectedException($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
    public function customerUpdateProfile($request)
    {
        try {
            auth()->user()->update([
                'email' => $request->email,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name
            ]);
            auth()->user()->userProfile()->update($request->except(['email', 'last_name', 'first_name']));
            return   auth()->user()->load('userProfile');
        } catch (\Exception $e) {
            Log::warning($e);
            throw new UnexpectedException($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
    public function changePassword($request)
    {
        if (Hash::check($request->old_password, auth()->user()->password)) {
            auth()->user()->update([
                'password' => $request->password
            ]);
        } else {
            throw  new PasswordInvaild('password not correct');
        }
    }
}
