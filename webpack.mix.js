const mix = require('laravel-mix');
require('laravel-mix-blade-reload')
require('laravel-mix-tailwind')

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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .bladeReload({
        path: 'resources/views/*.blade.php'
    })
    .bladeReload({
        path: 'resources/views/**/*.blade.php'
    })
    .tailwind()
    .options({
        hmrOptions: {
            host: 'hmr.localhost',
            port: 80
        }
    })
    .webpackConfig({
        devServer: {
            host: "0.0.0.0",
            port: 8080
        }
    })
