var elixir = require('laravel-elixir'),
    liveReload = require('gulp-livereload'),
    clean = require('rimraf'),
    gulp = require('gulp');

var config = {
    assets_path: './resources/assets',
    build_path: './public/build'
};
config.bower_path = config.assets_path + '/../bower_components';
config.build_path_js = config.build_path + '/js';
config.build_path_css = config.build_path + '/css';
config.build_path_vendor_js = config.build_path_js + '/vendor';
config.build_path_vendor_css = config.build_path_css + '/vendor';
config.vendor_path_js = [
    config.bower_path + '/jquery/dist/jquery.min.js',
    config.bower_path + '/bootstrap/dist/js/bootstrap.min.js',
    config.bower_path + '/angular/angular.min.js',
    config.bower_path + '/angular-route/angular-route.min.js',
    config.bower_path + '/angular-resource/angular-resource.min.js',
    config.bower_path + '/angular-animate/angular-animate.min.js',
    config.bower_path + '/angular-messages/angular-messages.min.js',
    config.bower_path + '/angular-bootstrap/ui-bootstrap.min.js',
    config.bower_path + '/angular-strap/dist/modules/navbar.min.js'
];
config.vendor_path_css = [
    config.bower_path + '/bootstrap/dist/css/bootstrap.min.css',
    config.bower_path + '/bootstrap/dist/css/bootstrap-theme.min.css'
];

gulp.task('default', ['clear-build-folder', 'clear-vendor-folder'], function () {
    elixir(function (mix) {
        mix.styles(config.vendor_path_css.concat([config.assets_path + '/css/**/*.css']),
            config.build_path_css + '/all.css', config.assets_path);
        mix.scripts(config.vendor_path_js.concat([config.assets_path + '/js/**/*.js']),
            config.build_path_js + '/all.js', config.assets_path);
        mix.version(['build/css/all.css', 'build/js/all.js']);
    })
});

gulp.task('dev', ['clear-build-folder', 'clear-vendor-folder'], function () {
    gulp.start('copy-styles', 'copy-scripts');
})

gulp.task('copy-styles', function () {
    gulp.src([
        config.assets_path + '/css/**/*.css'
    ])
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
        .pipe(gulp.dest(config.build_path_js))
        .pipe(liveReload());
    gulp.src(config.vendor_path_js)
        .pipe(gulp.dest(config.build_path_vendor_js))
        .pipe(liveReload());
});

gulp.task('clear-build-folder', function () {
    clean.sync(config.build_path);
});

gulp.task('clear-vendor-folder', function () {
    clean.sync(config.build_path_css);
    clean.sync(config.build_path_js);
});

gulp.task('watch-dev', ['clear-build-folder'], function () {
    liveReload.listen();
    gulp.start('copy-styles', 'copy-scripts');
    gulp.watch(config.assets_path + '/**', ['copy-styles', 'copy-scripts']);
});