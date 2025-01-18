import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import hamburgers from 'tailwind-hamburgers';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js\', // Добавляем путь Flowbite'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Century Gothic', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                green: {
                    300: '#e6ffb4',
                    500: '#78be0a',
                    700: '#283C00',
                },
                gray: {
                    300: '#f0f0f0'
                }
            },
            screens: {
                '2xl': {'max': '1535px'}, // => @media (max-width: 1535px) { ... }
                'xl': {'max': '1279px'}, // => @media (max-width: 1279px) { ... }
                'lg': {'max': '1023px'}, // => @media (max-width: 1023px) { ... }
                'md': {'max': '767px'}, // => @media (max-width: 767px) { ... }
                'sm': {'max': '639px'}, // => @media (max-width: 639px) { ... }
            }
        },
    },

    plugins: [forms, hamburgers],
};
