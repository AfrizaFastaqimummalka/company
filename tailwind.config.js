/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    50:  '#f0f9f6',
                    100: '#dcf0e8',
                    200: '#bbe1d2',
                    300: '#8dcbb6',
                    400: '#58ae94',
                    500: '#38927a',   // primary
                    600: '#2a7562',
                    700: '#245f50',
                    800: '#1f4d41',
                    900: '#1c4037',
                    950: '#0a231f',
                },
                stone: {
                    50:  '#fafaf9',
                    100: '#f5f5f4',
                    200: '#e7e5e4',
                    300: '#d6d3d1',
                    400: '#a8a29e',
                    500: '#78716c',
                    600: '#57534e',
                    700: '#44403c',
                    800: '#292524',
                    900: '#1c1917',
                },
            },
            fontFamily: {
                sans: ['"DM Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                display: ['"Playfair Display"', 'Georgia', 'serif'],
                mono: ['"DM Mono"', 'monospace'],
            },
            animation: {
                'fade-up': 'fadeUp 0.6s ease-out forwards',
                'fade-in': 'fadeIn 0.5s ease-out forwards',
                'slide-right': 'slideRight 0.6s ease-out forwards',
                'float': 'float 6s ease-in-out infinite',
                'shimmer': 'shimmer 2s linear infinite',
                'marquee': 'marquee 30s linear infinite',
            },
            keyframes: {
                fadeUp: {
                    '0%': { opacity: '0', transform: 'translateY(24px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideRight: {
                    '0%': { opacity: '0', transform: 'translateX(-24px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-12px)' },
                },
                shimmer: {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
                marquee: {
                    '0%': { transform: 'translateX(0%)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
            },
            boxShadow: {
                'soft': '0 4px 24px -4px rgba(0,0,0,0.08)',
                'card': '0 2px 12px -2px rgba(0,0,0,0.06), 0 0 0 1px rgba(0,0,0,0.04)',
                'hover': '0 16px 40px -8px rgba(56,146,122,0.2)',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
