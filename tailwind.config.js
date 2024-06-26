import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                my_serif:['Cambria', ...defaultTheme.fontFamily.serif]
            },
            colors:{
                sasra_color: "#D29621",
                sasra_hover: "#FBCD89"
            },
            screens: {
                'my_sm': {'max': '430px'},
                'my_md':{'max': '1024px'},
            }
        },
        
    },

    plugins: [forms, typography],
};
