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

var paths = {
  src: {
    sass: 'resources/assets/sass'
  },
  public: {
    css: 'public/assets/css'
  }
}

gulp.task('default', function () {});
