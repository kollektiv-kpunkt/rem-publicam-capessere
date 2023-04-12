module.exports = {
  content: [
    './*.php',
    './inc/**/*.php',
    './**/*.php',
    './**/**/*.php',
    './safelist.txt'
  ],
  safelist: [
  ],
  safelist: [
    {
      pattern: /text-(lg|sm|xs|[1-9]xl)/,
    },
  ],
  theme: {
    extend: {
      colors: {
        primary: "#e53136",
      },
    },
  },
  plugins: [],
};
