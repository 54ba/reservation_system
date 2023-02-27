const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/main.js', 'public/dist/js')
    .copy('node_modules/bootstrap/dist/css/bootstrap.css', 'public/dist/css/bootstrap.css')
    .version()
    .vue();

module.exports = {

    resolve: {
        alias: {
            vue: 'vue/dist/vue.js'
        }
    }

}