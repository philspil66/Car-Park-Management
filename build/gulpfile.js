
var gulp        = require( 'gulp' );
var runSequence = require( 'run-sequence' );
var requireDir  = require( 'require-dir' );
var config		= require('./gulp/config.json');

// require all tasks
requireDir('./gulp/tasks', { recurse : true });

// common tasks
gulp.task('default', function(){

	//console.log(config.styles.src);
	//console.log(config.styles.dest);
	gulp.start('sass');

});

