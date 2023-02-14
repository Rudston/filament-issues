const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/Vue/**/*.vue'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                current: 'currentColor',
                accent: {
                    900: '#121023', // dark
                    600: '#4F459A', // light
                    400: '#9088cd', // hover over dark
                    200: '#EFEDF7', // highlight
                },
                danger: colors.rose,
                primary: colors.indigo,// was 'blue'; this is  very similar to accent 900
                success: colors.green,
                warning: colors.yellow,
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
