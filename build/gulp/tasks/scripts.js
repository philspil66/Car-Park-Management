var gulp 		= require('gulp'),
	config 		= require('../../gulp/config.json'),
	browserify  = require('gulp-browserify'),
	uglify		= require('gulp-uglify'),
	rename		= require('gulp-rename'),
	livereload 	= require('gulp-livereload'),
	notify      = require('gulp-notify');

gulp.task('scripts', function(){

	return gulp.src('./js/index.js')
		.pipe(browserify({
		  insertGlobals : true
		}))
		.pipe(notify('scripts bundled'))
		.pipe(uglify())
		.pipe(notify('scripts uglified'))
		.pipe(rename('scripts.js'))
		.pipe(gulp.dest(config.scripts.dest))
		.pipe(livereload())
		.pipe(notify('scripts task completed'));

});