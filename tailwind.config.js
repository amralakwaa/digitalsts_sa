/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Http/Controllers/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        /* STS Primary Brand — Deep Tech Blue */
        brand: {
          50: '#eef6ff',
          100: '#d9ebff',
          200: '#bcdaff',
          300: '#8ec3ff',
          400: '#59a2ff',
          500: '#0c8de7',
          600: '#0070c5',
          700: '#0059a0',
          800: '#054c84',
          900: '#0a3f6e',
          950: '#072849',
        },
        /* Surface / Neutrals — STS Logo Midnight Obsidian & Tech Blue undertone */
        surface: {
          50: '#f8fafc',
          100: '#f1f5f9',
          200: '#e2e8f0',
          300: '#cbd5e1',
          400: '#94a3b8',
          500: '#64748b',
          600: '#334155',
          700: '#1a243b',
          800: '#0c1530',
          900: '#050a20',
          950: '#010318',
        },
        /* Accent palette */
        accent: {
          sky: '#0ea5e9',
          blue: '#3b82f6',
          indigo: '#6366f1',
          teal: '#14b8a6',
          emerald: '#10b981',
          amber: '#f59e0b',
          rose: '#f43f5e',
        },
        /* STS Logo dark background specific */
        navy: {
          900: '#010318',
          800: '#040822',
          700: '#0a1435',
          600: '#12204c',
        },
      },
      fontFamily: {
        cairo: ['Cairo', 'sans-serif'],
        outfit: ['Outfit', 'sans-serif'],
        inter: ['Inter', 'sans-serif'],
      },
      boxShadow: {
        'soft': '0 2px 12px -3px rgba(0, 0, 0, 0.06), 0 8px 20px -4px rgba(0, 0, 0, 0.04)',
        'soft-lg': '0 8px 32px -8px rgba(0, 0, 0, 0.1)',
        'soft-xl': '0 16px 48px -12px rgba(0, 0, 0, 0.12)',
        'card': '0 1px 3px rgba(0, 0, 0, 0.04), 0 8px 24px -6px rgba(0, 0, 0, 0.06)',
        'card-hover': '0 16px 40px -8px rgba(12, 109, 181, 0.15), 0 4px 12px -2px rgba(0, 0, 0, 0.06)',
        'brand-glow': '0 6px 24px -4px rgba(12, 109, 181, 0.35)',
        'brand-glow-lg': '0 12px 40px -6px rgba(12, 109, 181, 0.4)',
        'inner-light': 'inset 0 1px 0 0 rgba(255, 255, 255, 0.8)',
        'dark-card': '0 4px 20px -4px rgba(0, 0, 0, 0.3), 0 8px 40px -8px rgba(0, 0, 0, 0.2)',
        'dark-glow': '0 0 30px -6px rgba(12, 141, 231, 0.25)',
      },
      backdropBlur: {
        xs: '2px',
      },
      animation: {
        'float': 'float 6s ease-in-out infinite',
        'float-delay': 'float 6s ease-in-out 2s infinite',
        'slide-up': 'slideUp 0.5s ease-out',
        'fade-in': 'fadeIn 0.6s ease-out',
        'pulse-soft': 'pulseSoft 3s ease-in-out infinite',
        'shimmer': 'shimmer 2s linear infinite',
        'counter-pop': 'counterPopSpring 0.75s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards',
      },
      keyframes: {
        counterPopSpring: {
          '0%': { transform: 'scale(0.6) translateY(14px)', opacity: '0', filter: 'blur(3px)' },
          '60%': { transform: 'scale(1.16) translateY(-3px)', opacity: '1', filter: 'blur(0)' },
          '80%': { transform: 'scale(0.96) translateY(1px)' },
          '100%': { transform: 'scale(1) translateY(0)', opacity: '1', filter: 'blur(0)' },
        },
        float: {

          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-20px)' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        pulseSoft: {
          '0%, 100%': { opacity: '1' },
          '50%': { opacity: '0.6' },
        },
        shimmer: {
          '0%': { backgroundPosition: '-200% 0' },
          '100%': { backgroundPosition: '200% 0' },
        },
      },
    },
  },
  plugins: [],
}
