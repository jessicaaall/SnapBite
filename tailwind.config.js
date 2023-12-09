/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/Views/**/*.php"],
  theme: {
    fontFamily: {
      'logo': ["'Lexend Exa'", 'sans-serif'],
      'text': ["'Inter'", 'sans-serif'],
    },
    extend: {},
  },
  plugins: [require("daisyui")],
}

