/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    DEFAULT: '#F59E0B',
                    dark:    '#D97706',
                    light:   '#FCD34D',
                },
                surface: {
                    DEFAULT: '#111111',
                    card:    '#1A1A1A',
                    muted:   '#252525',
                },
            },
            fontFamily: {
                display: ['"Playfair Display"', 'serif'],
                body:    ['"DM Sans"', 'sans-serif'],
            },
        },
    },
    plugins: [],
}