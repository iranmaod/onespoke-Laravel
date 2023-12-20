const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/script.js', 'public/js')
    .js('resources/js/home.js', 'public/js')
    .js('resources/js/buy.js', 'public/js')
    .js('resources/js/sell.js', 'public/js')
    .js('resources/js/pricing.js', 'public/js')
    .js('resources/js/contact-form.js', 'public/js')
    .js('resources/js/bikes/show.js', 'public/js/bikes/show.js')
    .js('resources/js/account/profile.js', 'public/js/account/profile.js')
    .js('resources/js/account/listings.js', 'public/js/account/listings.js')
    .js('resources/js/account/favourites.js', 'public/js/account/favourites.js')
    .js('resources/js/account/messages.js', 'public/js/account/messages.js')
    .js('resources/js/user/profile.js', 'public/js/user/profile.js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        autoprefixer: true,
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })
    .copyDirectory('node_modules/lightgallery/fonts', 'public/fonts')
    .copyDirectory('node_modules/lightgallery/images', 'public/images');

if (mix.inProduction()) {
    mix.version();
}
