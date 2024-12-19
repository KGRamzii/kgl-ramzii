import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                light: {
                    'background': '#1F2544',    // Deep navy blue
                    'secondary': '#088395',     // Vibrant teal blue
                    'text-muted': '#37B7C3',    // Bright turquoise
                    'text-dark': '#EBF4F6',      // Very light blue-white
                    'card':'#384B70',
                  },
                  dark: {
                    'background': '#1A2B3C',    // Deep blue-gray background
                    'secondary': '#2C3E50',     // Rich blue-gray
                    'text-muted': '#57A6A1',    // Teal accent
                    'accent': '#4ECDC4',        // Bright teal
                    'text-light': '#E6F1FF'     // Very light blue-gray
                  }
              },
              textColor: {
                'light': {
                  'primary': '#EBF4F6',
                  'secondary': '#37B7C3'
                },
                'dark': {
                  'primary': '#E6F1FF',
                  'secondary': '#57A6A1'
                }
              },

              // Custom border radius to match your design
              borderRadius: {
                'custom': '0.75rem'
              },

              // Shadow variations
              boxShadow: {
                'custom-light': '0 4px 6px rgba(7, 25, 82, 0.1)',
                'custom-dark': '0 4px 6px rgba(26, 43, 60, 0.2)'
              },

              // Transition properties
              transitionProperty: {
                'custom': 'color, background-color, border-color, opacity, transform'
              },
              keyframes: {
                'fade-in': {
                  '0%': { opacity: '0' },
                  '100%': { opacity: '1' },
                },
                'slide-up': {
                  '0%': { opacity: '0', transform: 'translateY(20px)' },
                  '100%': { opacity: '1', transform: 'translateY(0)' },
                }
              },
              animation: {
                'fade-in': 'fade-in 0.5s ease-out',
                'slide-up': 'slide-up 0.5s ease-out',
                // Add new delay variations
                'slide-up-delay-100': 'slide-up 0.5s ease-out 0.1s',
                'slide-up-delay-200': 'slide-up 0.5s ease-out 0.2s',
                'slide-up-delay-300': 'slide-up 0.5s ease-out 0.3s',
                'slide-up-delay-400': 'slide-up 0.5s ease-out 0.4s',
                'slide-up-delay-500': 'slide-up 0.5s ease-out 0.5s',
            },

        },
    },

    variants: {
        extend: {
          animation: ['animate-slide-up']
        }
      },
    plugins: [forms],
};
