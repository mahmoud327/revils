<?php

namespace Database\Seeders;

use App\Models\Core\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            [
                'name' => [
                    'en' => 'All',
                    'ar' => 'الكل',
                ],
                'description' => [
                    'en' => 'All',
                    'ar' => 'الكل',
                ],

                'color' => 'red',
            ],
            [
                'name' => [
                    'en' => 'Home & kitchen',
                    'ar' => 'المنزل والمطبخ',
                ],
                'description' => [
                    'en' => 'Home & kitchen',
                    'ar' => 'المنزل والمطبخ',
                ],
                'color' => 'red',

            ],
            [
                'name' => [
                    'en' => 'Jewelry & Accessories',
                    'ar' => 'مجوهرات و إكسسوارات',
                ],
                'description' => [
                    'en' => 'Jewelry & Accessories',
                    'ar' => 'مجوهرات و إكسسوارات',
                ],
                'color' => 'blue',

            ],
            [

                'name' => [
                    'en' => 'Bags & Wallets',
                    'ar' => 'الشنط و المحافظ',
                ],
                'description' => [
                    'en' => 'Bags & Wallets',
                    'ar' => 'الشنط و المحافظ',
                ],
                'color' => 'green',

            ],

            [

                'name' => [
                    'en' => 'Outdoor & Picnic',
                    'ar' => 'الحديقة و الطلعات',
                ],
                'description' => [
                    'en' => 'Outdoor & Picnic',
                    'ar' => 'الحديقة و الطلعات',
                ],
                'color' => 'pink',

            ],

            [

                'name' => [
                    'en' => 'Art & Decor',
                    'ar' => 'الفنون والديكورات',
                ],
                'description' => [
                    'en' => 'Art & Decor',
                    'ar' => 'الفنون والديكورات',
                ],
                'color' => 'red',


            ],
            [
                'name' => [
                    'en' => 'Clothes',
                    'ar' => 'ملابس وتصاميم',
                ],
                'description' => [
                    'en' => 'Clothes',
                    'ar' => 'ملابس وتصاميم',
                ],
                'color' => 'yellow',

            ],
            [

                'name' => [
                    'en' => 'Perfumes & Bukhoor',
                    'ar' => 'العطور والبخور',
                ],
                'description' => [
                    'en' => 'Perfumes & Bukhoor',
                    'ar' => 'العطور والبخور',
                ],
                'color' => 'red',


            ]
        ];

        foreach ($categories as $categoryData) {
            $category = new Category();
            $category->color = $categoryData['color'];


            $category->save();

            foreach ($categoryData['name'] as $locale => $name) {
                $category->translateOrNew($locale)->name = $name;
            }
            foreach ($categoryData['description'] as $locale => $description) {
                $category->translateOrNew($locale)->description = $description;
            }


            $category->save();
        }
    }
}
