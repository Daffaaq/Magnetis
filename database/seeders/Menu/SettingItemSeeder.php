<?php

namespace Database\Seeders\Menu;

use App\Models\MenuGroup;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group = MenuGroup::where('name', 'Setting Management')->first();

        if ($group) {
            MenuItem::create([
                'name' => 'Log Activity List',
                'route' => 'setting-management/log-activity',
                'permission_name' => 'log-activity.index',
                'menu_group_id' => $group->id,
            ]);
        }
    }
}
