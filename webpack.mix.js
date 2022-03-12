const mix = require('laravel-mix');

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
    .vue()
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/common/common.scss', 'public/css/common')
    .sass('resources/sass/login/login.scss', 'public/css/login')
    .sass('resources/sass/map/map.scss', 'public/css/map')
    .sass('resources/sass/map/map_detail.scss', 'public/css/map')
;
