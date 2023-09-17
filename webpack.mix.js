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
    .js('resources/js/app.js', 'public/assets/front/js')
    .js('resources/js/voucher.js', 'public/assets/front/js')
    .js('resources/js/payment.js', 'public/assets/front/js/payment.js')
    .js('resources/js/products.js', 'public/assets/front/js/products.js')
    .sass('resources/sass/app.scss', 'public/assets/front/css')
    .copyDirectory('resources/images', 'public/assets/front/images')
    .copyDirectory('resources/fonts', 'public/assets/front/fonts')
    .version();
