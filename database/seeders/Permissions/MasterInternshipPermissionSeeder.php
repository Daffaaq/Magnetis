<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class MasterInternshipPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'master.management']);

        //internship-batch
        Permission::create(['name' => 'internship-batch.index']);
        Permission::create(['name' => 'internship-batch.show']);
        Permission::create(['name' => 'internship-batch.create']);
        Permission::create(['name' => 'internship-batch.edit']);
        Permission::create(['name' => 'internship-batch.destroy']);

        //department
        Permission::create(['name' => 'department.index']);
        Permission::create(['name' => 'department.show']);
        Permission::create(['name' => 'department.create']);
        Permission::create(['name' => 'department.edit']);
        Permission::create(['name' => 'department.destroy']);

        //recruitment-step
        Permission::create(['name' => 'recruitment-step.index']);
        Permission::create(['name' => 'recruitment-step.show']);
        Permission::create(['name' => 'recruitment-step.create']);
        Permission::create(['name' => 'recruitment-step.edit']);
        Permission::create(['name' => 'recruitment-step.destroy']);

        //intern-position
        Permission::create(['name' => 'intern-position.index']);
        Permission::create(['name' => 'intern-position.show']);
        Permission::create(['name' => 'intern-position.create']);
        Permission::create(['name' => 'intern-position.edit']);
        Permission::create(['name' => 'intern-position.destroy']);

        //intern-locations
        Permission::create(['name' => 'intern-locations.index']);
        Permission::create(['name' => 'intern-locations.show']);
        Permission::create(['name' => 'intern-locations.create']);
        Permission::create(['name' => 'intern-locations.edit']);
        Permission::create(['name' => 'intern-locations.destroy']);

        //internship-offering
        Permission::create(['name' => 'internship-offering.index']);
        Permission::create(['name' => 'internship-offering.show']);
        Permission::create(['name' => 'internship-offering.create']);
        Permission::create(['name' => 'internship-offering.edit']);
        Permission::create(['name' => 'internship-offering.destroy']);
        Permission::create(['name' => 'internship-offering.selection-steps.index']);
        Permission::create(['name' => 'internship-offering.selection-steps.create']);
        Permission::create(['name' => 'internship-offering.selection-steps.show']);
        Permission::create(['name' => 'internship-offering.selection-steps.edit']);
        Permission::create(['name' => 'internship-offering.selection-steps.destroy']);
    }
}
