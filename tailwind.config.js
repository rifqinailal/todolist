 /** @type {import('tailwindcss').Config} */
 export default {
  content: ["./app/Views/**/*.{html,js,php}"],
  theme: {
    extend: {},
  },
  daisyui: {
    themes: ["nord"],
  },

  plugins: [require('daisyui'),],
}