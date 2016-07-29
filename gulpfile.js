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

/*
 |--------------------------------------------------------------------------
 | Plugins
 |--------------------------------------------------------------------------
 */

var gulp = require('gulp');
var sync = require('browser-sync');
var plug = require('gulp-load-plugins')({
  rename: {
    'gulp-connect-php': 'connect'
  }
});


/*
 |--------------------------------------------------------------------------
 | Configuration
 |--------------------------------------------------------------------------
 */

var path = {
  src: {
    sass: 'resources/assets/sass',
    bower: 'resources/assets/bower_components'
  },
  public: {
    css: 'public/assets/css',
    js: 'public/assets/js'
  }
};
// var production = !!plug.util.env.production;

/*
 |--------------------------------------------------------------------------
 | Compiling
 |--------------------------------------------------------------------------
 */

gulp.task('build:sass', function () {
  return gulp.src(path.src.sass + '/**/*.scss')
    .pipe(plug.sass({
      includePaths: [
          path.src.bower + '/bootstrap-sass/assets/stylesheets',
          path.src.bower + '/font-awesome/scss',
        ]
        // ,outputStyle: production ? 'compressed' : 'expanded'
    }))
    .pipe(plug.rename({
      suffix: ".built"
    }))
    .pipe(gulp.dest(path.public.css));
});
gulp.task('watch:sass', function () {
  return gulp.watch([
    path.src.sass + '/**/*.scss'
  ], ['build:sass', 'run:autoprefixer', 'rename']);
});
gulp.task('watch:css', function () {
  return gulp.watch([
    path.public.css + '/main.css'
  ], ['refresh']);
});

gulp.task('rename:css', ['run:autoprefixer'], function () {
  return gulp.src(path.public.css + '/main.built.prefixed.css')
    .pipe(plug.rename('main.css'))
    .pipe(gulp.dest(path.public.css));
});
// gulp.task('rename:map', ['run:autoprefixer'], function () {
//   return gulp.src(path.public.css + '/maps/main.built.prefixed.css.map')
//     .pipe(plug.rename('main.css.map'))
//     .pipe(gulp.dest(path.public.css + '/maps'));
// });
gulp.task('rename', ['rename:css']);
// gulp.task('rename', ['rename:css', 'rename:map']);

gulp.task('run:autoprefixer', ['build:sass'], function () {
  return gulp.src(path.public.css + '/main.built.css')
    // .pipe(plug.sourcemaps.init())
    .pipe(plug.autoprefixer({
      browsers: [
        "Android 2.3",
        "Android >= 4",
        "Chrome >= 20",
        "Firefox >= 24",
        "Explorer >= 8",
        "iOS >= 6",
        "Opera >= 12",
        "Safari >= 6"
      ],
      cascade: false
    }))
    .pipe(plug.rename({
      suffix: ".prefixed"
    }))
    // .pipe(plug.sourcemaps.write('./maps'))
    .pipe(gulp.dest(path.public.css));
});

/*
 |--------------------------------------------------------------------------
 | Assets
 |--------------------------------------------------------------------------
 */

gulp.task('copy:fonts', function () {
  return gulp.src(path.src.bower + '/bootstrap-sass/assets/fonts/bootstrap/**.*')
    .pipe(gulp.dest(path.public.css + '/fonts'));
});
gulp.task('copy:icons', function () { 
  return gulp.src(path.src.bower + '/font-awesome/fonts/**.*') 
    .pipe(gulp.dest(path.public.css + '/fonts'));
});
gulp.task('copy:js:jquery', function () { 
  return gulp.src([
      path.src.bower + '/jquery/dist/jquery.min.js',
      path.src.bower + '/jquery/dist/jquery.min.map'
    ])
    .pipe(gulp.dest(path.public.js));
});
gulp.task('copy:js:bootstrap', function () { 
  return gulp.src([
      path.src.bower + '/bootstrap-sass/assets/javascripts/bootstrap.min.js'
    ])
    .pipe(gulp.dest(path.public.js));
});


/*
 |--------------------------------------------------------------------------
 | Server
 |--------------------------------------------------------------------------
 */

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
gulp.task('watch:php', function () {
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


/*
 |--------------------------------------------------------------------------
 | Tasks
 |--------------------------------------------------------------------------
 */

gulp.task('default', ['connect']);
gulp.task('build', ['copy:js:jquery', 'copy:js:bootstrap', 'copy:fonts', 'copy:icons', 'build:sass', 'run:autoprefixer', 'rename']);
gulp.task('watch', ['connect', 'watch:php', 'watch:sass', 'watch:css'])
