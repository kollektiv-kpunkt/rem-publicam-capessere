const mix = require("laravel-mix");

mix
  .setPublicPath("dist")
  .js("src/js/app.js", "dist")
  .sass("src/css/style.scss", "dist")
  .postCss("src/css/theme.css", "dist", [
    require("tailwindcss"),
    require("postcss-nested"),
  ])
  .options({
    processCssUrls: false,
  });
