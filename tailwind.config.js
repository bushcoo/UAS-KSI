import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#fdf8e4',
          100: '#fcf2c9',
          200: '#f9e48f',
          300: '#f7d756',
          400: '#f4c91d',
          500: '#eab308', // yellow-500
          600: '#bb8f06',
          700: '#8c6b05',
          800: '#5d4703',
          900: '#2f2302',
        },
      },
    },
  },
  plugins: [],
}
