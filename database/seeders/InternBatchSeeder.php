<?php

namespace Database\Seeders;

use App\Models\InternBatche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batches = [
            [
                'name_intern_batches' => 'Batch 1 - Januari 2026',
                'description_intern_batches' => 'Batch ini berlangsung dari Januari hingga pertengahan Juni 2026, dengan fokus pada pengembangan skill teknis, kerja tim, dan penyelesaian proyek nyata.',
                'start_date_intern_batches' => '2026-01-01',
                'end_date_intern_batches' => '2026-06-15',
                'status_intern_batches' => 'upcoming',
            ],
            [
                'name_intern_batches' => 'Batch 2 - Juli 2026',
                'description_intern_batches' => 'Batch ini berlangsung dari Juli hingga pertengahan Desember 2026, mencakup kegiatan magang interdisipliner dan pelatihan profesional.',
                'start_date_intern_batches' => '2026-07-01',
                'end_date_intern_batches' => '2026-12-15',
                'status_intern_batches' => 'upcoming',
            ],
            [
                'name_intern_batches' => 'Batch 3 - Januari 2027',
                'description_intern_batches' => 'Batch awal tahun 2027 dirancang untuk mahasiswa tingkat akhir yang ingin mengembangkan kompetensi industri secara intensif hingga pertengahan tahun.',
                'start_date_intern_batches' => '2027-01-01',
                'end_date_intern_batches' => '2027-06-15',
                'status_intern_batches' => 'upcoming',
            ],
        ];


        foreach ($batches as $batch) {
            InternBatche::create($batch);
        }
    }
}
