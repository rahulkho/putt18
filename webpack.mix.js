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

mix.setPublicPath('public_html/');

mix.js('resources/js/public.js', 'public_html/js/dist')
    .js('resources/js/backend.js', 'public_html/js/dist')

	.sass('resources/sass/oxygen/bootstrap.scss', 'public_html/css/dist/bootstrap.css')
	.sass('resources/sass/public.scss', 'public_html/css/dist/public.css')
    .sass('resources/sass/backend.scss', 'public_html/css/dist/backend.css')
	.sass('resources/sass/auth.scss', 'public_html/css/dist/auth.css')
	.version()
	.sourceMaps()
	;

mix.browserSync({proxy: 'putt18.devv'});