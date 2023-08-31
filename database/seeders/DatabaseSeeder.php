<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product\Attribute;
use App\Models\Product\AttributeValue;
use App\Models\Product\Product;
use Database\Factories\BusinessTypeFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $userPermission1 = Permission::create(['name' => 'create coupons']);
        $userPermission2 = Permission::create(['name' => 'view coupons']);
        $userPermission3 = Permission::create(['name' => 'delete coupons']);
        $userPermission4 = Permission::create(['name' => 'update coupons']);

        $userPermission1 = Permission::create(['name' => 'create products']);
        $userPermission2 = Permission::create(['name' => 'view products']);
        $userPermission3 = Permission::create(['name' => 'delete products']);
        $userPermission4 = Permission::create(['name' => 'update products']);

        $userPermission1 = Permission::create(['name' => 'create banners']);
        $userPermission2 = Permission::create(['name' => 'view banners']);
        $userPermission3 = Permission::create(['name' => 'delete banners']);
        $userPermission4 = Permission::create(['name' => 'update banners']);

        $userPermission1 = Permission::create(['name' => 'create activites']);
        $userPermission2 = Permission::create(['name' => 'view activites']);
        $userPermission3 = Permission::create(['name' => 'delete activites']);
        $userPermission4 = Permission::create(['name' => 'update activites']);

        $userPermission1 = Permission::create(['name' => 'create activites']);
        $userPermission2 = Permission::create(['name' => 'view activites']);
        $userPermission3 = Permission::create(['name' => 'delete activites']);
        $userPermission4 = Permission::create(['name' => 'update activites']);

        $userPermission2 = Permission::create(['name' => 'view settings']);
        $userPermission4 = Permission::create(['name' => 'update settings']);


        // // $this->call(SettingSeeder::class);
        //  $this->call(RolesAndPermissionsSeeder::class);
        // $this->call(CountriesTableSeeder::class);
        //  $this->call(StatesTableSeeder::class);
        // $this->call(CitiesTableSeeder::class);
        //  $this->call(CategoryTableSeeder::class);
        //  $this->call(AttributeSeeder::class);
        //  $this->call(BusinessTypeSeeder::class);
        //  $this->call(ProductSeeder::class);
        // // Product::factory()
        // //     ->count(10)->create();
    }
}
