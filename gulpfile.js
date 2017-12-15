var gulp         = require('gulp')
var postcss      = require('gulp-postcss')
var autoprefixer = require('autoprefixer')
var cssnext      = require('cssnext')
var precss       = require('precss')
var browserSync  = require('browser-sync'),
    reload       = browserSync.reload
// Change these for your local dev enviornment.
var projectURL   = 'https://miklb.dev'
var certPath      = '/usr/local/etc/nginx/ssl/miklb.dev.cer'
var keyPath      = '/usr/local/etc/nginx/ssl/newServer.pem'

gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: projectURL,
        https: {
            key: keyPath,
            cert: certPath
        }
    })
})

gulp.task('css', function () {
    var processors = [
        autoprefixer({browsers: ['last 1 version']}),
        cssnext,
        precss
    ]
    return gulp.src('./assets/css/*.css')
        .pipe(postcss(processors))
        .pipe(gulp.dest('.'))
        .pipe(reload({stream:true}))
})

// Watch
gulp.task('watch', function() {
    // Watch .css files
    gulp.watch('*.css', ['css', browserSync.reload])

    // Watch any files in dist/, reload on change
    gulp.watch('*.php', browserSync.reload)

})

gulp.task('default', ['css', 'browser-sync', 'watch'])
