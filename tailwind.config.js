const defaultTheme = require('tailwindcss/defaultTheme');
let flattenColorPalette = require('tailwindcss/lib/util/flattenColorPalette').default;

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            transitionTimingFunction: {
                'ease-in-out-back': 'cubic-bezier(0.68, -0.6, 0.32, 1.6)',
            },
            height: {
                '100': '26rem',
                '104': '28rem',
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            backgroundImage: ['hover', 'focus'],
        },
    },

    plugins: [
        ({ addUtilities, e, theme, variants }) => {
            const colors = flattenColorPalette(theme('borderColor'));
            //delete colors['default'];

            const colorMap = Object.keys(colors)
                .map(color => ({
                    [`.border-t-${color}`]: {borderTopColor: colors[color]},
                    [`.border-r-${color}`]: {borderRightColor: colors[color]},
                    [`.border-b-${color}`]: {borderBottomColor: colors[color]},
                    [`.border-l-${color}`]: {borderLeftColor: colors[color]},
                }));
            const utilities = Object.assign({}, ...colorMap);
            addUtilities(utilities, variants('borderColor'));
        },
        require('@tailwindcss/forms'), require('@tailwindcss/typography')
    ],
};