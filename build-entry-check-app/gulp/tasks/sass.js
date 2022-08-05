var gulp 		= require('gulp'),
	sass 		= require('gulp-sass'),
	config 		= require('../../gulp/config.json'),
	cssnano 	= require('gulp-cssnano'),
	rename      = require('gulp-rename'),
	gutil		= require('gulp-util'),
	livereload 	= require('gulp-livereload'),
	sourcemaps  = require('gulp-sourcemaps'),
	notify      = require('gulp-notify');

gulp.task('sass', function(){

	return gulp.src(config.styles.src)
			.pipe(gutil.env.production ? gutil.noop() : sourcemaps.init())
    		.pipe(sass.sync().on('error', sass.logError))
    		.pipe(notify('sass compiled to css'))
    		.pipe(cssnano())
    		.pipe(notify('css minified'))
    		.pipe(rename('entry-check-app.css'))
    		.pipe(gutil.env.production ? gutil.noop() : sourcemaps.write())
    		.pipe(gulp.dest(config.styles.dest))
    		.pipe(livereload())
    		.pipe(notify('sass task completed'));

});