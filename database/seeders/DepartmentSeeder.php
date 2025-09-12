<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name_departments' => 'Information Technology',
                'description_departments' => 'Departemen Teknologi Informasi bertanggung jawab atas seluruh infrastruktur teknologi organisasi, mulai dari pengembangan perangkat lunak, administrasi jaringan, keamanan siber, hingga pemeliharaan sistem. Tim ini memastikan semua alat digital, perangkat keras, dan sistem berjalan dengan optimal dan aman untuk mendukung kelancaran operasional dan pencapaian tujuan strategis perusahaan. Selain itu, departemen ini juga terus mengikuti perkembangan teknologi terbaru untuk mengimplementasikan solusi inovatif yang dapat meningkatkan efisiensi kerja dan memberikan keunggulan kompetitif.',
                'status_departments' => 'active'
            ],
            [
                'name_departments' => 'Finance',
                'description_departments' => 'The Finance Department plays a critical role in managing the organization’s financial health by overseeing comprehensive activities such as budgeting, financial planning, accounting, auditing, payroll, tax compliance, and financial reporting. This department ensures adherence to regulatory requirements and financial standards, while actively monitoring cash flows, managing investments, and controlling costs to maintain liquidity and profitability. The finance team provides strategic financial analysis and forecasting that informs leadership decision-making and drives sustainable growth. It collaborates closely with other departments to allocate resources effectively, assess risks, and implement robust internal controls to prevent fraud and ensure fiscal responsibility throughout the organization.',
                'status_departments' => 'active'
            ],
            [
                'name_departments' => 'Human Resources',
                'description_departments' => 'The Human Resources Department is dedicated to attracting, developing, and retaining top talent by managing the entire employee lifecycle from recruitment and onboarding to performance management, training, career development, and offboarding. It fosters a positive workplace culture by implementing policies that promote diversity, equity, inclusion, and employee well-being. HR also handles compensation and benefits administration, employee relations, conflict resolution, and compliance with labor laws and organizational standards. Through continuous engagement and feedback mechanisms, the department ensures that employee needs and concerns are addressed promptly, contributing to high job satisfaction and productivity. Moreover, HR collaborates with leadership to align workforce strategies with organizational goals, driving a motivated and agile workforce.',
                'status_departments' => 'active'
            ],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}
