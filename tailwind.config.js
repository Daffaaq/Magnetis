/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js}",  // folder src dan semua file html/js di dalamnya
    "./resources/views/**/*.blade.php",  // kalau pakai Laravel Blade
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography'), // aktifkan plugin typography
    require('@tailwindcss/forms'),
  ],
}
