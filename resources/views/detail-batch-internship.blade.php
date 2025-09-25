{{-- resources/views/detail-batch-internship.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $internBatch->name_intern_batches }} | Detail Batch Magang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('output.css') }}">
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
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

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-6 py-10">

        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ url('/') }}"
                class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 hover:bg-gray-300 transition px-4 py-2 rounded-lg text-sm font-medium">
                ← Kembali ke Beranda
            </a>
        </div>

        <!-- Judul dan Periode -->
        <section class="mb-8">
            <h2 class="text-4xl font-bold text-[#1E3A8A] mb-2">{{ $internBatch->name_intern_batches }}</h2>
            <p class="text-gray-500 italic text-lg">
                Periode: {{ \Carbon\Carbon::parse($internBatch->start_date_intern_batches)->translatedFormat('d F Y') }}
                – {{ \Carbon\Carbon::parse($internBatch->end_date_intern_batches)->translatedFormat('d F Y') }}
            </p>
        </section>

        <!-- Status -->
        <section class="mb-8">
            <h3 class="text-lg font-semibold mb-2 text-gray-700">Status Batch:</h3>
            @php
                $status = $internBatch->status_intern_batches;
                $statusClass = match ($status) {
                    'upcoming' => 'bg-green-100 text-green-700',
                    'ongoing' => 'bg-yellow-100 text-yellow-700',
                    'completed' => 'bg-gray-200 text-gray-700',
                };
            @endphp
            <span class="inline-block px-4 py-1 text-sm rounded-full font-medium {{ $statusClass }}">
                {{ ucfirst($status) }}
            </span>
        </section>

        <!-- Deskripsi -->
        <!-- Deskripsi -->
        <section class="bg-white shadow rounded-lg p-6 mb-12">
            <h3 class="text-xl font-semibold text-[#1E3A8A] mb-4">Deskripsi Batch</h3>

            <div class="prose max-w-none">
                {!! $internBatch->description_intern_batches !!}
            </div>

        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 text-center">
        <p>&copy; {{ now()->year }} Sistem Magang. Semua hak dilindungi.</p>
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('js/landing/landing-mobile.js') }}"></script>

</body>

</html>
