<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SelectionStepsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('selection_steps')->insert([
            [
                'name_selection_steps' => 'Administrative Screening',
                'description_selection_steps' => 'Tahap awal dalam proses seleksi yang memeriksa kelengkapan dokumen administrasi pelamar seperti CV, surat lamaran, dan dokumen pendukung lainnya untuk memastikan kualifikasi dasar terpenuhi.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_selection_steps' => 'Live Coding',
                'description_selection_steps' => 'Tes keterampilan pemrograman secara langsung untuk mengukur kemampuan teknis pelamar dalam menulis kode yang efisien dan benar.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_selection_steps' => 'Live Excel',
                'description_selection_steps' => 'Penilaian kemampuan menggunakan Microsoft Excel secara langsung, termasuk penggunaan rumus, pivot table, dan analisis data.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_selection_steps' => 'Live Design',
                'description_selection_steps' => 'Tes keterampilan desain grafis atau UI/UX secara langsung untuk menilai kreativitas dan pemahaman pelamar terhadap prinsip desain.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_selection_steps' => 'Presentation Social Media',
                'description_selection_steps' => 'Tahap presentasi di mana pelamar memaparkan strategi atau ide terkait pengelolaan media sosial dan pemasaran digital.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_selection_steps' => 'Psikotes',
                'description_selection_steps' => 'Tes psikologi untuk mengevaluasi aspek kepribadian, logika, dan stabilitas emosional pelamar.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_selection_steps' => 'Focus Group Discussion (FGD)',
                'description_selection_steps' => 'Simulasi diskusi kelompok yang bertujuan menilai kemampuan komunikasi, kepemimpinan, dan kerja sama tim pelamar.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_selection_steps' => 'Study Case',
                'description_selection_steps' => 'Analisis kasus nyata yang diberikan kepada pelamar untuk menilai kemampuan berpikir kritis dan problem solving.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_selection_steps' => 'English Proficiency Test',
                'description_selection_steps' => 'Tes kemampuan bahasa Inggris untuk menilai keterampilan berkomunikasi secara profesional, baik secara lisan maupun tulisan.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_selection_steps' => 'Interview HR',
                'description_selection_steps' => 'Sesi wawancara dengan tim Human Resources (HR) untuk menilai kepribadian, motivasi, soft skills, serta kecocokan pelamar dengan budaya perusahaan dan nilai-nilainya.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_selection_steps' => 'Interview User',
                'description_selection_steps' => 'Wawancara langsung dengan calon atasan atau user dari divisi terkait untuk mengevaluasi kemampuan teknis, pemahaman posisi, dan potensi kontribusi pelamar di tim.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_selection_steps' => 'Medical Check Up',
                'description_selection_steps' => 'Pemeriksaan kesehatan untuk memastikan pelamar dalam kondisi fisik yang memenuhi standar perusahaan sebelum diterima bekerja.',
                'status_selection_steps' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
