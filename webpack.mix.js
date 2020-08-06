const mix = require('laravel-mix');

require('laravel-mix-tailwind');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/alpine.js', 'public/js')
    .js('resources/js/clipboard.js', 'public/js')
;

mix
    .postCss('resources/css/style.css', 'public/css')
    .tailwind('./tailwind.config.js')
;

if (mix.inProduction()) {
  mix.version();
}
