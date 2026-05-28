export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],

    theme: {
        extend: {

            colors: {
                brand: '#ffb800',
                'brand-light': '#ffc933',

                surface: '#0b0b0b',
                'surface-card': '#121212',
                'surface-muted': '#1e1e1e',

                accent: '#ff6b00',
            },

            fontFamily: {
                display: ['Bebas Neue', 'sans-serif'],
            },

            boxShadow: {
                glow: '0 0 30px rgba(255,184,0,0.25)',
            },

        },
    },

    plugins: [],
}