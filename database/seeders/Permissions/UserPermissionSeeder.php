<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'user.management']);
        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.destroy']);
        Permission::create(['name' => 'user.import']);
        Permission::create(['name' => 'user.export']);
    }
}
