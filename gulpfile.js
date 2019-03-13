// Include gulp
var gulp = require('gulp');

// Include our plugins
var jshint = require('gulp-jshint');
var less = require('gulp-less');
var sass = require('gulp-sass');
var minifyCss = require('gulp-clean-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var babel = require("gulp-babel");

// JSX files
var sourceJsx = [
  'frontend/react/components/*.jsx',
  'frontend/react/*.jsx',
];

// Lint task
gulp.task('lint', function() {
    return gulp
        .src('backend/web/js/app.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Compile less files of a full version
gulp.task('backend', function() {
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

gulp.task('frontend', function() {
    return gulp
        .src('frontend/scss/**/*.scss')
        .pipe(sass({outputStyle: 'expanded'}))
        .pipe(gulp.dest('frontend/web/css'))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(gulp.dest('frontend/web/css'));
});

gulp.task('react', function() {
    return gulp
        .src(sourceJsx)
        .pipe(babel({
            presets: ["@babel/react", '@babel/preset-env']
        }))
        .pipe(concat('all.js'))
        .pipe(gulp.dest('frontend/web/js/clinic'))
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(uglify())
        .pipe(gulp.dest('frontend/web/js/clinic'));
});

gulp.task('default', function () {
  gulp.watch('frontend/react/**/*.jsx', gulp.parallel('react'));
  // gulp.watch('frontend/scss/**/*.scss', gulp.parallel('frontend'));
  // gulp.watch('backend/less/_main_full/*.less', gulp.parallel('backend'));
});
