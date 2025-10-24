# 開発環境セットアップガイド

## 概要
Gulp + Node.js + PHP の組み合わせで、SCSSコンパイル、自動リロード、PHPファイル処理が可能な開発環境を構築します。

## 前提条件
- Node.js (推奨: v18以上)
- PHP (推奨: v8.0以上)
- npm または yarn

## セットアップ手順

### 1. プロジェクト構造の確認
```
site_data/
├── projects/
│   └── current-project/
│       ├── assets/
│       │   ├── _scss/          # SCSSファイル
│       │   ├── css/           # コンパイル済みCSS
│       │   ├── inc/           # PHPインクルードファイル
│       │   └── js/            # JavaScriptファイル
│       ├── index.php          # メインPHPファイル
│       └── sample.html        # サンプルHTML
├── package.json               # Node.js依存関係
├── gulpfile.js               # Gulp設定
└── README.md                 # このファイル
```

### 2. 依存関係のインストール
```bash
npm install
```

### 3. 開発環境の起動
```bash
npm run dev
```

### 4. アクセス
ブラウザで `http://localhost:3000` にアクセス

## 機能

### ✅ 実装済み機能
- **SCSSコンパイル**: 自動でCSSにコンパイル
- **自動リロード**: ファイル変更時にブラウザがリロード
- **PHP処理**: Node.jsのmiddlewareでPHPファイルを処理
- **パス設定**: 相対パスでアセットを正しく読み込み

### 🔧 技術スタック
- **Gulp**: タスクランナー
- **BrowserSync**: 自動リロード
- **Sass**: SCSSコンパイル
- **Node.js**: サーバー環境
- **PHP**: 動的コンテンツ処理

## トラブルシューティング

### よくある問題と解決方法

#### 1. 「Cannot GET」エラー
- **原因**: PHPサーバーが正しく起動していない
- **解決**: プロセスを停止して再起動
```bash
# プロセス停止
Get-Process | Where-Object {$_.ProcessName -like "*node*"} | Stop-Process -Force

# 再起動
npm run dev
```

#### 2. ファイルがダウンロードされる
- **原因**: Content-Typeが正しく設定されていない
- **解決**: middlewareの設定を確認

#### 3. PHPの警告・エラー
- **原因**: PHP 8.3での非推奨警告
- **解決**: null合体演算子（`??`）を使用

#### 4. パスエラー
- **原因**: 相対パスの設定ミス
- **解決**: ファイルの配置に応じてパスを調整

## 開発ワークフロー

### 1. SCSS編集
```scss
// assets/_scss/style.scss
$primary-color: #007bff;

.button {
  background-color: $primary-color;
}
```
→ 自動でCSSにコンパイル + ブラウザリロード

### 2. PHP編集
```php
// assets/inc/head.php
$sitename = "サイト名";
```
→ ブラウザリロード

### 3. HTML編集
```html
<!-- index.php -->
<main>
  <h1>Hello World!</h1>
</main>
```
→ ブラウザリロード

## コマンド一覧

### 開発用
```bash
npm run dev      # 開発サーバー起動
npm run build    # 本番用ビルド
npm run compile  # SCSSのみコンパイル
```

### 手動操作
```bash
# プロセス確認
Get-Process | Where-Object {$_.ProcessName -like "*node*"}

# プロセス停止
Get-Process | Where-Object {$_.ProcessName -like "*node*"} | Stop-Process -Force

# ポート確認
netstat -an | findstr :3000
```

## ファイル構成

### package.json
```json
{
  "name": "site-data-dev",
  "version": "1.0.0",
  "description": "Simple development environment with Gulp and PHP support",
  "scripts": {
    "dev": "gulp dev",
    "build": "gulp build",
    "compile": "gulp compileSass"
  },
  "devDependencies": {
    "gulp": "^5.0.1",
    "gulp-sass": "^5.1.0",
    "sass": "^1.80.0",
    "gulp-autoprefixer": "^8.0.0",
    "gulp-clean-css": "^4.3.0",
    "gulp-rename": "^2.0.0",
    "gulp-sourcemaps": "^3.0.0",
    "browser-sync": "^3.0.0",
    "http-server": "^14.1.1",
    "php-server": "^1.0.0"
  }
}
```

### gulpfile.js (主要部分)
```javascript
// BrowserSync設定
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
    logLevel: 'info'
  });
}
```

## 注意事項

### PHP設定
- PHP 8.3での非推奨警告を回避するため、null合体演算子を使用
- `$_SERVER` 変数の存在チェックを実装

### パス設定
- 相対パスはファイルの配置に応じて調整
- `assets/inc/` 内のファイルは同一ディレクトリとして扱う

### 開発環境
- ポート3000でBrowserSyncが動作
- PHPファイルはmiddlewareで動的に処理
- SCSSファイルは自動でCSSにコンパイル

## サポート

問題が発生した場合は、以下を確認してください：

1. **Node.js**: バージョンが18以上か
2. **PHP**: バージョンが8.0以上か
3. **プロセス**: 正しく起動しているか
4. **ポート**: 3000番ポートが使用可能か
5. **ファイル**: 必要なファイルが存在するか

---

**作成日**: 2025年10月24日  
**バージョン**: 1.0.0  
**対応環境**: Windows 10/11, Node.js, PHP
