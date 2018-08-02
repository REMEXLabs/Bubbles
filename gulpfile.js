/*!
  Copyright 2015 – 2017 Hochschule der Medien (HdM) / Stuttgart Media University

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

    https://github.com/REMEXLabs/Bubbles/blob/master/LICENSE

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License.
*/
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

const gulp = require('gulp');
const sync = require('browser-sync');
const plug = require('gulp-load-plugins')({
    rename: {
        'gulp-connect-php': 'connect',
        'gulp-google-webfonts': 'gfonts',
    }
});


/*
 |--------------------------------------------------------------------------
 | Configuration
 |--------------------------------------------------------------------------
 */

const path = {
    src: {
        assets: 'resources/assets',
        sass: 'resources/assets/sass',
        css: 'resources/assets/css',
        js: 'resources/assets/js',
        bower: 'resources/assets/bower_components'
    },
    public: {
        css: 'public/assets/css',
        js: 'public/assets/js'
    }
};

/*
 |--------------------------------------------------------------------------
 | CSS
 |--------------------------------------------------------------------------
 */

gulp.task('build:sass', () => {
    return gulp.src(path.src.sass + '/**/*.scss')
        .pipe(plug.sass({
            includePaths: [
                path.src.bower + '/bootstrap-sass/assets/stylesheets',
                path.src.bower + '/font-awesome/scss',
                path.src.bower + '/bootstrap-social'
            ]
        }))
        .pipe(plug.rename({
            suffix: ".built"
        }))
        .pipe(gulp.dest(path.public.css));
});

gulp.task('build:css', () => {
    return gulp.src(path.src.css + '/**/*.css')
        .pipe(gulp.dest(path.public.css));
});

gulp.task('run:autoprefixer', ['build:sass'], () => {
    return gulp.src(path.public.css + '/main.built.css')
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
        .pipe(gulp.dest(path.public.css));
});


/*
 |--------------------------------------------------------------------------
 | JavaScript
 |--------------------------------------------------------------------------
 */

gulp.task('compile:js', () => {
    return gulp.src(path.src.js + '/main.js')
        .pipe(plug.rename('main.uglified.js'))
        .pipe(gulp.dest(path.src.js))
        .pipe(plug.uglify())
        .pipe(gulp.dest(path.src.js));
});

gulp.task('cookies:js', () => {
    console.log(path.src.js + '/remex-cookies.min.js');
    return gulp.src([
        path.src.js + '/remex-cookies.min.js',
        path.src.js + '/cookieconsent.min.js'
    ])
        .pipe(gulp.dest(path.public.js));
});

gulp.task('concat:js', ['compile:js'], () => {
    return gulp.src([
        path.src.bower + '/jquery/dist/jquery.min.js',
        path.src.js + '/vendor/jquery.dataTables.min.js',
        path.src.js + '/vendor/dataTables.bootstrap.min.js',
        path.src.bower + '/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        path.src.bower + '/masonry/dist/masonry.pkgd.min.js',
        path.src.bower + '/moment/min/moment.min.js',
        path.src.bower + '/moment-timezone/builds/moment-timezone-with-data.min.js',
        path.src.js + '/main.uglified.js'
    ])
        .pipe(plug.sourcemaps.init())
        .pipe(plug.concat('main.js', {
            newLine: ';\n\n'
        }))
        .pipe(plug.sourcemaps.write('./maps'))
        .pipe(gulp.dest(path.public.js));
});
gulp.task('build:js', ['cookies:js', 'compile:js', 'concat:js']);


/*
 |--------------------------------------------------------------------------
 | Assets
 |--------------------------------------------------------------------------
 */

gulp.task('copy:fonts', () => {
    return gulp.src(path.src.bower + '/bootstrap-sass/assets/fonts/bootstrap/**.*')
        .pipe(gulp.dest(path.public.css + '/fonts'));
});
gulp.task('copy:icons', () => {
    return gulp.src(path.src.bower + '/font-awesome/fonts/**.*')
        .pipe(gulp.dest(path.public.css + '/fonts'));
});
gulp.task('copy:google:fonts', () => {
    return gulp.src(path.src.assets + '/fonts.list')
        .pipe(plug.gfonts({
            fontsDir: './fonts/',
            cssDir: './',
            cssFilename: 'google_fonts.css'
        }))
        .pipe(gulp.dest(path.public.css));
});
gulp.task('copy:assets', ['copy:google:fonts', 'copy:fonts', 'copy:icons']);


/*
 |--------------------------------------------------------------------------
 | Renaming
 |--------------------------------------------------------------------------
 */

gulp.task('rename:css', ['run:autoprefixer'], () => {
    return gulp.src(path.public.css + '/main.built.prefixed.css')
        .pipe(plug.rename('main.css'))
        .pipe(gulp.dest(path.public.css));
});
gulp.task('rename:theme:css', ['run:autoprefixer'], () => {
    return gulp.src(path.public.css + '/theme_gray.built.css')
        .pipe(plug.rename('theme_gray.css'))
        .pipe(gulp.dest(path.public.css));
});
gulp.task('rename', ['rename:css', 'rename:theme:css']);


/*
 |--------------------------------------------------------------------------
 | Server
 |--------------------------------------------------------------------------
 */

gulp.task('connect', () => {
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
gulp.task('refresh', () => {
    sync.reload();
});


/*
 |--------------------------------------------------------------------------
 | Updating
 |--------------------------------------------------------------------------
 */

gulp.task('watch:sass', () => {
    return gulp.watch([
        path.src.sass + '/**/*.scss'
    ], ['build:sass', 'run:autoprefixer', 'rename']);
});
gulp.task('watch:css', () => {
    return gulp.watch([
        path.src.css + '/**/*.css'
    ], ['build:css']);
});
gulp.task('watch:js', () => {
    return gulp.watch([
        path.src.js + '/**/*.js'
    ], ['compile:js', 'concat:js']);
});
gulp.task('watch:changes', () => {
    return gulp.watch([
        path.public.css + '/main.css',
        path.public.js + '/main.js',
        'app/**/*.php',
        'resources/views/**/*.php'
    ], ['refresh']);
});


/*
 |--------------------------------------------------------------------------
 | Tasks
 |--------------------------------------------------------------------------
 */

gulp.task('default', ['build']);
gulp.task('build', ['copy:assets', 'build:js', 'build:sass', 'build:css', 'run:autoprefixer', 'rename']);
gulp.task('watch', ['connect', 'watch:js', 'watch:sass', 'watch:css', 'watch:changes']);
