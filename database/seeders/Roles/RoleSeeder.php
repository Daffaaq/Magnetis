<?php

namespace Database\Seeders\Roles;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleUser = Role::create(['name' => 'user']);
        $roleUser->givePermissionTo([
            'dashboard',
            'user.management',
            'user.index',
        ]);

        $roleAdmin = Role::create(['name' => 'super-admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        $admin = User::find(1);
        $admin?->assignRole('super-admin');

        $user = User::find(2);
        $user?->assignRole('user');
    }
}
