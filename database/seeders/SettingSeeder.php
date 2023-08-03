<?php

namespace Database\Seeders;

use App\Models\Core\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    public function run(): void
    {
        $setting = Setting::all();
        if (count($setting->toArray()) == 0) {
            Setting::create([

                'about_us' => 'a',
                'phone' => '011',
                'email' => 'a@a.com',
                'fb_link' => 'a@a.com',
                'tw_link' => 'a@a.com',
                'inst_link' => 'a@a.com',
                'whatsapp' => 'a@a.com',
                'skype_link' => 'a@a.com',
                'linkedin_link' => 'a@a.com',
                'address' => 'a@a.com'
            ]);
        }
    }
}
