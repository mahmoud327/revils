<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Misc

        // USER MODEL


        $userPermission1 = Permission::create(['name' => 'view Business Types']);
        $userPermission2 = Permission::create(['name' => 'create Business Type']);
        $userPermission3 = Permission::create(['name' => 'update Business Type']);
        $userPermission3 = Permission::create(['name' => 'delete Business Type']);

        $userPermission1 = Permission::create(['name' => 'create category']);
        $userPermission2 = Permission::create(['name' => 'view categories']);
        $userPermission3 = Permission::create(['name' => 'delete category']);
        $userPermission4 = Permission::create(['name' => 'update category']);

        // ROLE MODEL
        $rolePermission1 = Permission::create(['name' => 'create role']);
        $rolePermission2 = Permission::create(['name' => 'view roles']);
        $rolePermission3 = Permission::create(['name' => 'update role']);
        $rolePermission4 = Permission::create(['name' => 'delete role']);

        // PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'view permissions']);
        $permission2 = Permission::create(['name' => 'create permission']);
        $permission3 = Permission::create(['name' => 'update permission']);
        $permission4 = Permission::create(['name' => 'delete permission']);
        // PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'view payments']);
        $permission2 = Permission::create(['name' => 'create payments']);
        $permission3 = Permission::create(['name' => 'update payments']);
        $permission4 = Permission::create(['name' => 'delete payments']);



        // ADMINS
        $adminPermission1 = Permission::create(['name' => 'view admins']);
        $adminPermission2 = Permission::create(['name' => 'update admin']);
        $adminPermission2 = Permission::create(['name' => 'create admin']);
        $adminPermission2 = Permission::create(['name' => 'delete admin']);
        // CREATE ROLES

        // ADMINS
        $countryPermission1 = Permission::create(['name' => 'view countries']);
        $countryPermission2 = Permission::create(['name' => 'update country']);
        $countryPermission2 = Permission::create(['name' => 'create country']);
        $countryPermission2 = Permission::create(['name' => 'delete country']);
        // CREATE ROLES
        // ADMINS
        $attributesPermission1 = Permission::create(['name' => 'view attributes']);
        $attributesPermission2 = Permission::create(['name' => 'update attributes']);
        $attributesPermission2 = Permission::create(['name' => 'create attributes']);
        $attributesPermission2 = Permission::create(['name' => 'delete attributes']);
        // CREATE ROLES
        // ADMINS
        $attributevaluesPermission1 = Permission::create(['name' => 'view attribute values']);
        $attributevaluesPermission2 = Permission::create(['name' => 'update attribute values']);
        $attributevaluesPermission2 = Permission::create(['name' => 'create attribute values']);
        $attributevaluesPermission2 = Permission::create(['name' => 'delete attribute values']);
        // CREATE ROLES

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



        $userPermission2 = Permission::create(['name' => 'view settings']);
        $userPermission4 = Permission::create(['name' => 'update settings']);


        // ADMINS
        $statePermission1 = Permission::create(['name' => 'view states']);
        $statePermission2 = Permission::create(['name' => 'update state']);
        $statePermission2 = Permission::create(['name' => 'create state']);
        $statePermission2 = Permission::create(['name' => 'delete state']);
        // ADMINS
        $cityPermission1 = Permission::create(['name' => 'view cities']);
        $cityPermission2 = Permission::create(['name' => 'update city']);
        $cityPermission2 = Permission::create(['name' => 'create city']);
        $cityPermission2 = Permission::create(['name' => 'delete city']);
        // // CREATE ROLES

        $superAdminRole = Role::create(['name' => 'super-admin'])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $userPermission1,
            $countryPermission1,
            $countryPermission2,
            $statePermission1,
            $statePermission2,
            $cityPermission1,
            $cityPermission2,
            $attributevaluesPermission2,
            $attributevaluesPermission1,
            $attributesPermission2,
            $attributesPermission1


        ]);
        $adminRole = Role::create(['name' => 'admin'])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $userPermission1,
        ]);
        $moderatorRole = Role::create(['name' => 'moderator'])->syncPermissions([
            $userPermission2,
            $rolePermission2,
            $permission2,
            $adminPermission1,
        ]);
        $developerRole = Role::create(['name' => 'developer'])->syncPermissions([
            $adminPermission1,
        ]);

        // CREATE ADMINS & USERS
        User::create([
            'name' => 'super admin',
            'username' => 'super-admin',
            'mobile' => '+9923443543',
            'email' => 'super@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($superAdminRole);


    }
}
