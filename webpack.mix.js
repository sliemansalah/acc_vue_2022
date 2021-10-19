const mix = require('laravel-mix');

mix.js('resources/js/app/main.js', 'public/js/main.js')
    .webpackConfig({
        output: {
            chunkFilename: 'js/[name].js' + (mix.inProduction() ? '?id=[chunkhash]' : ''),
        },
        resolve: {
            alias: {
                '@': path.resolve(__dirname, '/resources/js/app'),
            },
        },
    });
