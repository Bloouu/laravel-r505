import defaultTheme from 'tailwindcss/defaultTheme';

const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            blue: colors.blue,
            cyan: colors.cyan,
            emerald: colors.emerald,
            fuchsia: colors.fuchsia,
            slate: colors.slate,
            gray: colors.gray,
            neutral: colors.neutral,
            stone: colors.stone,
            green: colors.green,
            indigo: colors.indigo,
            lime: colors.lime,
            orange: colors.orange,
            pink: colors.pink,
            purple: colors.purple,
            red: colors.red,
            rose: colors.rose,
            sky: colors.sky,
            teal: colors.teal,
            violet: colors.violet,
            yellow: colors.amber,
            white: colors.white,
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
