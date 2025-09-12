<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InternPosition;
use App\Models\Department;

class InternPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $it = Department::where('name_departments', 'Information Technology')->first();
        $finance = Department::where('name_departments', 'Finance')->first();
        $hr = Department::where('name_departments', 'Human Resources')->first();

        $marketing = Department::firstOrCreate([
            'name_departments' => 'Marketing',
        ], [
            'description_departments' => 'Departemen yang bertanggung jawab atas promosi, branding, dan strategi pemasaran produk.',
            'status_departments' => 'active',
        ]);

        $legal = Department::firstOrCreate([
            'name_departments' => 'Legal',
        ], [
            'description_departments' => 'Departemen hukum yang mengelola kontrak, kepatuhan hukum, dan mitigasi risiko legal.',
            'status_departments' => 'active',
        ]);

        $positions = [
            // IT Department
            [
                'name_intern_positions' => 'UI/UX Designer',
                'description_intern_positions' => 'Sebagai UI/UX Designer Intern, kamu akan membantu merancang antarmuka dan pengalaman pengguna untuk berbagai aplikasi digital. Tanggung jawab mencakup wireframing, prototyping, pengujian usability, dan berkolaborasi dengan developer untuk memastikan hasil implementasi sesuai desain. Kandidat ideal memiliki pemahaman dasar tentang prinsip desain antarmuka, tools seperti Figma atau Adobe XD, dan mampu berpikir kritis dalam menyelesaikan masalah pengguna.',
                'department_id' => $it->id,
            ],
            [
                'name_intern_positions' => 'Backend Developer',
                'description_intern_positions' => 'Sebagai Backend Developer Intern, kamu akan bekerja dengan tim pengembang untuk membangun dan memelihara sistem backend, termasuk API, database, dan logika bisnis. Pengalaman menggunakan bahasa pemrograman seperti PHP, Python, atau Node.js sangat dihargai. Tugas utama termasuk merancang skema database, mengoptimalkan performa query, dan memastikan keamanan data.',
                'department_id' => $it->id,
            ],
            [
                'name_intern_positions' => 'Frontend Developer',
                'description_intern_positions' => 'Sebagai Frontend Developer Intern, kamu akan bertanggung jawab untuk mengubah desain UI menjadi aplikasi web yang responsif dan interaktif. Kamu akan menggunakan HTML, CSS, dan JavaScript (atau framework seperti React atau Vue) untuk membangun komponen antarmuka yang user-friendly. Pengalaman dengan version control (Git) dan integrasi API akan menjadi nilai tambah.',
                'department_id' => $it->id,
            ],
            [
                'name_intern_positions' => 'FullStack Developer',
                'description_intern_positions' => 'FullStack Developer Intern akan menangani pengembangan aplikasi secara end-to-end, baik dari sisi frontend maupun backend. Posisi ini cocok untuk kandidat yang fleksibel dan ingin memahami keseluruhan arsitektur sistem. Kamu akan bekerja menggunakan stack modern seperti Laravel + Vue atau MERN stack, dan belajar mengintegrasikan berbagai layanan serta memastikan kelancaran user experience.',
                'department_id' => $it->id,
            ],
            [
                'name_intern_positions' => 'DevOps Engineer',
                'description_intern_positions' => 'DevOps Intern akan membantu dalam proses otomatisasi CI/CD pipeline, monitoring sistem, serta deployment aplikasi di server. Kandidat diharapkan memiliki pemahaman dasar tentang Docker, GitHub Actions, atau Jenkins, serta memiliki kemauan belajar mengenai cloud infrastructure seperti AWS atau GCP.',
                'department_id' => $it->id,
            ],
            [
                'name_intern_positions' => 'Mobile App Developer',
                'description_intern_positions' => 'Mobile Developer Intern akan fokus pada pengembangan aplikasi Android/iOS menggunakan Flutter atau React Native. Kamu akan belajar tentang pengelolaan state, navigasi, dan deployment ke Play Store/App Store. Kolaborasi dengan desainer dan backend sangat penting dalam posisi ini.',
                'department_id' => $it->id,
            ],
            [
                'name_intern_positions' => 'Cybersecurity Intern',
                'description_intern_positions' => 'Sebagai Cybersecurity Intern, kamu akan membantu melakukan audit keamanan, uji penetrasi ringan, dan monitoring aktivitas jaringan. Posisi ini ideal untuk kandidat yang tertarik pada keamanan digital, memiliki dasar pemahaman tentang OWASP Top 10, dan memiliki rasa ingin tahu yang tinggi dalam menemukan potensi celah keamanan.',
                'department_id' => $it->id,
            ],
            [
                'name_intern_positions' => 'Data Analyst Intern',
                'description_intern_positions' => 'Data Analyst Intern akan membantu tim dalam menganalisis data operasional, membuat visualisasi interaktif, dan menyusun laporan berbasis data untuk pengambilan keputusan. Keahlian dasar dalam SQL, Excel, dan tools seperti Power BI atau Tableau sangat diutamakan.',
                'department_id' => $it->id,
            ],
            [
                'name_intern_positions' => 'Machine Learning Intern',
                'description_intern_positions' => 'Machine Learning Intern akan bekerja dalam proyek eksploratif terkait analitik prediktif dan model machine learning sederhana. Tanggung jawab meliputi pembersihan data, eksplorasi fitur, pelatihan model, dan evaluasi performa menggunakan tools seperti Scikit-learn atau TensorFlow.',
                'department_id' => $it->id,
            ],

            // Finance Department
            [
                'name_intern_positions' => 'Finance Analyst Intern',
                'description_intern_positions' => 'Finance Analyst Intern akan membantu menganalisis laporan keuangan, mengembangkan forecast, dan mendukung proses budgeting. Kamu akan belajar menggunakan tools keuangan serta memahami dinamika alokasi sumber daya dan perencanaan strategis keuangan perusahaan.',
                'department_id' => $finance->id,
            ],
            [
                'name_intern_positions' => 'Tax Intern',
                'description_intern_positions' => 'Tax Intern akan mempelajari proses penyusunan dan pelaporan pajak perusahaan, serta mendukung kepatuhan perpajakan sesuai peraturan yang berlaku. Posisi ini cocok untuk mahasiswa akuntansi atau pajak yang ingin memahami aspek praktis dari administrasi perpajakan.',
                'department_id' => $finance->id,
            ],
            [
                'name_intern_positions' => 'Accounting Intern',
                'description_intern_positions' => 'Accounting Intern bertugas mendukung pencatatan transaksi, rekonsiliasi laporan, serta membantu dalam penyusunan laporan keuangan bulanan. Kandidat akan mendapatkan pengalaman langsung menggunakan software akuntansi dan sistem ERP perusahaan.',
                'department_id' => $finance->id,
            ],

            // HR Department
            [
                'name_intern_positions' => 'HR Generalist Intern',
                'description_intern_positions' => 'HR Generalist Intern akan terlibat dalam berbagai fungsi HR seperti administrasi karyawan, dokumentasi, serta implementasi kebijakan SDM. Kamu juga akan membantu kegiatan onboarding dan pelatihan karyawan baru.',
                'department_id' => $hr->id,
            ],
            [
                'name_intern_positions' => 'Recruitment Intern',
                'description_intern_positions' => 'Sebagai Recruitment Intern, kamu akan membantu proses perekrutan mulai dari penyaringan CV, wawancara awal, hingga koordinasi dengan user terkait penjadwalan kandidat. Posisi ini memberikan pemahaman praktis tentang proses talent acquisition.',
                'department_id' => $hr->id,
            ],
            [
                'name_intern_positions' => 'Training & Development Intern',
                'description_intern_positions' => 'Training & Development Intern akan terlibat dalam merancang program pelatihan internal, mengatur jadwal, dan mengumpulkan feedback peserta untuk peningkatan kualitas pelatihan. Cocok untuk mahasiswa psikologi atau manajemen SDM.',
                'department_id' => $hr->id,
            ],

            // Marketing Department
            [
                'name_intern_positions' => 'Digital Marketing Intern',
                'description_intern_positions' => 'Digital Marketing Intern akan membantu menjalankan strategi pemasaran digital melalui media sosial, email marketing, dan kampanye iklan online. Pengetahuan tentang SEO, copywriting, dan analytics akan sangat berguna.',
                'department_id' => $marketing->id,
            ],
            [
                'name_intern_positions' => 'SEO Specialist Intern',
                'description_intern_positions' => 'SEO Specialist Intern akan bekerja untuk meningkatkan visibilitas website di mesin pencari. Tugas meliputi riset keyword, optimasi on-page, dan analisis performa SEO menggunakan tools seperti Google Analytics dan SEMrush.',
                'department_id' => $marketing->id,
            ],
            [
                'name_intern_positions' => 'Content Creator Intern',
                'description_intern_positions' => 'Content Creator Intern akan membuat konten visual dan teks untuk keperluan branding dan promosi. Kamu akan berkolaborasi dengan tim desain dan marketing untuk menghasilkan materi yang menarik dan sesuai audiens target.',
                'department_id' => $marketing->id,
            ],

            // Legal Department
            [
                'name_intern_positions' => 'Legal Research Intern',
                'description_intern_positions' => 'Legal Research Intern akan membantu dalam pengumpulan dan analisis dokumen hukum, review kontrak, dan riset peraturan baru. Posisi ini memberikan wawasan mendalam terkait aspek legal dalam dunia korporasi.',
                'department_id' => $legal->id,
            ],
            [
                'name_intern_positions' => 'Compliance Intern',
                'description_intern_positions' => 'Compliance Intern akan mendukung tim dalam memastikan bahwa aktivitas dan proses perusahaan mematuhi regulasi internal dan eksternal. Kandidat akan terlibat dalam audit internal dan dokumentasi kepatuhan.',
                'department_id' => $legal->id,
            ],
        ];

        foreach ($positions as $position) {
            InternPosition::create(array_merge($position, [
                'status_intern_positions' => 'active',
            ]));
        }
    }
}
