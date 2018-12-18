// Include gulp
var gulp = require('gulp');

// Include our plugins
var jshint = require('gulp-jshint');
var less = require('gulp-less');
var minifyCss = require('gulp-clean-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');

// Lint task
gulp.task('lint', function() {
    return gulp
        .src('backend/web/js/app.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Compile less files of a full version
gulp.task('less_full', function() {
    return gulp
        .src('backend/less/_main_full/*.less')
        .pipe(less())
        .pipe(gulp.dest('backend/web/css'))
        .pipe(minifyCss({
            keepSpecialComments: 0
        }))
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(gulp.dest('backend/web/css'));
});


// Watch task
gulp.task('watch', function() {
    gulp.watch('backend/less/**/*.less', ['less_full']);
});

// Default task
// gulp.task('default', [
//     'lint',
//     'less_full',
//     'watch'
// ]);

// Compile LESS files only task
// gulp.task('compile', [
//     'less_full',
// ]);
