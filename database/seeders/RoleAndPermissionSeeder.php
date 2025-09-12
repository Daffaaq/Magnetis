<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Database\Seeders\Menu\SettingItemSeeder;
use Database\Seeders\Permissions\AssignPermissionSeeder;
use Database\Seeders\Permissions\DashboardPermissionSeeder;
use Database\Seeders\Permissions\MasterInternshipPermissionSeeder;
use Database\Seeders\Permissions\MenuPermissionSeeder;
use Database\Seeders\Permissions\RolePermissionSeeder;
use Database\Seeders\Permissions\SettingPermissionSeeder;
use Database\Seeders\Permissions\UserPermissionSeeder;
use Database\Seeders\Roles\RoleSeeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->call([
            DashboardPermissionSeeder::class,
            MasterInternshipPermissionSeeder::class,
            UserPermissionSeeder::class,
            RolePermissionSeeder::class,
            AssignPermissionSeeder::class,
            MenuPermissionSeeder::class,
            SettingPermissionSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
