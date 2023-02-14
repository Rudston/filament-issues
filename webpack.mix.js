// @see https://laravel-mix.com/docs/6.0/vue
const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')

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
mix.sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js'),
            require('postcss-import'),
            require('tailwindcss'),
            require('autoprefixer')],
    })
    .copy(
        'node_modules/@fortawesome/fontawesome-free/webfonts',
        'public/webfonts'
    )
    .vue();

if (mix.inProduction()) {
    mix.version();
}

//mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         require('postcss-import'),
//         require('tailwindcss'),
//         require('autoprefixer'),
//     ])
//     .sass('resources/sass/app.scss', 'public/css')
//     .copy(
//         'node_modules/@fortawesome/fontawesome-free/webfonts',
//         'public/webfonts'
//     )
//     .options({
//         processCssUrls: false,
//         postCss: [ tailwindcss('./tailwind.config.js') ],
//     })
//     .vue();
