<?php

namespace Database\Seeders\Menu;

use App\Models\MenuGroup;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DashboardItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group = MenuGroup::where('name', 'Dashboard')->first();

        if ($group) {
            MenuItem::create([
                'name' => 'Dashboard',
                'route' => 'dashboard',
                'permission_name' => 'dashboard',
                'menu_group_id' => $group->id,
            ]);
        }
    }
}
