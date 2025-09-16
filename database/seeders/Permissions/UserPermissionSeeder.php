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

        //mentor
        Permission::create(['name' => 'mentor.index']);
        Permission::create(['name' => 'mentor.create']);
        Permission::create(['name' => 'mentor.show']);
        Permission::create(['name' => 'mentor.edit']);
        Permission::create(['name' => 'mentor.destroy']);
        Permission::create(['name' => 'mentor.import']);
        Permission::create(['name' => 'mentor.export']);
        Permission::create(['name' => 'mentor.batch.assignment.index']);
        Permission::create(['name' => 'mentor.batch.assignment.create']);
        Permission::create(['name' => 'mentor.batch.assignment.show']);
        Permission::create(['name' => 'mentor.batch.assignment.edit']);
        Permission::create(['name' => 'mentor.batch.assignment.destroy']);
    }
}
