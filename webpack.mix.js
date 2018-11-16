let mix = require('laravel-mix');

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

   // Pull in the javascript from vendors
mix.js('resources/assets/js/vendors.js', 'public/js')
   // Pull in the applications custom javascript
   .js('resources/assets/js/app.js', 'public/js')

   // Pull in the sass formatted css from vendors
   .sass('resources/assets/sass/vendors.scss', 'public/css')

   // Pull in leaflet
   .combine(['node_modules/leaflet/dist/leaflet.css'],
            'public/css/leaflet.css');
