/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './404.php',
    './header.php',
    './footer.php',
    './blocks/**/*.php',
    './blocks/**/*.js',
    './assets/css/*.css',
    './assets/js/*.js'
  ],
  theme: {
    extend: {
      fontFamily: {
        'roboto': 'Roboto',
      },
      fontSize: {
        'clamp-h1': ['clamp(2.188rem, 4vw + 1rem, 4.375rem)', {
          lineHeight: '112%',
        }],
        'clamp-h2': ['clamp(1.625rem, 1vw + 1.25rem, 2.5rem)', {
          lineHeight: '125%',
        }],
        'clamp-h3': ['clamp(1.313rem, 3vw - 1rem, 1.875rem)', {
          lineHeight: '125%',
        }],
        'clamp-h4': ['clamp(1.188rem, 3vw - 1rem, 1.5rem)', {
          lineHeight: '125%',
        }],
        'clamp-text': ['clamp(0.938rem, 2vw - 1rem, 1.063rem)', {
          lineHeight: '165%',
        }],
      },
      colors: {
        'primary': '#670229',
        'secondary': '#F4ECE1',
      },
      maxWidth: {
        'wrapper': '1520px',
      },
      boxShadow: {
        'header': '0 0 40px rgba(0, 0, 0, 0.1)',
        'card': '0 0 40px rgba(0, 0, 0, 0.1)',
      },
      zIndex: {
        '1': '1',
        'negative': '-1',
      },
      screens: {
        '2xl': '1440px',
        '3xl': '1600px',
        '4xl': '1921px',
      },
    },
  },
  plugins: [],
}

