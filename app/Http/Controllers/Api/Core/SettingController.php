<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function __invoke(Request $request)
    {
        $settingsFilePath = Storage::get('settings.json');
        $setting = json_decode($settingsFilePath, true);
        return responseSuccess($setting);
    }
}
