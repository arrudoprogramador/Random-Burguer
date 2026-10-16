/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
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
                    DEFAULT: 'rgb(var(--color-surface) / <alpha-value>)',
                    card:    'rgb(var(--color-surface-card) / <alpha-value>)',
                    muted:   'rgb(var(--color-surface-muted) / <alpha-value>)',
                    border:  'rgb(var(--color-surface-border) / <alpha-value>)',
                },
                content: {
                    DEFAULT: 'rgb(var(--color-text-main) / <alpha-value>)',
                    muted:   'rgb(var(--color-text-muted) / <alpha-value>)',
                    subtle:  'rgb(var(--color-text-subtle) / <alpha-value>)',
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