<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class MenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'menu.management']);
        Permission::create(['name' => 'menu-group.index']);
        Permission::create(['name' => 'menu-group.create']);
        Permission::create(['name' => 'menu-group.edit']);
        Permission::create(['name' => 'menu-group.destroy']);

        //menu item 
        Permission::create(['name' => 'menu-item.index']);
        Permission::create(['name' => 'menu-item.create']);
        Permission::create(['name' => 'menu-item.edit']);
        Permission::create(['name' => 'menu-item.destroy']);
    }
}
