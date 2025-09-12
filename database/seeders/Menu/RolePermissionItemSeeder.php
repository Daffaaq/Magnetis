<?php

namespace Database\Seeders\Menu;

use App\Models\MenuGroup;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group = MenuGroup::where('name', 'Role Management')->first();

        if ($group) {
            MenuItem::insert([
                [
                    'name' => 'Role List',
                    'route' => 'role-and-permission/role',
                    'permission_name' => 'role.index',
                    'menu_group_id' => $group->id,
                ],
                [
                    'name' => 'Permission List',
                    'route' => 'role-and-permission/permission',
                    'permission_name' => 'permission.index',
                    'menu_group_id' => $group->id,
                ],
                [
                    'name' => 'Permission To Role',
                    'route' => 'role-and-permission/assign',
                    'permission_name' => 'assign.index',
                    'menu_group_id' => $group->id,
                ],
                [
                    'name' => 'User To Role',
                    'route' => 'role-and-permission/assign-user',
                    'permission_name' => 'assign.user.index',
                    'menu_group_id' => $group->id,
                ],
            ]);
        }
    }
}
