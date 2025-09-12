<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Menu\DashboardItemSeeder;
use Database\Seeders\Menu\MasterInternshipItemSeeder;
use Database\Seeders\Menu\MenuGroupSeeder;
use Database\Seeders\Menu\MenuItemSeeder;
use Database\Seeders\Menu\RolePermissionItemSeeder;
use Database\Seeders\Menu\SettingItemSeeder;
use Database\Seeders\Menu\UserItemSeeder;
use Database\Seeders\Permissions\SettingPermissionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MenuGroupSeeder::class,
            DashboardItemSeeder::class,
            MasterInternshipItemSeeder::class,
            UserItemSeeder::class,
            RolePermissionItemSeeder::class,
            MenuItemSeeder::class,
            SettingItemSeeder::class,
            UserSeeder::class,
            RoleAndPermissionSeeder::class,
            DepartmentSeeder::class,
            SelectionStepsSeeder::class,
            InternPositionSeeder::class,
            InternBatchSeeder::class,
            IndoRegionSeeder::class,
            InternLocationSeeder::class,
            WorldSeeder::class,
        ]);
    }
}
