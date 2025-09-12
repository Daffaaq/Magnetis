<?php

namespace Database\Seeders\Menu;

use App\Models\MenuGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuGroup::insert(
            [
                [
                    'name' => 'Dashboard',
                    'icon' => 'fas fa-tachometer-alt',
                    'permission_name' => 'dashboard',
                ],
                [
                    'name' => 'Master Management',
                    'icon' => 'fas fa-graduation-cap',
                    'permission_name' => 'master.management',
                ],
                [
                    'name' => 'Users Management',
                    'icon' => 'fas fa-users',
                    'permission_name' => 'user.management',
                ],
                [
                    'name' => 'Role Management',
                    'icon' => 'fas fa-user-tag',
                    'permission_name' => 'role.permission.management',
                ],
                [
                    'name' => 'Menu Management',
                    'icon' => 'fas fa-bars',
                    'permission_name' => 'menu.management',
                ],
                [
                    'name' => 'Setting Management',
                    'icon' => 'fas fa-cogs',
                    'permission_name' => 'setting.management',
                ]
            ]
        );
    }
}
