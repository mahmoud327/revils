<?php

namespace Database\Seeders;

use App\Models\Core\BusinessType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $roles = Role::all();
        if(count($roles->toArray())==0)
        {
            $data =array(
                array(
                    'name' => 'customer',
                    'guard_name' => 'web',
                ),
                array(
                    'seller' => 'seller',
                    'guard_name' => 'web',
                ),
            );
            Role::insert($data);
        }
    }
}
