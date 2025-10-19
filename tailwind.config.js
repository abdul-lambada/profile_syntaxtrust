/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{js,jsx,ts,tsx}",
    "./app/**/*.php",
    "./app/views/**/*.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Inter", "ui-sans-serif", "system-ui"],
      },
      colors: {
        primary: {
          DEFAULT: "#1C64F2",
          light: "#E6F1FF",
          dark: "#0045C6",
        },
        accent: {
          DEFAULT: "#3B82F6",
          soft: "#EEF5FF",
        },
        muted: "#6B7280",
      },
      boxShadow: {
        soft: "0 25px 50px -12px rgba(37, 99, 235, 0.08)",
        card: "0 20px 40px -15px rgba(15, 118, 110, 0.1)",
      },
    },
  },
  plugins: [],
};
