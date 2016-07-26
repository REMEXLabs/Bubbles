/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// var elixir = require('laravel-elixir');
// elixir(function(mix) {
//     mix.sass('app.scss');
// });

var gulp = require('gulp');
var sync = require('browser-sync');
var plug = require('gulp-load-plugins')({
  rename: {
    'gulp-connect-php': 'connect'
  }
});

var path = {
  src: {
    sass: 'resources/assets/sass'
  },
  public: {
    css: 'public/assets/css'
  }
}

gulp.task('sass:build', function () {
  gulp.src(path.src.sass + '/**/*.scss')
    .pipe(plug.sass())
    .pipe(gulp.dest(path.public.css));
});
gulp.task('sass:watch', function () {
  gulp.watch([
    path.src.sass + '/**/*.scss'
  ], [
    'sass:build',
    'refresh'
  ]);
});

gulp.task('connect', function () {
  plug.connect.server({
    port: 8000,
    hostname: '127.0.0.1',
    base: 'public',
    keepalive: true,
    open: false
  }, function () {
    sync.init({
      proxy: '127.0.0.1:8000',
      port: 3000,
      notify: false,
      online: false
    });
  });
});
gulp.task('php:watch', function () {
  gulp.watch([
    'app/**/*.php',
    'resources/views/**/*.php'
  ], [
    'refresh'
  ]);
});

gulp.task('refresh', function () {
  sync.reload();
});

gulp.task('default', ['connect']);;
gulp.task('build', ['sass:build']);
gulp.task('watch', ['connect', 'php:watch', 'sass:watch'])
