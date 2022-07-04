/*
	
@author: Edir Pedro
@website: https://edirpedro.com.br
@version: 2021

## Install Node LTS version to avoid incompatibilities
https://nodejs.org
	
## Creating NPM package.json
npm init

## Installing packages
npm install

## Running tasks
gulp rebuildimages
gulp watch

## Working with includes for Scripts
//=include vendor/jquery.js 
//=include vendor/*.js 
//=include relative/path/to/file.js 

*/

const paths					= {};
const gulp         	= require('gulp');

// CSS
const sass         	= require('gulp-sass')(require('sass'));
const autoprefixer 	= require('gulp-autoprefixer');
const minifycss    	= require('gulp-clean-css');
	
// JS
const uglify	    	= require('gulp-uglify');
const concat				= require('gulp-concat');
const include				= require('gulp-include');
	
// Tools
const newer        	= require('gulp-newer');
const sourcemaps   	= require('gulp-sourcemaps');
const rename       	= require('gulp-rename');
const notify       	= require('gulp-notify');
const plumber      	= require('gulp-plumber');

/* Styles
************************************************************/

paths.styles = {
	watch: 'source/scss/**/*.scss',
	dist: 'assets/css'
}

function styles() {
	
	return gulp.src( paths.styles.watch )
		.pipe( plumber({ errorHandler: notify.onError( "<%= error.message %>" ) } ) )
		.pipe( sourcemaps.init() )
		.pipe( sass( { outputStyle: 'expanded' } ) )
		.pipe( autoprefixer() )
		.pipe( gulp.dest( paths.styles.dist ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( minifycss() )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( paths.styles.dist ) );
		
}

/* Scripts
************************************************************/

paths.scripts = {
	watch: 'source/js/**/*.js',
	src: [ 'source/js/*.js', '!source/js/*.min.js' ],
	dist: 'assets/js'
}

function scripts() {  	
		
	return gulp.src( paths.scripts.src )
		.pipe( plumber( { errorHandler: notify.onError( "<%= error.message %>" ) } ) )
		.pipe( sourcemaps.init() )
		.pipe( include() )
		//.pipe( babel( { presets: ['es2015'] } ) )
		.pipe( gulp.dest( paths.scripts.dist ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( uglify() )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( paths.scripts.dist ) );
	
}

// Vendors

paths.vendors = {
	watch: [ 'source/js/vendor.min.js', 'source/js/vendor/*.js' ],
	src: 'source/js/vendor.min.js',
	dist: 'assets/js'
}

function vendors() {  	

	return gulp.src( paths.vendors.src )
		.pipe( plumber( { errorHandler: notify.onError( "<%= error.message %>" ) } ) )
		.pipe( include() )
		.pipe( gulp.dest( paths.vendors.dist ) );
	
}

/* Watch
************************************************************/

exports.default = () => {

	gulp.watch( paths.styles.watch, 		gulp.parallel( styles ) );
	gulp.watch( paths.scripts.watch, 		gulp.parallel( scripts ) );
	gulp.watch( paths.vendors.watch, 		gulp.parallel( vendors ) );
	
}