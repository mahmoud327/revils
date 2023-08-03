<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;
use App\Http\Resources\Core\SeetingResource;
use App\Repositories\Core\Setting\SettingRepositoryInterface;

class SettingController extends Controller
{
    public function __construct(public SettingRepositoryInterface $settingRepository){}

    public function show()
    {
        $setting = SeetingResource::make($this->settingRepository->find(1));
        return responseSuccess($setting);
    }



}
