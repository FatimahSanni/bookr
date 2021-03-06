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

mix.js('resources/assets/js/app.js', 'public/js').sass('resources/assets/sass/app.scss', 'public/css').js('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js').js('node_modules/jquery/dist/jquery.min.js', 'public/js').js('node_modules/popper.js/dist/popper.js', 'public/js').copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css/bootstrap.min.css').copyDirectory('node_modules/font-awesome/fonts', 'public/fonts').copy('node_modules/font-awesome/css/font-awesome.min.css', 'public/css/font-awesome.min.css');
