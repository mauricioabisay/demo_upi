'use strict';
(function() {
	var util = require('gulp-util');
	var run	= require('run-sequence');
	var bs 	= require('browser-sync').create();
	var gulp = require('gulp');
	var watch = require('gulp-watch');
	var plumber = require('gulp-plumber');
	var sourcemaps = require('gulp-sourcemaps');
	var sass = require('gulp-sass');
	var autoprefixer = require('gulp-autoprefixer');
	var pug = require('gulp-pug');
	var pugPHPFilter = require('pug-php-filter');
	var concat = require('gulp-concat');
	var uglify = require('gulp-uglify');
	var changed = require('gulp-changed');
	var imagemin = require('gulp-imagemin');

	function errorHandler(error) {
		util.beep();
		util.beep();
		util.beep();
		console.log(error.toString());
		return true;
	}

	var refreshFunction = function () {
		bs.reload();
		return;
	}

	var imageFunction = function() {
		var dest = './img';
		gulp.src('./_dev/images/*.+(png|jpg|jpeg|gif|svg)')
		.pipe(changed(dest))
		.pipe(imagemin({
			progressive: true
		}))
		.pipe(gulp.dest(dest));
	};

	var sassFunction = function() {
		gulp.src('./_dev/styles/**/*')
		.pipe(plumber(errorHandler))
		.pipe(sourcemaps.init())
		.pipe(sass({
			//outputStyle: 'compressed',
			includePaths: [
			]
		}))
		.pipe(autoprefixer({
			browsers: ['last 2 versions']
		}))
		.pipe(sourcemaps.write('./'))
		.pipe(plumber.stop())
		.pipe(gulp.dest('./'))
		.pipe(bs.stream({match: '**/*.css'}));
	};

	var pugFunction = function() {
		gulp.src(['./_dev/templates/**/*.pug', '!./_dev/templates/**/_*.pug'])
		.pipe(plumber(errorHandler))
		.pipe(pug({
			pretty: true,
			filters: {
				php: pugPHPFilter
			}
		}))
		//.pipe(rename({extname: '.php'}))
		.pipe(plumber.stop())
		.pipe(gulp.dest('./dist/'))
		.pipe(bs.stream());
	};

	var jsPublicFunction = function() {
		gulp.src([
				//'./bower_components/Scrollify/jquery.scrollify.js',
				'./bower_components/jarallax/dist/jarallax.js',
				'./_dev/scripts/public/**/*.js',
			])
			.pipe(plumber(errorHandler))
			.pipe(sourcemaps.init())
			.pipe(concat('script.js'))
			.pipe(uglify())
			.pipe(sourcemaps.write('./'))
			.pipe(plumber.stop())
			.pipe(gulp.dest('./'))
			.pipe(bs.stream());
	};

	var jsAdminFunction = function() {
		gulp.src([
			'./_dev/scripts/admin/**/*.js',
		])
		.pipe(plumber(errorHandler))
		.pipe(sourcemaps.init())
		.pipe(concat('admin.js'))
		.pipe(uglify())
		.pipe(sourcemaps.write('./'))
		.pipe(plumber.stop())
		.pipe(gulp.dest('./'))
		.pipe(bs.stream());
	};

	var buildWPTheme = function() {
		//Normal override files for child theme
		gulp.src([
			'./favicon.ico',
			'./screenshot.png',
			'./*.php',
			'./*.css',
			'./*.js',
			'./nwm_wp/*',
			'!./gulpfile.js',
		])
		.pipe(plumber(errorHandler))
		.pipe(gulp.dest('./theme/'));
		//Images, should go in the img forlder
		gulp.src('./img/**/*')
		.pipe(plumber(errorHandler))
		.pipe(gulp.dest('./theme/img/'));
		//Override for Woocommerce Plugin templates
		gulp.src('./woocommerce/**/*')
		.pipe(plumber(errorHandler))
		.pipe(gulp.dest('./theme/woocommerce/'));
		//Slick carousel
		gulp.src('./fonts/**/*')
		.pipe(plumber(errorHandler))
		.pipe(gulp.dest('./theme/fonts/'));
		gulp.src('./ajax-loader.gif')
		.pipe(plumber(errorHandler))
		.pipe(gulp.dest('./theme/'));
	}

	gulp.task('sass', sassFunction);
	gulp.task('pug', pugFunction);
	gulp.task('js-public', jsPublicFunction);
	gulp.task('js-admin', jsAdminFunction);
	gulp.task('image', imageFunction);
	gulp.task('theme', ['sass', 'image', 'pug', 'js-public', 'js-admin'], buildWPTheme);

	gulp.task('default', ['sass', 'image', 'pug', 'js-public', 'js-admin'], function() {
		bs.init({
			//server: './dist/'
			proxy: 'localhost:8000/'
		});
		watch('./_dev/styles/**/*', sassFunction);
		watch(['./*.php', './**/*.php'], refreshFunction);
		//watch('./_dev/templates/**/*.pug', pugFunction);
		watch('./_dev/scripts/public/**/*.js', jsPublicFunction);
		watch('./_dev/scripts/admin/**/*.js', jsAdminFunction);
		watch('./_dev/images/*.+(png|jpg|gif)', imageFunction);
	});

})();