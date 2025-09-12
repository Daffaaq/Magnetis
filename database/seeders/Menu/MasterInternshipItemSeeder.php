<?php

namespace Database\Seeders\Menu;

use App\Models\MenuGroup;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterInternshipItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group = MenuGroup::where('name', 'Master Management')->first();

        if ($group) {
            MenuItem::insert([
                [
                    'name' => 'Internship Batch List',
                    'route' => 'master-management/internship-batch',
                    'permission_name' => 'internship-batch.index',
                    'menu_group_id' => $group->id,
                ],
                [
                    'name' => 'Department List',
                    'route' => 'master-management/department',
                    'permission_name' => 'department.index',
                    'menu_group_id' => $group->id,
                ],
                [
                    'name' => 'Recruitment Steps',
                    'route' => 'master-management/recruitment-step',
                    'permission_name' => 'recruitment-step.index',
                    'menu_group_id' => $group->id,
                ],
                [
                    'name' => 'Intern Position List',
                    'route' => 'master-management/intern-position',
                    'permission_name' => 'intern-position.index',
                    'menu_group_id' => $group->id,
                ],
                [
                    'name' => 'Intern Locations',
                    'route' => 'master-management/intern-locations',
                    'permission_name' => 'intern-locations.index',
                    'menu_group_id' => $group->id,
                ],
                [
                    'name' => 'Internship Offering',
                    'route' => 'master-management/internship-offering',
                    'permission_name' => 'internship-offering.index',
                    'menu_group_id' => $group->id,
                ],

            ]);
        }
    }
}
