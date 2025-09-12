<?php

namespace Database\Seeders\Menu;

use App\Models\MenuGroup;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group = MenuGroup::where('name', 'Users Management')->first();

        if ($group) {
            MenuItem::create([
                'name' => 'User List',
                'route' => 'user-management/user',
                'permission_name' => 'user.index',
                'menu_group_id' => $group->id,
            ]);
        }
    }
}
