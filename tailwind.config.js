/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php",
    "./**/*.html"
  ],
  theme: {
    extend: {
      colors: {
          'electric-blue': '#2563EB',
          'cyan-accent': '#06B6D4',
          'deep-indigo': '#1E1B4B',
          'soft-cyan': '#ECFEFF',
          'silver-grey': '#E5E7EB',
          'dark-grey': '#111827',
      },
      fontFamily: {
          'sans': ['Inter', 'system-ui', 'sans-serif'],
          'serif': ['Playfair Display', 'serif'],
      },
      animation: {
          'float': 'float 6s ease-in-out infinite',
          'fade-in-up': 'fadeInUp 0.8s ease-out',
          'fade-in': 'fadeIn 1s ease-out',
          'slide-in-left': 'slideInLeft 0.8s ease-out',
          'slide-in-right': 'slideInRight 0.8s ease-out',
          'pulse-slow': 'pulse 3s infinite',
          'gradient': 'gradient 8s ease infinite',
          'shimmer': 'shimmer 2s linear infinite',
      },
      keyframes: {
          float: {
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-20px)' },
          },
          fadeInUp: {
              '0%': { opacity: '0', transform: 'translateY(30px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
          },
          fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
          },
          slideInLeft: {
              '0%': { opacity: '0', transform: 'translateX(-50px)' },
              '100%': { opacity: '1', transform: 'translateX(0)' },
          },
          slideInRight: {
              '0%': { opacity: '0', transform: 'translateX(50px)' },
              '100%': { opacity: '1', transform: 'translateX(0)' },
          },
          gradient: {
              '0%, 100%': { 'background-position': '0% 50%' },
              '50%': { 'background-position': '100% 50%' },
          },
          shimmer: {
              '0%': { 'background-position': '-200% 0' },
              '100%': { 'background-position': '200% 0' },
          }
      }
    }
  },
  plugins: [],
}
