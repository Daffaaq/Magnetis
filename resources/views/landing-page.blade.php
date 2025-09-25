<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Magang | Landing Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/output.css') }}">
    <!-- Pastikan Tailwind aktif -->
    <link rel="stylesheet" href="{{ asset('css/landing/landing-batch.css') }}?v=1.0.0">
    <link rel="stylesheet" href="{{ asset('css/landing/landing-registration.css') }}?v=1.0.0">
    {{-- <link rel="stylesheet" href="{{ asset('css/landing/landing-scroll-upper.css') }}?v=1.0.0"> --}}
</head>

<body class="bg-white text-gray-800">

    <!-- Navbar -->
    <header class="bg-white border-b shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Judul Aplikasi -->
            <span class="text-xl font-extrabold text-[#1E3A8A] tracking-wide">MAGNETIS</span>


            <!-- Toggle Button (Mobile only) -->
            <button id="menu-toggle" class="md:hidden text-2xl focus:outline-none">
                ☰
            </button>

            <!-- Navigation Menu -->
            <nav id="mobile-menu"
                class="hidden md:flex flex-col md:flex-row md:items-center md:space-x-4 absolute md:static top-full left-0 w-full md:w-auto bg-white md:bg-transparent px-4 py-4 md:p-0 border-t md:border-none shadow md:shadow-none">
                <a href="/login"
                    class="block md:inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-2 md:mt-0">Login</a>
                <a href="/register"
                    class="block md:inline-block text-blue-600 border border-blue-600 px-4 py-2 rounded hover:bg-blue-100 mt-2 md:mt-0">Daftar</a>
            </nav>
        </div>
    </header>


    <!-- Hero Section -->
    <section id="hero" class="bg-gray-100 py-16">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center px-4">

            <!-- Teks Hero -->
            <div class="md:w-1/2 text-center mt:md-10 md:text-left">
                <h1 class="text-5xl font-extrabold mb-4 text-[#1E3A8A]">Selamat Datang di <span
                        class="text-blue-600">MAGNETIS</span></h1>
                <p class="text-lg mb-2 font-semibold italic text-gray-600">Management Internship System</p>
                <p class="text-gray-700 mb-6">
                    Platform lengkap untuk mengelola magang mahasiswa dengan mudah, pantau progres secara real-time, dan
                    dapatkan laporan otomatis.
                </p>
                <div class="space-x-4">
                    <a href="/register"
                        class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition">Mulai
                        Sekarang</a>
                    <a href="#"
                        class="scroll-link inline-block text-blue-600 border border-blue-600 px-6 py-3 rounded hover:bg-blue-100 transition"
                        data-target="fitur">
                        Pelajari Lebih Lanjut
                    </a>

                </div>
            </div>

            <!-- Gambar Hero (optional) -->
            <div class="md:w-1/2 mt-10 md:mt-0">
                <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=600&q=80"
                    alt="Ilustrasi magang" class="w-full rounded-lg shadow-lg">
            </div>

        </div>
    </section>

    <!-- Fitur -->
    <section id="fitur" class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h3 class="text-2xl font-bold mb-6 text-center text-[#1E3A8A]">Fitur Unggulan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Fitur 1 -->
                <div class="p-6 border rounded shadow hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <!-- Icon (Heroicons - User Group) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 14a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg mb-2 text-center text-[#1E3A8A]">Manajemen Peserta</h4>
                    <p class="text-center text-gray-700">Kelola data peserta magang dengan mudah dan terorganisir.</p>
                </div>

                <!-- Fitur 2 -->
                <div class="p-6 border rounded shadow hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <!-- Icon (Heroicons - Clipboard Check) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m1-4v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h6" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg mb-2 text-center text-[#1E3A8A]">Monitoring Progres</h4>
                    <p class="text-center text-gray-700">Pantau perkembangan magang peserta secara real-time dengan
                        laporan mudah.</p>
                </div>

                <!-- Fitur 3 -->
                <div class="p-6 border rounded shadow hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <!-- Icon (Heroicons - Chat Alt) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h6m-6 4h8M3 8h.01M3 12h.01M3 16h.01" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg mb-2 text-center text-[#1E3A8A]">Komunikasi Langsung</h4>
                    <p class="text-center text-gray-700">Fasilitas chat antara mentor dan peserta untuk koordinasi
                        cepat.</p>
                </div>

                <!-- Fitur 4 -->
                <div class="p-6 border rounded shadow hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <!-- Icon (Heroicons - Calendar) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg mb-2 text-center text-[#1E3A8A]">Penjadwalan & Pengingat</h4>
                    <p class="text-center text-gray-700">Atur jadwal magang dan dapatkan pengingat otomatis untuk
                        peserta dan mentor.</p>
                </div>

                <!-- Fitur 5 -->
                <div class="p-6 border rounded shadow hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <!-- Icon (Heroicons - Document Report) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17v-2a4 4 0 014-4h3m-6 6h6m-6 4h6a2 2 0 002-2v-4a2 2 0 00-2-2h-6" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg mb-2 text-center text-[#1E3A8A]">Laporan Berkala</h4>
                    <p class="text-center text-gray-700">Hasil evaluasi dan progres peserta diupdate secara berkala.
                    </p>
                </div>

                <!-- Fitur 6 -->
                <div class="p-6 border rounded shadow hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <!-- Icon (Heroicons - Shield Check) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m1-4v6a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h6" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg mb-2 text-center text-[#1E3A8A]">Keamanan Data</h4>
                    <p class="text-center text-gray-700">Data peserta dan mentor terlindungi dengan sistem keamanan
                        yang terpercaya.</p>
                </div>

            </div>
        </div>
    </section>



    <!-- Section Batch Magang -->
    <section id="batch" class="py-20 bg-blue-100">
        <div class="max-w-6xl mx-auto px-6">
            <h3 class="text-3xl font-extrabold text-center text-[#1E3A8A] mb-10">Batch Magang</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($internBatches->sortByDesc('status_intern_batches') as $batch)
                    @php
                        $status = $batch->status_intern_batches;
                        $statusClass = match ($status) {
                            'upcoming' => 'bg-green-100 text-green-700',
                            'ongoing' => 'bg-yellow-100 text-yellow-700',
                            'completed' => 'bg-gray-200 text-gray-700',
                            default => 'bg-gray-200 text-gray-700',
                        };
                    @endphp

                    <div
                        class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col justify-between">
                        <div>
                            <h4 class="text-xl font-bold text-[#1E3A8A] mb-2">{{ $batch->name_intern_batches }}</h4>
                            <p class="text-gray-600 text-sm mb-3 italic">
                                {{ \Carbon\Carbon::parse($batch->start_date_intern_batches)->translatedFormat('d F Y') }}
                                –
                                {{ \Carbon\Carbon::parse($batch->end_date_intern_batches)->translatedFormat('d F Y') }}
                            </p>
                            <p class="text-gray-700 mb-4">
                                {{ Str::limit(strip_tags($batch->description_intern_batches), 120) }}
                            </p>
                            <span
                                class="inline-block px-3 py-1 text-sm rounded-full font-semibold {{ $statusClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        </div>

                        <a href="{{ route('detail-batch-internship', ['slug' => $batch->slug_intern_batches]) }}"
                            class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg font-medium text-center hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                    </div>

                @empty
                    <div
                        class="col-span-1 md:col-span-3 flex flex-col items-center justify-center text-center py-16 bg-white rounded-xl shadow">
                        <!-- Ilustrasi -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-400 mb-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 17v-6h6v6m-7 4h8a2 2 0 002-2V7a2 2 0 00-2-2h-3.586a1 1 0 01-.707-.293l-1.414-1.414A1 1 0 0011.586 3H9a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>

                        <!-- Pesan -->
                        <h4 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Batch Magang 😔</h4>
                        <p class="text-gray-500 text-base max-w-md">
                            Saat ini belum tersedia batch magang yang aktif atau akan datang. Silakan kembali lagi di
                            lain waktu untuk melihat peluang magang terbaru.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Internship Section -->
    <section id="internship" class="py-20 bg-gray-100 ">
        <div class="max-w-6xl mx-auto px-6">
            <h3 class="text-3xl font-extrabold text-center text-[#1E3A8A] mb-10">Lowongan Internship</h3>

            <!-- Filter Batch -->
            <div class="flex flex-wrap gap-3 justify-center md:justify-end mb-8">
                <button class="batch-btn active" data-filter="all">All Batches</button>
                @foreach ($filteredInternBatches as $batch)
                    @php
                        $batchNameShort = explode(' - ', $batch->name_intern_batches)[0];
                        $datePart = explode(' - ', $batch->name_intern_batches)[1] ?? '';
                    @endphp
                    <button class="batch-btn" data-filter="batch-{{ $batch->id }}">
                        {{ $batchNameShort }}
                    </button>
                @endforeach
            </div>

            <!-- Internship Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 min-h-[300px]">
                @forelse ($internPositionBatch as $positionBatch)
                    <div data-batch="batch-{{ $positionBatch->internBatch->id }}"
                        class="internship-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-xl font-bold text-[#1E3A8A]">
                                {{ $positionBatch->internPosition->name_intern_positions ?? 'No Title' }}
                            </h4>
                            @php
                                $isPaid = $positionBatch->compensation_amount_intern_position_batches > 0;
                            @endphp
                            <span
                                class="text-sm {{ $isPaid ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }} px-3 py-1 rounded-full font-medium">
                                {{ $isPaid ? 'Paid' : 'Unpaid' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-12a4 4 0 00-4 4c0 2.5 4 7 4 7s4-4.5 4-7a4 4 0 00-4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p>Location: {{ $positionBatch->internLocation->intern_location_name ?? 'N/A' }}</p>
                        </div>
                        <a href="{{ url('/internship/' . $positionBatch->slug_intern_position_batches) }}"
                            class="block text-center bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                            See Details
                        </a>
                    </div>
                    @if ($totalInternships > 6)
                        <div class="mt-12 text-center">
                            <a href="/internship/all"
                                class="inline-block px-8 py-3 font-medium rounded-full text-[#1E3A8A] border-2 border-[#1E3A8A] hover:bg-[#1E3A8A] hover:text-white transition-colors duration-300">
                                See More
                            </a>
                        </div>
                    @endif
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center text-center py-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7a2 2 0 012-2h4l2 3h7a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                        </svg>
                        <p class="text-gray-500 text-lg font-medium">Maaf, belum ada lowongan internship saat ini.
                        </p>
                        <p class="text-gray-400 mt-2">Silakan cek kembali nanti atau hubungi kami untuk informasi
                            lebih
                            lanjut.</p>
                    </div>
                @endforelse
            </div>


        </div>
    </section>

    <!-- Registration Section -->
    <section id="registration" class="py-24 bg-blue-100 mt-10">
        <div class="max-w-6xl mx-auto px-6">
            <h3 class="text-3xl font-extrabold text-center text-[#1E3A8A] mb-10">Registrasi</h3>
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-8 md:p-12">
                <h3 class="text-3xl font-bold text-blue-800 mb-10 text-center">Form Registrasi Peserta Magang</h3>

                <!-- Step Tabs -->
                <div id="stepTabs" class="flex justify-center mb-12 border-b border-gray-300 relative">
                    <button type="button"
                        class="step-tab px-6 py-2 text-gray-600 font-semibold border-b-4 border-transparent transition cursor-default"
                        data-step="1" disabled>Profile</button>
                    <button type="button"
                        class="step-tab px-6 py-2 text-gray-600 font-semibold border-b-4 border-transparent transition cursor-default"
                        data-step="2" disabled>General Information</button>
                    <button type="button"
                        class="step-tab px-6 py-2 text-gray-600 font-semibold border-b-4 border-transparent transition cursor-default"
                        data-step="3" disabled>Confirmation</button>
                    <!-- Underline -->
                    <span id="underline"
                        class="absolute bottom-0 h-1 bg-blue-700 transition-all duration-300 rounded"></span>
                </div>

                <form id="multiStepForm" method="POST" action="{{ route('register.candidate-intern') }}"
                    class="space-y-6">
                    @csrf
                    <!-- STEP 1: PROFILE -->
                    <div class="step" data-step="1">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pendek</label>
                                <input type="text" name="name" required
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Panjang</label>
                                <input type="text" name="fullname_intern_candidate_profiles" required
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                                <input type="tel" name="phone_number_intern_candidate_profiles" required
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" required
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" name="password" required
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600" />
                            </div>
                        </div>
                        <div class="flex justify-end mt-8">
                            <button type="button" onclick="nextStep()"
                                class="bg-blue-700 text-white py-2 px-6 rounded-md hover:bg-blue-800 transition">
                                Lanjut
                            </button>
                        </div>
                    </div>

                    <!-- STEP 2: INFORMASI UMUM -->
                    <div class="step hidden" data-step="2">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <textarea name="address_intern_candidate_profiles" rows="3"
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600"></textarea>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Country -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <select id="country" name="country_intern_candidate_profiles"
                                        class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600">
                                        <option value="">-- Pilih Negara --</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Province -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                    <select id="province" name="province_intern_candidate_profiles"
                                        class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600">
                                        <option value="">-- Pilih Provinsi --</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->name }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Regency -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Regency</label>
                                    <select id="regency" name="regency_intern_candidate_profiles"
                                        class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600">
                                        <option value="">-- Pilih Kabupaten/Kota --</option>
                                    </select>
                                </div>

                                <!-- District -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">District</label>
                                    <select id="district" name="district_intern_candidate_profiles"
                                        class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600">
                                        <option value="">-- Pilih Kecamatan --</option>
                                    </select>
                                </div>

                                <!-- Village -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Village</label>
                                    <select id="village" name="village_intern_candidate_profiles"
                                        class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600">
                                        <option value="">-- Pilih Desa --</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                                <div class="flex items-center gap-4">
                                    <label><input type="radio" name="gender_intern_candidate_profiles"
                                            value="male" required />
                                        Laki-laki</label>
                                    <label><input type="radio" name="gender_intern_candidate_profiles"
                                            value="female" required />
                                        Perempuan</label>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth_intern_candidate_profiles"
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">URL GitHub</label>
                                <input type="url" name="github_intern_candidate_profiles"
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">URL LinkedIn</label>
                                <input type="url" name="linkedin_intern_candidate_profiles"
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">URL Portfolio</label>
                                <input type="url" name="portfolio_intern_candidate_profiles"
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-blue-600 focus:border-blue-600" />
                            </div>
                        </div>
                        <div class="flex justify-between mt-8">
                            <button type="button" onclick="prevStep()"
                                class="bg-gray-200 text-gray-800 py-2 px-6 rounded-md hover:bg-gray-300 transition">
                                Kembali
                            </button>
                            <button type="button" onclick="showSummary()"
                                class="bg-blue-700 text-white py-2 px-6 rounded-md hover:bg-blue-800 transition">
                                Tinjau
                            </button>
                        </div>
                    </div>

                    <!-- STEP 3: KONFIRMASI -->
                    <div class="step hidden" data-step="3">
                        <h4 class="text-xl font-semibold mb-6 text-gray-700">Tinjau Data Anda</h4>

                        <div id="summary" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700"></div>

                        <div class="flex justify-between mt-8">
                            <button type="button" onclick="prevStep()"
                                class="bg-gray-200 text-gray-800 py-2 px-6 rounded-md hover:bg-gray-300 transition">
                                Kembali
                            </button>
                            <button type="submit"
                                class="bg-green-600 text-white py-2 px-6 rounded-md hover:bg-green-700 transition">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-20 bg-[#F1F5F9] mt-0">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-extrabold text-[#1E3A8A] mb-4">Hubungi Kami</h3>
            <p class="text-gray-600 mb-10">Punya pertanyaan, kendala, atau ingin tahu lebih banyak? Tim kami siap
                membantu!</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Email Card -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 hover:shadow-lg transition">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 12H8m8 0l-4-4m4 4l-4 4M4 6h16v12H4z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h4 class="font-semibold text-lg text-[#1E3A8A]">Email</h4>
                        <a href="mailto:admin@magangkampus.ac.id"
                            class="text-blue-600 hover:underline">magnetis@sencakaputra.ac.id</a>
                    </div>
                </div>

                <!-- Telepon Card -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 hover:shadow-lg transition">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 5a2 2 0 012-2h2.28a1 1 0 01.94.658l1.54 4.62a1 1 0 01-.272 1.05l-1.72 1.72a16.05 16.05 0 006.586 6.586l1.72-1.72a1 1 0 011.05-.272l4.62 1.54a1 1 0 01.658.94V19a2 2 0 01-2 2h-.5C9.038 21 3 14.962 3 7.5V7a2 2 0 010-.5z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h4 class="font-semibold text-lg text-[#1E3A8A]">Telepon</h4>
                        <p class="text-gray-700">0812-3456-7890</p>
                    </div>
                </div>
            </div>

            <!-- CTA Ringan -->
            <p class="mt-10 text-gray-500 italic text-sm">Kami akan membalas pertanyaan Anda secepat mungkin.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 text-center">
        <p>&copy; {{ date('Y') }} Sistem Magang. Semua hak dilindungi.</p>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn"
        class="hidden fixed bottom-6 right-6 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition z-50"
        aria-label="Kembali ke atas">
        <!-- Icon panah ke atas -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <!-- JavaScript -->
    <script src="{{ asset('js/landing/landing-batch.js') }}"></script>
    <script src="{{ asset('js/landing/landing-mobile.js') }}"></script>
    <script src="{{ asset('js/landing/landing-registration.js') }}"></script>
    <script src="{{ asset('js/landing/landing-data-target.js') }}"></script>
    <script src="{{ asset('js/landing/landing-scroll-upper.js') }}"></script>

</body>

</html>
