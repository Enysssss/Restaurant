<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'Create Dish']);
        Permission::firstOrCreate(['name' => 'Edit Dish']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo('Create Dish');
        $admin->givePermissionTo('Edit Dish');

        $user = User::find(1);
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
