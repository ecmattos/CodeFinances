const gulp = require('gulp');
const elixir = require('laravel-elixir');
const webpack = require('webpack');
const WebpackDevServer = require('webpack-dev-server');
const webpackConfig = require('./webpack.config');
const webpackDevConfig = require('./webpack.dev.config');
const mergeWebpack = require('webpack-merge');
const env = require('gulp-env');
const stringifyObject = require ('stringify-object');
const file = require('gulp-file');
const HOST = "localhost";


//require('laravel-elixir-vue');
//require('laravel-elixir-webpack-official');

//Elixir.webpack.config.module.loaders = [];

//Elixir.webpack.mergeConfig(webpackConfig);
//Elixir.webpack.mergeConfig(webpackDevConfig);


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

gulp.task('spa-config', () => {
	env({
		file: '.env',
		type: 'ini'
	});
	let spaConfig = require('./spa.config');
	//console.log(spaConfig);
	let string = stringifyObject(spaConfig);
	//console.log(string);
	return file('config.js', `module.exports = ${string};`, {src: true})
		.pipe(gulp.dest('./resources/assets/spa/js'));
});

gulp.task('webpack-dev-server', () => {
	
	let config = mergeWebpack(webpackConfig, webpackDevConfig);
	//console.log(config);
	
	let inlineHot = [
		'webpack/hot/dev-server',
		`webpack-dev-server/client?http://${HOST}:8080`
	];

	config.entry.admin = [config.entry.admin].concat(inlineHot);
	config.entry.spa = [config.entry.spa].concat(inlineHot);

	new WebpackDevServer(webpack(config),{
		hot: true,
		proxy: {
			'*': `http://${HOST}:8000`
		},
		watchOptions: {
			poll: true,
			aggregateTimeout: 1000
		},
		publicPath: config.output.publicPath,
		noInfo: true,
		stats:
			{
				colors: true
			}
	}).listen(8080, HOST, () => {
		console.log("Bundling project ...")
	});
});

elixir((mix) => {
    mix.sass('./resources/assets/admin/sass/admin.scss')
       .sass('./resources/assets/spa/sass/spa.scss')
       .copy('./node_modules/materialise-css/fonts/roboto', './public/fonts/roboto');
       //.webpack('app.js');

    gulp.start('spa-config', 'webpack-dev-server');

    mix.browserSync({
    	//host: '0.0.0.0',
    	host: HOST,
    	//proxy: 'http://192.168.10.10:8080'
    	proxy: `http://${HOST}:8080`
    });
});
