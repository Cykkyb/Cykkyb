const {src, dest, watch, parallel, series} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const autoprefixer = require('gulp-autoprefixer');
const css_media = require('gulp-group-css-media-queries');
const browser_sync = require('browser-sync').create();
const uglify = require('gulp-uglify');
const del = require('del');

function styles() {
    return src('style/app/*.scss')
        .pipe(sass())
        .pipe(css_media())
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 10 version'],
            grid: true
        }))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(concat('style.min.css'))
        .pipe(dest('style/dist'))
        .pipe(browser_sync.stream())
}

function scripts() {
    return src([
        'node_modules/jquery/dist/jquery.js',
        'script/app/*.js'
    ])
        .pipe(concat('script.min.js'))
        .pipe(uglify())
        .pipe(dest('script/dist'))
        .pipe(browser_sync.stream())
}

function watching() {
    watch(['style/**/*.scss'], styles)
    watch(['script/app/*.js'], scripts)
    watch(['./**/*.php']).on('change', browser_sync.reload)

}

function clean() {
    return del('script/dist');
}

function browser_reload() {
    browser_sync.init({
        proxy: "http://127.0.0.1:82/index.php",

    });
}

exports.watching = watching;
exports.scripts = scripts;
exports.styles = styles;
exports.browser_reload = browser_reload;
exports.clean = clean;

exports.default = parallel(styles, browser_reload, scripts, watching);