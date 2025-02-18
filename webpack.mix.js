let mix = require('laravel-mix')
require('laravel-mix-compress')
const tailwindcss = require('tailwindcss');


const assetsPath = 'assets';

mix.setPublicPath('./assets/build/')

mix.sass(`${assetsPath}/sass/main.sass`, `${assetsPath}/build/`).options({
    processCssUrls: false,
    postCss: [
        tailwindcss('./tailwind.config.js'),
        require('autoprefixer')
    ],
});

mix.js(`${assetsPath}/js/main.js`, `${assetsPath}/build/`)
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
        'jquery-migrate': ['jquery-migrate', 'jQuery.migrate']
    })
    .extract([
        'alpinejs'
    ]);


// Concat jquery scripts
mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/jquery-migrate/dist/jquery-migrate.js'
], `${assetsPath}/build/jquery.bundle.js`);

mix.version();

if (mix.inProduction()) {
    mix.sourceMaps();
    mix.compress({
        useBrotli: true,
        minRatio: 1
    });

    mix.version();
}