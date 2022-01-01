// plug-in
var gulp = require('gulp');
var minifycss = require('gulp-minify-css');
var sass = require('gulp-sass')(require('sass'));
var changed = require('gulp-changed');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');
var mozjpeg = require('imagemin-mozjpeg');

// gulpタスクの作成
// gulp.task()を使う
// 第一引数に任意のタスク名、第二引数に実行したい処理をfunction関数で渡したげる
// 関数内ではpipe()で処理を繋ぐ

// CSS圧縮
gulp.task('minify-css', function() {
    return gulp.src('src/css/')
    .pipe(minifycss())
    .pipe(gulp.dest('dist/css/'));
});

// sassをコンパイル
gulp.task('sass', function(done){
    gulp.src('./src/scss/*.scss')
    .pipe(sass())
    // .pipe(gulp.dest('dist/css/*.css'));
    // .pipe(gulp.dest('dist/css/'));
    .pipe(gulp.dest('src/css/'));
    done();
});

// 画像圧縮
// 圧縮前と圧縮後のディレクトリを定義
var paths = {
    srcDir : 'src',
    dstGlob : 'dist',
}
// jpg,png.gif画像の圧縮タスク
gulp.task('imagemin', function(done){
    // var srcGlob = paths.srcDir + '/**/*.+(jpg|jpeg|png||gif)';
    // var dstGlob = paths.dstDir;
    gulp.src( './src/*.+(jpg|jpeg|png||gif)')
        .pipe(changed('./dist/img'))
        .pipe(imagemin([
            // imagemin.gifsicle({interlaced: true}),
            // imagemin.mozjpeg({progressive: true}),
            // imagemin.optipng({optimizationLevel: 5})
            pngquant({
                quality: [.60, .70], // 画質
                speed: 1 // スピード
              }),
              mozjpeg({ quality: 65 }), // 画質
              imagemin.svgo(),
              imagemin.optipng(),
              imagemin.gifsicle({ optimizationLevel: 3 })
        ]
    ))
    .pipe(gulp.dest('./dist/img'));
    done();
});


gulp.task('watch', function(done){
    gulp.watch('./src/scss/*.scss', gulp.task('sass'));
    //watch task
    console.log('watch start');
    done();
});
