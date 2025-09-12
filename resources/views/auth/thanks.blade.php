<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Terima Kasih</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-wrapper">
        <!-- Tombol dark mode -->
        <button class="theme-toggle" id="theme-toggle-btn" onclick="toggleTheme()" title="Toggle dark mode">
            <span id="theme-icon">🌙</span>
        </button>

        <h1>Terima Kasih!</h1>
        <p>Registrasi Anda berhasil. Silakan login untuk masuk ke dashboard.</p>

        <div class="form-group button-group">
            <a href="{{ url('/') }}" class="btn-login">Login Sekarang</a>
        </div>

        <div class="form-footer">
            <small>&copy; {{ date('Y') }} Starter Kit SB Admin 2 | Crafted with ❤️</small>
        </div>
    </div>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('theme-icon');
            const button = document.getElementById('theme-toggle-btn');

            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                icon.textContent = '🌙';
                button.title = 'Aktifkan mode gelap';
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                icon.textContent = '☀️';
                button.title = 'Aktifkan mode terang';
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            const theme = localStorage.getItem('theme');
            const html = document.documentElement;
            const icon = document.getElementById('theme-icon');
            const button = document.getElementById('theme-toggle-btn');

            if (theme === 'dark') {
                html.classList.add('dark');
                icon.textContent = '☀️';
                button.title = 'Aktifkan mode terang';
            } else {
                html.classList.remove('dark');
                icon.textContent = '🌙';
                button.title = 'Aktifkan mode gelap';
            }
        });
    </script>
</body>

</html>
