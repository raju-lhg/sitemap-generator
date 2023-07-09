import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    purge: ['public/**/*.html'],
    theme: {
        extend: {
            maxHeight: {
                '0': '0',
                xl: '36rem',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms],
    variants: {
        backgroundColor: [
            'hover',
            'focus',
            'active',
            'odd',
            'dark',
            'dark:hover',
            'dark:focus',
            'dark:active',
            'dark:odd',
        ],
        display: ['responsive', 'dark'],
        textColor: [
            'focus-within',
            'hover',
            'active',
            'dark',
            'dark:focus-within',
            'dark:hover',
            'dark:active',
        ],
        placeholderColor: ['focus', 'dark', 'dark:focus'],
        borderColor: ['focus', 'hover', 'dark', 'dark:focus', 'dark:hover'],
        divideColor: ['dark'],
        boxShadow: ['focus', 'dark:focus'],
    },
};
