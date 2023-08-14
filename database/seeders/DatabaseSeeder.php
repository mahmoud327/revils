<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product\Attribute;
use App\Models\Product\AttributeValue;
use App\Models\Product\Product;
use Database\Factories\BusinessTypeFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // $this->call(SettingSeeder::class);
        // $this->call(RolesAndPermissionsSeeder::class);
        // $this->call(CountriesTableSeeder::class);
        // $this->call(StatesTableSeeder::class);
        // $this->call(CitiesTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(AttributeSeeder::class);
        // $this->call(BusinessTypeSeeder::class);

         $attributes = Attribute::select('id')
            ->get();
        $attribute_values = AttributeValue::whereIn('attribute_id', $attributes)
            ->inRandomOrder()
            ->first()
            ->id;

        Product::factory()
            ->count(3)->make();
    }
}
