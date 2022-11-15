module.exports = {
  content: require("fast-glob").sync(["./**/*.php", "*.php"]),
  safelist: [
    "w-screen",
    "top-0",
    "bg-opacity-70",
    "backdrop-blur-lg",
    "backdrop-filter",
    "opacity-0",
    "transition",
    "duration-500",
    "ease-in-out",
    {
      pattern: /text-(lg|sm|xs|[1-9]xl)/,
    },
  ],
  theme: {
    extend: {
      colors: {
        primary: "var(--prim)",
      },
    },
  },
  plugins: [],
};
