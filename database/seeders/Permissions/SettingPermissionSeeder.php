<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SettingPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permission
        Permission::create(['name' => 'setting.management']);
        Permission::create(['name' => 'log-activity.index']);
        Permission::create(['name' => 'log-activity.create']);
        Permission::create(['name' => 'log-activity.edit']);
        Permission::create(['name' => 'log-activity.destroy']);
        Permission::create(['name' => 'log-activity.import']);
        Permission::create(['name' => 'log-activity.export']);
    }
}
