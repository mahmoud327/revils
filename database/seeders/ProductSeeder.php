<?php

namespace Database\Seeders;

use App\Models\Core\BusinessType;
use App\Models\Core\Category;
use App\Models\Product\Attribute;
use App\Models\Product\AttributeValue;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'user_id' => User::first()->id,
            'attribute_id' => Attribute::first()->id,
            'category_id' => Category::orderby('id', 'asc')->first()->id
        ];
        $attributes = [
            [
                'attribute_id' => $data['attribute_id'],
                'attribute_value_id' => AttributeValue::whereAttributeId($data['attribute_id'])->first()->id
            ]
        ];
        for ($i = 1; $i <= 100; $i++) {
            $products = [
                'name' => [
                    'en' => 'All' . $i++,
                    'ar' => 'الكل' . $i++,
                ],
                'description' => [
                    'en' => 'All' . $i++,
                    'ar' => 'الكل' . $i++,
                ],
                'item_type' => 'test' . $i++,
                'price' => 20 . $i++,
                'quantity' => 20 . $i++
            ];
            $product = new Product();
            $product->description = $products['description'];
            $product->name = $products['name'];
            $product->category_id = $data['category_id'];
            $product->item_type = $products['item_type'];
            $product->status = 1;
            $product->price = $products['price'];
            $product->quantity = $products['quantity'];
            $product->user_id = $data['user_id'];
            $product->save();
            $product->attributes()->attach($attributes);
        }
    }
}
