<?php

namespace Database\Seeders;

use App\Models\Core\BusinessType;
use Illuminate\Database\Seeder;

class BusinessTypeSeeder extends Seeder
{


    public function run()
    {
        $businessTypes = [
            [
                'name' => [
                    'en' => 'Product',
                    'ar' => 'المنتج',
                ],

                'type' => 1,
                'parent_id' => 0


            ],
            [
                'name' => [
                    'en' => 'Home & kitchen',
                    'ar' => 'المنزل والمطبخ',
                ],
                'type' => 0,
                'parent_id' => 7


            ],
            [
                'name' => [
                    'en' => 'Jewelry & Accessories',
                    'ar' => 'مجوهرات و إكسسوارات',
                ],
                'type' => 0,
                'parent_id' => 7

            ],
            [

                'name' => [
                    'en' => 'Bags & Wallets',
                    'ar' => 'الشنط و المحافظ',
                ],
                'type' => 0,
                'parent_id' => 7



            ],

            [

                'name' => [
                    'en' => 'Outdoor & Picnic',
                    'ar' => 'الحديقة و الطلعات',
                ],
                'type' => 0,
                'parent_id' => 7


            ],

            [

                'name' => [
                    'en' => 'Art & Decor',
                    'ar' => 'الفنون والديكورات',
                ],
                'type' => 0,
                'parent_id' => 7


            ],
            [
                'name' => [
                    'en' => 'Clothes',
                    'ar' => 'ملابس وتصاميم',
                ],
                'type' => 0,
                'parent_id' => 7

            ],
            [

                'name' => [
                    'en' => 'Perfumes & Bukhoor',
                    'ar' => 'العطور والبخور',
                ],
                'type' => 0,
                'parent_id' => 7


            ]
        ];

        foreach ($businessTypes as $businessTypeData) {
            $businessType = new BusinessType();
            $businessType->parent_id = $businessTypeData['parent_id'];
            $businessType->name = $businessTypeData['name'];


            $businessType->save();



            $businessType->save();
        }
    }
}
