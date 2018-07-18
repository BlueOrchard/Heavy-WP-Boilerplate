var gulp        = require('gulp');
var sass        = require('gulp-sass');
var merge       = require('merge-stream');
var concat      = require('gulp-concat');
var prefix      = require('gulp-autoprefixer');
var clean       = require('gulp-clean-css');
var wait        = require('gulp-wait');
var plumber     = require('gulp-plumber');
var gutil       = require('gulp-util');
var browserSync = require('browser-sync');
var uglify      = require('gulp-uglify');

var devCSS = 'src/css/';

gulp.task('cssPack', function() {
    var sassFiles,
        cssFiles,
        themeInfo;

    sassFiles = gulp.src(devCSS + 'style-style-main.scss')
        .pipe(plumber(function (error) {
            gutil.log(error.message);
            this.emit('end');
        }))
        .pipe(wait(500))
        .pipe(sass());

    cssFiles = gulp.src(devCSS + '*.css');

    return merge(sassFiles, cssFiles)
           .pipe(concat('style.min.css'))
           .pipe(prefix())
           .pipe(clean({
                        level: {
                            1: {
                                specialComments : 0
                            }
                        }
                        }))
           .pipe(gulp.dest("./public/css/"));
});

gulp.task('jsPack', function(){
    var devScripts,
        submitScript;

    devScripts = gulp.src(['./src/js/*.js', '!./src/js/ignore.*.js']);
    submitScript = gulp.src('./email-component/email-ajax.js');
    submitVolunteerScript = gulp.src('./volunteer-component/email-ajax.js');

    return merge(devScripts, submitScript, submitVolunteerScript)
            .pipe(concat('bundle.min.js'))
            .pipe(plumber(function (error) {
                gutil.log(error.message);
                this.emit('end');
            }))
            .pipe(uglify())
            .pipe(gulp.dest('./public/js'));
})

gulp.task('browserSync', function(){
    var files = [
        './*.php',
        './**/*.php',
        './public/css/*.css',
        './public/js/*.js',
    ];

    browserSync.init(files, {
        proxy: 'http://127.0.0.1:8888/wp/'
    });
});

gulp.task('default', ['cssPack', 'jsPack', 'browserSync'], function() {
    gulp.watch(devCSS + '*.css', ['cssPack']);
    gulp.watch(devCSS + '*.scss', ['cssPack']);
    gulp.watch(devCSS + 'prefab/*.scss', ['cssPack']);
    gulp.watch(devCSS + 'import/*.scss', ['cssPack']);
    gulp.watch(devCSS + 'extra/*.scss', ['cssPack']);

    gulp.watch('./src/js/*.js', ['jsPack']);
    gulp.watch('./email-component/*.js', ['jsPack']);
    gulp.watch('./volunteer-component/*.js', ['jsPack']);
});