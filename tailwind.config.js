module.exports = {
  content: [
    './templates/*/*.html.twig',
    './templates/base.html.twig',
  ],
  theme: {
    extend: {
      colors: {
        color: {
          accent_light: "#eeebfc",
          lighter: "#d3c7fc",
          light: "#b19aff",
          normal: "#9070fd",
          dark: "#1a0a4f",
        }
      }
    },
  },
}
