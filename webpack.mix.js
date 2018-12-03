let mix = require('laravel-mix');

mix.autoload({
    jquery: ['$', 'jQuery', 'window.jQuery'],
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix
    .setPublicPath('public/build')
    .setResourceRoot('../../build/')
    .js('resources/js/app.js', 'js')
    .sass('resources/css/app.scss', 'css')
    .version()
    .copyDirectory('resources/images', 'public/build/images/media');