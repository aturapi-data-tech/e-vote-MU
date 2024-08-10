const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: { "50": "#f0fdf4", "100": "#dcfce7", "200": "#bbf7d0", "300": "#86efac", "400": "#4ade80", "500": "#22c55e", "600": "#16a34a", "700": "#15803d", "800": "#166534", "900": "#14532d", "950": "#052e16" }
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('flowbite/plugin')],

};




// tailwind.config = {
//     darkMode: 'class',
//     theme: {
//         extend: {
//             colors: {
//                 primary: { "50": "#f0fdf4", "100": "#dcfce7", "200": "#bbf7d0", "300": "#86efac", "400": "#4ade80", "500": "#22c55e", "600": "#16a34a", "700": "#15803d", "800": "#166534", "900": "#14532d", "950": "#052e16" }
//             }
//         },
//         fontFamily: {
//             'body': [
//                 'Inter',
//                 'ui-sans-serif',
//                 'system-ui',
//                 '-apple-system',
//                 'system-ui',
//                 'Segoe UI',
//                 'Roboto',
//                 'Helvetica Neue',
//                 'Arial',
//                 'Noto Sans',
//                 'sans-serif',
//                 'Apple Color Emoji',
//                 'Segoe UI Emoji',
//                 'Segoe UI Symbol',
//                 'Noto Color Emoji'
//             ],
//             'sans': [
//                 'Inter',
//                 'ui-sans-serif',
//                 'system-ui',
//                 '-apple-system',
//                 'system-ui',
//                 'Segoe UI',
//                 'Roboto',
//                 'Helvetica Neue',
//                 'Arial',
//                 'Noto Sans',
//                 'sans-serif',
//                 'Apple Color Emoji',
//                 'Segoe UI Emoji',
//                 'Segoe UI Symbol',
//                 'Noto Color Emoji'
//             ]
//         }
//     }
// }
