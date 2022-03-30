const mix = require("laravel-mix");
var LiveReloadPlugin = require("webpack-livereload-plugin");

mix.webpackConfig({
  plugins: [new LiveReloadPlugin()],
});

mix
  .setPublicPath("dist")
  .js("src/js/app.js", "dist")
  .sass("src/css/style.scss", "dist")
  .postCss("src/css/theme.css", "dist", [
    require("tailwindcss"),
    require("postcss-nested"),
  ]);
