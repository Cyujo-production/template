const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();

// パス設定
const paths = {
  scss: {
    src: 'projects/current-project/assets/_scss/**/*.scss',
    dest: 'projects/current-project/assets/css/'
  },
  html: {
    src: 'projects/current-project/**/*.html'
  },
  php: {
    src: 'projects/current-project/**/*.php'
  }
};

// SCSSコンパイルタスク
function compileSass() {
  return src(paths.scss.src)
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'expanded',
      includePaths: ['projects/current-project/assets/_scss']
    }).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('.'))
    .pipe(dest(paths.scss.dest))
    .pipe(browserSync.stream());
}

// CSS圧縮タスク（本番用）
function minifyCSS() {
  return src('projects/current-project/assets/css/style.css')
    .pipe(cleanCSS({
      compatibility: 'ie8'
    }))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(dest(paths.scss.dest));
}

// ブラウザシンク設定
function browserSyncTask() {
  browserSync.init({
    server: {
      baseDir: 'projects/current-project',
      index: 'index.php',
      middleware: function (req, res, next) {
        // PHPファイルの処理
        if (req.url.endsWith('.php') || req.url === '/') {
          const { spawn } = require('child_process');
          const filePath = req.url === '/' ? 'projects/current-project/index.php' : 'projects/current-project' + req.url;
          const php = spawn('php', ['-f', filePath]);
          let output = '';
          php.stdout.on('data', (data) => {
            output += data.toString();
          });
          php.on('close', (code) => {
            res.setHeader('Content-Type', 'text/html; charset=utf-8');
            res.end(output);
          });
        } else {
          next();
        }
      }
    },
    port: 3000,
    open: true,
    notify: false,
    logLevel: 'info',
    files: [
      'projects/current-project/**/*.html',
      'projects/current-project/**/*.php',
      'projects/current-project/assets/css/**/*.css'
    ]
  });
}

// ファイル監視タスク
function watchFiles() {
  watch(paths.scss.src, compileSass);
  watch(paths.html.src).on('change', browserSync.reload);
  watch(paths.php.src).on('change', browserSync.reload);
}

// 開発用タスク
const dev = series(compileSass, parallel(browserSyncTask, watchFiles));

// 本番用ビルドタスク
const build = series(compileSass, minifyCSS);

// タスクエクスポート
exports.compileSass = compileSass;
exports.minifyCSS = minifyCSS;
exports.dev = dev;
exports.build = build;
exports.default = dev;
