var gulp 		= require('gulp'),
	livereload 	= require('gulp-livereload'),
	config 		= require('../../gulp/config.json');

gulp.task('watch', function() {
	
  	livereload.listen();
  	gulp.watch(config.styles.src, ['sass']);
  	gulp.watch(config.scripts.src, ['scripts']);
  	gulp.watch(config.views.src, livereload.reload);

});