/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './node_modules/preline/dist/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['system-ui', 'sans-serif'],
      },
      colors: {
        'customRed': 'rgb(255, 0, 0)',
        'yellow': 'rgb(255, 255, 0)',
      },
      spacing: {
        '1.25': '5px',
        '1.75': '7px',
        '6.5': '25px',
        '12.5': '50px',
        '3/10': '30%',
      },
    },
  },
  plugins: [
    require('preline/plugin'),
    require('@tailwindcss/forms'),
    function ({ addUtilities }) {
      const newUtilities = {
        '.box-revert': {
          'box-sizing': 'revert',
        },
      }
      addUtilities(newUtilities, ['responsive', 'hover'])
    },
  ],
};
