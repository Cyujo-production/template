import { src, dest, watch, series, parallel } from 'gulp';
import * as sass from 'sass';
import gulpSass from 'gulp-sass';
import autoprefixer from 'gulp-autoprefixer';
import cleanCSS from 'gulp-clean-css';
import rename from 'gulp-rename';
import sourcemaps from 'gulp-sourcemaps';
import browserSync from 'browser-sync';
import imagemin from 'gulp-imagemin';
import imageminWebp from 'imagemin-webp';
import imageminMozjpeg from 'imagemin-mozjpeg';
import imageminPngquant from 'imagemin-pngquant';
import imageminSvgo from 'imagemin-svgo';
import { spawn } from 'child_process';
import fs from 'fs';

// Sass設定（将来対応の準備）
const sassCompiler = gulpSass(sass);
const bs = browserSync.create();

// プロジェクト名を環境変数またはコマンドライン引数から取得
const projectName = process.env.PROJECT || process.argv.find(arg => arg.startsWith('--project='))?.split('=')[1] || 'current-project';

// パス設定（動的）
const paths = {
  scss: {
    src: `projects/${projectName}/assets/_scss/**/*.scss`,
    dest: `projects/${projectName}/assets/css/`
  },
  html: {
    src: `projects/${projectName}/**/*.html`
  },
  php: {
    src: `projects/${projectName}/**/*.php`
  },
  images: {
    src: `projects/${projectName}/assets/img/**/*.{jpg,jpeg,png,gif,svg}`,
    dest: `projects/${projectName}/assets/img/`
  }
};

console.log(`🚀 プロジェクト: ${projectName} でGulpを起動します`);


// SCSSコンパイルタスク
function compileSass() {
  return src(paths.scss.src)
    .pipe(sourcemaps.init())
    .pipe(sassCompiler({
      outputStyle: 'expanded',
      includePaths: ['projects/current-project/assets/_scss']
    }).on('error', sassCompiler.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('.'))
    .pipe(dest(paths.scss.dest))
    .pipe(bs.stream());
}

// CSS圧縮タスク（本番用）
function minifyCSS() {
  return src(`projects/${projectName}/assets/css/style.css`)
    .pipe(cleanCSS({
      compatibility: 'ie8'
    }))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(dest(paths.scss.dest));
}

// 画像圧縮タスク
function compressImages() {
  return src(paths.images.src)
    .pipe(imagemin([
      imageminMozjpeg({ quality: 80 }),
      imageminPngquant({ quality: [0.6, 0.8] }),
      imageminSvgo({
        plugins: [
          { name: 'removeViewBox', active: false },
          { name: 'removeEmptyAttrs', active: false }
        ]
      })
    ]))
    .pipe(dest(paths.images.dest))
    .pipe(bs.stream());
}

// WebP変換タスク
function convertToWebp() {
  return src(paths.images.src)
    .pipe(imagemin([
      imageminWebp({ quality: 80 })
    ]))
    .pipe(rename({ extname: '.webp' }))
    .pipe(dest(paths.images.dest))
    .pipe(bs.stream());
}

// 画像最適化タスク（圧縮 + WebP変換）
function optimizeImages() {
  return parallel(compressImages, convertToWebp)();
}

// ブラウザシンク設定
function browserSyncTask() {
  bs.init({
    server: {
      baseDir: `projects/${projectName}`,
      index: 'index.php',
      middleware: function (req, res, next) {
        // URLの正規化
        let url = req.url;
        
        // 末尾のスラッシュを削除（ルート以外）
        if (url !== '/' && url.endsWith('/')) {
          url = url.slice(0, -1);
        }
        
        // PHPファイルの処理
        if (url.endsWith('.php') || url === '/' || (!url.includes('.') && url !== '/favicon.ico')) {
          let filePath;
          
          if (url === '/') {
            filePath = `projects/${projectName}/index.php`;
          } else if (url.endsWith('.php')) {
            filePath = `projects/${projectName}` + url;
          } else {
            // ディレクトリ構造をチェック
            const dirPath = `projects/${projectName}` + url;
            const indexPhpPath = dirPath + '/index.php';
            const directPhpPath = `projects/${projectName}` + url + '.php';
            
            if (fs.existsSync(indexPhpPath)) {
              // ディレクトリ内のindex.php
              filePath = indexPhpPath;
            } else if (fs.existsSync(directPhpPath)) {
              // 直接の.phpファイル
              filePath = directPhpPath;
            } else {
              // ファイルが存在しない場合は404
              res.statusCode = 404;
              res.setHeader('Content-Type', 'text/html; charset=utf-8');
              res.end('<h1>404 - Page Not Found</h1>');
              return;
            }
          }
          
          // ファイルの存在確認
          if (fs.existsSync(filePath)) {
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
            // ファイルが存在しない場合は404
            res.statusCode = 404;
            res.setHeader('Content-Type', 'text/html; charset=utf-8');
            res.end('<h1>404 - Page Not Found</h1>');
          }
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
      `projects/${projectName}/**/*.html`,
      `projects/${projectName}/**/*.php`,
      `projects/${projectName}/**/.htaccess`,
      `projects/${projectName}/assets/css/**/*.css`
    ]
  });
}

// ファイル監視タスク
function watchFiles() {
  // SCSS監視
  watch(paths.scss.src, compileSass);
  
  // HTML/PHP監視
  watch(paths.html.src).on('change', bs.reload);
  watch(paths.php.src).on('change', bs.reload);
  
  // JavaScript監視
  watch(`projects/${projectName}/assets/js/**/*.js`, (cb) => {
    bs.reload();
    cb();
  });
  
  // 画像監視
  watch(paths.images.src, optimizeImages);
}

// 開発用タスク
const dev = series(compileSass, parallel(browserSyncTask, watchFiles));

// 本番用ビルドタスク
const build = series(compileSass, minifyCSS, optimizeImages);

// タスクエクスポート
export { compileSass, minifyCSS, compressImages, convertToWebp, optimizeImages, dev, build };
export default dev;
