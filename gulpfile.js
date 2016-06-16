var elixir = require('laravel-elixir'),
    liveReload = require('gulp-livereload'),
    clean = require('rimraf'),
    gulp = require('gulp'),
//    sass = require('gulp-sass'),
    concat = require('gulp-concat'),
//    uglify = require('gulp-uglify'),
//    htmlmin = require('gulp-htmlmin'),
//    gls = require('gulp-live-server'),
//    imagemin = require('gulp-imagemin')
    jshint = require('gulp-jshint'),
    stylish = require('jshint-stylish');

var config = {
    assets_path: './resources/assets',
    build_path: './public/build'
};
config.bower_path = config.assets_path + '/../bower_components';
config.build_path_css = config.build_path + '/css';
config.build_path_vendor_css = config.build_path_css + '/vendor';
config.vendor_path_css = [
    config.bower_path + '/bootstrap/dist/css/bootstrap.css',
    config.bower_path + '/bootstrap/dist/css/bootstrap-theme.css'
];
config.build_path_js = config.build_path + '/js';
config.build_path_vendor_js = config.build_path_js + '/vendor';
config.vendor_path_js = [
    config.bower_path + '/jquery/dist/jquery.js',
    config.bower_path + '/bootstrap/dist/js/bootstrap.js',
    config.bower_path + '/angular/angular.js',
    config.bower_path + '/angular-route/angular-route.js',
    config.bower_path + '/angular-resource/angular-resource.js',
    config.bower_path + '/angular-animate/angular-animate.js',
    config.bower_path + '/angular-messages/angular-messages.js',
    config.bower_path + '/angular-bootstrap/ui-bootstrap.js',
    config.bower_path + '/angular-strap/dist/modules/navbar.js',
    config.bower_path + '/angular-cookies/angular-cookies.js',
    config.bower_path + '/query-string/query-string.js',
    config.bower_path + '/angular-oauth2/dist/angular-oauth2.js'
];
config.build_path_html = config.build_path + '/views';
config.build_path_fonts = config.build_path + '/fonts';
config.build_path_images = config.build_path + '/images';

gulp.task('copy-html', function () {
    gulp.src([config.assets_path + '/js/views/**/*.html'])
        // .pipe(htmlmin({collapseWhitespace: true}))
        .pipe(gulp.dest(config.build_path_html))
        .pipe(liveReload());
});

gulp.task('copy-fonts', function () {
    gulp.src([config.assets_path + '/fonts/**/*'])
        .pipe(gulp.dest(config.build_path_fonts))
        .pipe(liveReload());
});

gulp.task('copy-images', function () {
    gulp.src([config.assets_path + '/images/**/*'])
        // .pipe(imagemin({ progressive: true }))
        .pipe(gulp.dest(config.build_path_images))
        .pipe(liveReload());
});

gulp.task('copy-styles', function () {
    gulp.src([config.assets_path + '/css/**/*.css'])
        .pipe(gulp.dest(config.build_path_css))
        .pipe(liveReload());
    gulp.src(config.vendor_path_css)
        .pipe(gulp.dest(config.build_path_vendor_css))
        .pipe(liveReload());
});

gulp.task('copy-scripts', function () {
    gulp.src([
        config.assets_path + '/js/**/*.js'
    ])
        // .pipe(uglify())
        .pipe(gulp.dest(config.build_path_js))
        .pipe(liveReload());
    gulp.src(config.vendor_path_js)
        // .pipe(uglify())
        .pipe(gulp.dest(config.build_path_vendor_js))
        .pipe(liveReload());
});

gulp.task('default', ['clear-build-folder'], function () {
    gulp.start('copy-html', 'copy-fonts', 'copy-images');
    elixir(function (mix) {
        mix.styles(config.vendor_path_css.concat([config.assets_path + '/css/**/*.css']),
            'public/css/all.css', config.assets_path);
        mix.scripts(config.vendor_path_js.concat([config.assets_path + '/js/**/*.js']),
            'public/js/all.js', config.assets_path);
        mix.version(['js/all.js', 'css/all.css']);
    })
});

gulp.task('watch-dev', ['clear-build-folder'], function () {
    liveReload.listen();
    gulp.start('copy-styles', 'copy-scripts', 'copy-html', 'copy-fonts', 'copy-images');
    gulp.watch(config.assets_path + '/**', ['copy-styles', 'copy-scripts', 'copy-html']);
});

gulp.task('dev', ['clear-build-folder'], function () {
    gulp.start('copy-styles', 'copy-scripts');
})


gulp.task('clear-build-folder', function () {
    clean.sync(config.build_path);
});

/**************************************************/
// SASS com CONCAT
// gulp.task('sass', function () {
//     return gulp.src('assets/src/sass/**/*.scss')
//         .pipe(concat('styles.min.css'))
//         .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
//         .pipe(gulp.dest('assets/css'));
// });
// //UGLIFY JS com CONCAT
// gulp.task('js', function () {
//     return gulp.src('assets/src/js/**/*.js')
//         .pipe(concat('script.min.js'))
//         .pipe(uglify())
//         .pipe(gulp.dest('assets/js'));
// });
// //IMAGEFY
// gulp.task('image', function() {
//     return gulp.src('src/img/*.jpg')
//         .pipe(imagemin({ progressive: true }))
//         .pipe(gulp.dest('images'));
// });
// });
// //HTMLFY
// gulp.task('htmlmin', function () {
//     return gulp.src('_html/**/*.html')
//         .pipe(htmlmin({collapseWhitespace: true}))
//         .pipe(gulp.dest('.'))
// });
// //WATCH
// gulp.task('watch', function() {
//     gulp.watch('assets/src/sass/**/*.scss',['sass']);
//     gulp.watch('assets/src/js/**/*.js',['js']);
//     gulp.watch('assets/src/images/*',['htmlmin']);
//     gulp.watch('_html/**/*.html',['image']);
// });
//
// //Live Reload - SERVER
// gulp.task('serve', function(){
//     var server = gls.static('./','8080');
//     server.start();
//
//     gulp.watch(config.assets_path + '/css/**/*.css', function(file){
//         gls.notify.apply(server,[file]);
//     });
//     gulp.watch(config.assets_path + '/js/**/*.js', function(file){
//         gls.notify.apply(server,[file]);
//     });
//     gulp.watch('assets/images/*', function(file){
//         gls.notify.apply(server,[file]);
//     });
//
// });
// //jslint
gulp.task('lint', function() {
    return gulp.src(config.assets_path + '/js/**/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter(stylish));
});
