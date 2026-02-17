const gulp = require('gulp');
const terser = require('gulp-terser');
const rename = require('gulp-rename');


// Define paths for admin and public JavaScript files
const paths = {
    adminJS: {
        src: 'plugin-name/admin/js/temp/*.js',
        dest: 'plugin-name/admin/js/dist/'
    },
    publicJS: {
        src: 'plugin-name/public/js/temp/*.js',
        dest: 'plugin-name/public/js/dist/'
    }
};

// Task to minify admin JavaScript files
function minifyAdminJS() {
    return gulp.src(paths.adminJS.src)
        .pipe(terser())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(paths.adminJS.dest));
}

// Task to minify public JavaScript files
function minifyPublicJS() {
    return gulp.src(paths.publicJS.src)
        .pipe(terser())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(paths.publicJS.dest));
}

// Watch task to monitor changes in JavaScript files
function watchFiles() {
    gulp.watch(paths.adminJS.src, minifyAdminJS);
    gulp.watch(paths.publicJS.src, minifyPublicJS);
}


// Define complex tasks
const build = gulp.series(gulp.parallel(minifyAdminJS, minifyPublicJS));
const watch = gulp.series(build, watchFiles);

// Export tasks to CLI
exports.admin = minifyAdminJS;
exports.public = minifyPublicJS;
exports.build = build;
exports.watch = watch;
exports.default = build;