/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        educore: {
          primary: '#1769FF',
          'primary-dark': '#1248D8',
          'primary-light': '#DCEBFF',
          'primary-subtle': '#EEF4FF',
          'page-bg': '#EAF2FF',
          surface: '#FFFFFF',
          'surface-soft': '#F5F8FF',
          'text-primary': '#17233F',
          'text-secondary': '#78849A',
          'text-muted': '#A0AEC0',
          border: '#E6ECF5',
          'border-light': '#F0F4FA',
          success: '#20B981',
          'success-light': '#E6F8F0',
          warning: '#F5A623',
          'warning-light': '#FEF5E7',
          danger: '#EF5B65',
          'danger-light': '#FDECEE',
          purple: '#9565F5',
          'purple-light': '#F2ECFE',
        },
      },
      fontFamily: {
        sans: ['Plus Jakarta Sans', 'Inter', 'system-ui', 'sans-serif'],
      },
      borderRadius: {
        'card': '20px',
        'inner': '16px',
        'subtle': '12px',
        'pill': '9999px',
        'outer': '28px',
      },
      boxShadow: {
        'soft': '0 8px 24px rgba(35, 72, 130, 0.06)',
        'card': '0 4px 20px rgba(23, 105, 255, 0.05)',
        'elevated': '0 12px 32px rgba(23, 72, 150, 0.08)',
        'glow': '0 4px 14px rgba(23, 105, 255, 0.35)',
        'frame': '0 16px 48px rgba(35, 72, 130, 0.08)',
      },
    },
  },
  plugins: [],
}

