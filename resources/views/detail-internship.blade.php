<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Internship | MAGNETIS</title>
    <link rel="stylesheet" href="/output.css">
</head>

<body class="bg-gray-50 text-gray-800">

    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-extrabold text-[#1E3A8A]">MAGNETIS</h1>
            <nav class="space-x-4 text-blue-600 font-semibold">
                <a href="/login" class="hover:underline">Login</a>
            </nav>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-6 py-10">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{url('/')}}"
                class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 hover:bg-gray-300 transition px-4 py-2 rounded-lg text-sm font-medium">
                ← Kembali ke Beranda
            </a>
        </div>

        <!-- Header Section -->
        <section class="mb-12">
            <h2 class="text-5xl font-extrabold text-[#1E3A8A] mb-4">Backend Developer Intern</h2>
            <p class="italic text-gray-500 text-lg">Batch 1 - Mei 2025</p>
        </section>

        <!-- Info Utama -->
        <section class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Posisi & Kuota & Status -->
                <div class="space-y-8 border-b md:border-b-0 md:border-r border-gray-200 pb-8 md:pb-0 pr-8">
                    <div>
                        <h3 class="text-xl font-semibold uppercase tracking-wide text-gray-700 mb-1">Posisi Intern</h3>
                        <p class="text-gray-900 text-lg font-medium">Backend Developer</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold uppercase tracking-wide text-gray-700 mb-1">Kuota</h3>
                        <p class="text-gray-900 text-lg font-medium">5 Orang</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold uppercase tracking-wide text-gray-700 mb-2">Status</h3>
                        <span
                            class="inline-block bg-green-100 text-green-700 font-semibold rounded-full px-4 py-1 text-sm">Open</span>
                    </div>
                </div>

                <!-- Periode Internship -->
                <div class="space-y-5">
                    <h3 class="text-xl font-semibold uppercase tracking-wide text-gray-700 mb-3">Periode Internship</h3>
                    <p class="text-gray-800 text-base">Registrasi: <span class="font-medium">1 April 2025 - 15 Mei
                            2025</span></p>
                    <p class="text-gray-800 text-base">Magang: <span class="font-medium">1 Juni 2025 - 31 Agustus
                            2025</span></p>
                </div>
            </div>
        </section>

        <!-- Location -->
        <section class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h3 class="text-2xl font-semibold mb-6 text-[#1E3A8A]">Lokasi</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-3">
                    <p><span class="font-semibold">Nama Lokasi:</span> PT. Tech Solution</p>
                    <p><span class="font-semibold">Alamat:</span> Jl. Merdeka No. 45</p>
                    <p><span class="font-semibold">Distrik:</span> Gubeng</p>
                </div>
                <div class="space-y-3">
                    <p><span class="font-semibold">Kabupaten/Kota:</span> Surabaya</p>
                    <p><span class="font-semibold">Provinsi:</span> Jawa Timur</p>
                    <p><span class="font-semibold">Kode Pos:</span> 60281</p>
                    <p><span class="font-semibold">Negara:</span> Indonesia</p>
                </div>
            </div>
        </section>

        <!-- Paid/Unpaid & Compensation -->
        <section class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h3 class="text-2xl font-semibold mb-6 text-[#1E3A8A]">Status Kompensasi</h3>
            <p class="mb-6"><span class="font-semibold">Tipe:</span> Paid</p>
            <p class="mb-6"><span class="font-semibold">Kompensasi:</span> Rp 2.000.000 / bulan</p>

            <!-- Kalau unpaid, tampilkan note ini (dummy toggle contoh unpaid, bisa diubah) -->
            <!-- <p class="text-gray-700 italic bg-yellow-100 p-6 rounded-lg">
    Walaupun posisi magang ini tidak berbayar, peserta magang akan mendapatkan pengalaman langsung yang berharga, pengembangan keterampilan, dan wawasan industri. Peserta dengan performa terbaik berkesempatan untuk diangkat menjadi karyawan tetap setelah masa magang.
  </p> -->
        </section>

        <!-- Deskripsi Lowongan -->
        <section class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h3 class="text-2xl font-semibold mb-6 text-[#1E3A8A]">Deskripsi Lowongan Magang</h3>
            <p class="text-gray-700 leading-relaxed text-lg">
                Posisi Backend Developer bertanggung jawab untuk membangun dan mengelola API, database, serta integrasi
                sistem.
                Kandidat akan bekerja dalam tim agile untuk mengembangkan fitur baru dan memperbaiki bug secara berkala.
            </p>
        </section>

        <!-- Apply Requirement -->
        <section class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h3 class="text-2xl font-semibold mb-6 text-[#1E3A8A]">Apply Requirement</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-3 text-lg">
                <li>Mahasiswa aktif jurusan Teknik Informatika atau terkait</li>
                <li>Mampu menggunakan bahasa pemrograman JavaScript dan PHP</li>
                <li>Memahami dasar-dasar RESTful API dan database MySQL</li>
                <li>Komunikatif dan mampu bekerja dalam tim</li>
            </ul>
        </section>

        <!-- Benefit -->
        <section class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h3 class="text-2xl font-semibold mb-6 text-[#1E3A8A]">Benefit</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-3 text-lg">
                <li>Pengalaman kerja nyata di industri teknologi</li>
                <li>Surat rekomendasi setelah selesai magang</li>
                <li>Kesempatan berjejaring dengan profesional IT</li>
            </ul>
        </section>


        <!-- Selection Step Timeline -->
        <section class="bg-white rounded-lg shadow p-6 mb-10">
            <h3 class="font-semibold text-xl mb-6 text-[#1E3A8A]">Selection Step</h3>

            <ol class="relative border-l border-gray-300">
                <li class="mb-10 ml-6">
                    <span
                        class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full ring-8 ring-white text-white font-bold">1</span>
                    <h4 class="text-lg font-semibold text-[#1E3A8A] mb-1">Pendaftaran Online</h4>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-500">1 April 2025 - 15 Mei
                        2025</time>
                    <p class="text-gray-700">Isi formulir pendaftaran dan unggah dokumen yang diperlukan.</p>
                </li>
                <li class="mb-10 ml-6">
                    <span
                        class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full ring-8 ring-white text-white font-bold">2</span>
                    <h4 class="text-lg font-semibold text-[#1E3A8A] mb-1">Seleksi Berkas</h4>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-500">16 Mei 2025 - 22 Mei
                        2025</time>
                    <p class="text-gray-700">Tim HR akan menyeleksi dokumen dan CV peserta.</p>
                </li>
                <li class="mb-10 ml-6">
                    <span
                        class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full ring-8 ring-white text-white font-bold">3</span>
                    <h4 class="text-lg font-semibold text-[#1E3A8A] mb-1">Wawancara</h4>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-500">25 Mei 2025 - 30 Mei
                        2025</time>
                    <p class="text-gray-700">Peserta yang lolos seleksi berkas akan mengikuti wawancara.</p>
                </li>
                <li class="mb-10 ml-6">
                    <span
                        class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full ring-8 ring-white text-white font-bold">4</span>
                    <h4 class="text-lg font-semibold text-[#1E3A8A] mb-1">Pengumuman Hasil</h4>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-500">31 Mei 2025</time>
                    <p class="text-gray-700">Pengumuman peserta yang diterima magang.</p>
                </li>
            </ol>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 text-center">
        <p>&copy; {{ date('Y') }} Sistem Magang. Semua hak dilindungi.</p>
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('js/landing/landing-mobile.js') }}"></script>

</body>

</html>
