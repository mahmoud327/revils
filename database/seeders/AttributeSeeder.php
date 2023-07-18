<?php

namespace Database\Seeders;

use App\Models\Product\Attribute;
use App\Models\Product\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        $attributes = [
            'Color' => [
                'en' => 'Color',
                'ar' => 'اللون',
            ],
            'Size' => [
                'en' => 'Size',
                'ar' => 'الحجم',
            ],
            'Size' => [
                'en' => 'Size',
                'ar' => 'الحجم',
            ],
            'Style' => [
                'en' => 'Style',
                'ar' => 'الستايل',
            ],
            'Gender' => [
                'en' => 'Gender',
                'ar' => 'الجنس',
            ],
            'Produced as' => [
                'en' => 'Produced as',
                'ar' => 'صناعة يدوي',
            ],
        ];

        foreach ($attributes as $attribute) {


            $attributeModel = Attribute::create(['name' => $attribute]);



            $attributeModel->save();
        }

        $attributeValues = [
            'Color' => [
                '#FF0000' => [
                    'en' => '#FF0000',
                    'ar' => '#FF0000',
                ],
                '#000000' => [
                    'en' => '#000000',
                    'ar' => '#000000',
                ],
                '#339933' => [
                    'en' => '#339933',
                    'ar' => '#339933 ',
                ],
                '#e600e6' => [
                    'en' => '#e600e6',
                    'ar' => '#e600e6',
                ],
                '#ff6600' => [
                    'en' => '#ff6600',
                    'ar' => '#ff6600',
                ],
                '#6699ff' => [
                    'en' => '#6699ff',
                    'ar' => '#6699ff',
                ],
                // Add more attribute values and translations as needed
            ],
            'Size' => [
                'XS' => [
                    'en' => 'XS',
                    'ar' => 'صغير جد',
                ],
                'S' => [
                    'en' => 'S',
                    'ar' => 'صغير',
                ],
                'M' => [
                    'en' => 'M',
                    'ar' => 'وسط ',
                ],
                'L' => [
                    'en' => 'L',
                    'ar' => 'كبير',
                ],
                'XL' => [
                    'en' => 'XL',
                    'ar' => 'اكبر',
                ],
                'XXL' => [
                    'en' => 'XXL',
                    'ar' => 'كبير جدا',
                ],
                'One Size' => [
                    'en' => 'One Size',
                    'ar' => 'حجم واحد',
                ],
                'No Size' => [
                    'en' => 'No Size',
                    'ar' => 'لا يوجد حجم',
                ],
                // Add more attribute values and translations as needed
            ],





            'Style' => [

                'Modern' => [
                    'en' => 'Modern',
                    'ar' => 'عصرى',
                ],
                'Classic' => [
                    'en' => 'Classic',
                    'ar' => 'كلاسيكى',
                ],
                'Elegant' => [
                    'en' => 'Elegant',
                    'ar' => 'أنيق',
                ],
                'Casual' => [
                    'en' => 'Casual',
                    'ar' => 'كاجول',
                ],
                'Formal' => [
                    'en' => 'Formal',
                    'ar' => 'رسمي',
                ],
                'Fun' => [
                    'en' => 'Fun',
                    'ar' => 'عفوي',
                ],
                'Sporty' => [
                    'en' => 'Sporty',
                    'ar' => 'رياضي',
                ],
                'Artsy' => [
                    'en' => 'Artsy',
                    'ar' => 'ذائقة فنيه',
                ],
                'Night' => [
                    'en' => 'Night',
                    'ar' => 'سهر',
                ],

                'Daily' => [
                    'en' => 'Daily',
                    'ar' => 'يومي',
                ],
                'Unique' => [
                    'en' => 'Unique',
                    'ar' => 'مميز',
                ],
                'Trendy' => [
                    'en' => 'Trendy',
                    'ar' => 'ترندي',
                ],
                'Stylish' => [
                    'en' => 'Stylish',
                    'ar' => 'ستايل أنيق',
                ],
                'Fashion' => [
                    'en' => 'Fashion',
                    'ar' => 'موضة',
                ],
                'Saudi' => [
                    'en' => 'Saudi',
                    'ar' => 'ستايل سعودي',
                ],

                'Traditional' => [
                    'en' => 'Traditional',
                    'ar' => 'تقليدي',
                ],
                'Flourish' => [
                    'en' => 'Flourish',
                    'ar' => 'زهور',
                ],
                'Fruity' => [
                    'en' => 'Fruity',
                    'ar' => 'فواكهي',
                ],
                'Middle' => [
                    'en' => 'Middle',
                    'ar' => ' أوسطي',
                ],
                'Eastern' => [
                    'en' => 'Eastern',
                    'ar' => 'شرق',
                ],
                'Arabic' => [
                    'en' => 'Arabic',
                    'ar' => 'عربى',
                ],
                'No Specification' => [
                    'en' => 'No Specification',
                    'ar' => 'بدون خاصية',
                ],
                // Add more attribute values and translations as needed
            ],

            'Gender' => [
                'All' => [
                    'en' => 'All',
                    'ar' => 'الكل',
                ],
                'Male' => [
                    'en' => 'Male',
                    'ar' => 'ذكر',
                ],
                'Female' => [
                    'en' => 'Female',
                    'ar' => 'أنثى ',
                ],
                'Male/Female' => [
                    'en' => 'Male/Female',
                    'ar' => 'ذكر/أنثى',
                ],
                'Children' => [
                    'en' => 'Children',
                    'ar' => 'أطفال',
                ]
                // Add more attribute values and translations as needed
            ],




            'Produced as' => [
                'Handicraft' => [
                    'en' => 'Handicraft',
                    'ar' => ' حرفة يدوية',
                ],
                'Handmade' => [
                    'en' => 'Handmade',
                    'ar' => 'صناعة يدوية',
                ],
                'Local Made' => [
                    'en' => 'Local Made',
                    'ar' => 'صناعة محلية ',
                ],
                'Manufactured' => [
                    'en' => 'Manufactured',
                    'ar' => 'تصنيع تقني',
                ],
                'International Designed' => [
                    'en' => 'International Designed',
                    'ar' => 'تصنيع دولي',
                ],
                'Local Design' => [
                    'en' => 'Local Design',
                    'ar' => 'تصميم محلي',
                ],
                'Cellected' => [
                    'en' => 'Cellected',
                    'ar' => 'تجميع',
                ],
                'Touches' => [
                    'en' => 'Touches',
                    'ar' => 'لمسات إضافيه',
                ],
                'Painting' => [
                    'en' => 'Painting',
                    'ar' => 'طلاء ',
                ],
                'Draw' => [
                    'en' => 'Draw',
                    'ar' => 'وفنون،رسم',
                ],
                'Developed' => [
                    'en' => 'Developed',
                    'ar' => 'تطوير',
                ],
                'Sculptured' => [
                    'en' => 'Sculptured',
                    'ar' => 'منحوتة',
                ],
                '3D Printing' => [
                    'en' => '3D Printing',
                    'ar' => 'نحت،طباعة ثلاثية الأبعاد',
                ],
                'No Specification' => [
                    'en' => 'No Specification',
                    'ar' => 'لايوجد خاصيه',
                ]

                // Add more attribute values and translations as needed
            ],
        ];

        foreach ($attributeValues as $attribute => $values) {
            $attributeModel = Attribute::where('name->en', $attribute)->orwhere('name->ar', $attribute)->firstOrFail();

            foreach ($values as $value) {
                $valueModel = AttributeValue::create(['attribute_id' => $attributeModel->id, 'value' => $value]);


                $valueModel->save();
            }
        }
    }
}
