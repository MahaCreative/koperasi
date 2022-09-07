/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],

  theme: {
    container: {
        center: true,
        padding: "16px",
      },
    extend: {
        colors: {
            primary: "#14b8a6",
            primary2: "#14b8a6",
            dark: "#0f172a",
            dark2: "#0f172a",
            secondary2: "#64748b",
            secondary: "#64748b",
          },
          screens: {
            "2xl": "1320px",
          },
    },
  },
  plugins: [
    require('tw-elements/dist/plugin')
  ],
}
