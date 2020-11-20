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


mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/dashboard/user/user.js', 'public/js/dashboard/user')
    .js('resources/js/dashboard/user/user-main.js', 'public/js/dashboard/user')

    .js('resources/js/dashboard/role/role-main.js', 'public/js/dashboard/role')


    .js('resources/js/dashboard/main.js', 'public/js/dashboard/main')

    .sass('resources/sass/app.scss', 'public/css')
    .browserSync("http://127.0.0.1:8000/")
    .sourceMaps()
    .disableSuccessNotifications()

