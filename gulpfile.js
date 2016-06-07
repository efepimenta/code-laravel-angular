var elixir = require('laravel-elixir'),
    liveReload = require('gulp-livereload'),
    clean = require('rimraf'),
    gulp = require('gulp');

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
    config.bower_path + '/angular-strap/dist/modules/navbar.js'
];

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
        .pipe(gulp.dest(config.build_path_js))
        .pipe(liveReload());
    gulp.src(config.vendor_path_js)
        .pipe(gulp.dest(config.build_path_vendor_js))
        .pipe(liveReload());
});

gulp.task('default', ['clear-build-folder'], function () {
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
    gulp.start('copy-styles', 'copy-scripts');
    gulp.watch(config.assets_path + '/**', ['copy-styles', 'copy-scripts']);
});

gulp.task('dev', ['clear-build-folder'], function () {
    gulp.start('copy-styles', 'copy-scripts');
})



gulp.task('clear-build-folder', function () {
    clean.sync(config.build_path);
});