# モダンWeb開発テンプレート

## 概要
Gulp + Node.js + PHP の組み合わせで、SCSSコンパイル、自動リロード、PHPファイル処理、静的HTML生成が可能な多機能開発環境を構築します。

## 特徴

### 🚀 **多プロジェクト対応**
- **current-project**: PHPベースの動的サイト
- **html-project**: 静的HTMLサイト（SSI対応）

### 🎨 **コンポーネントシステム**
- BEM記法による統一されたCSS設計
- 再利用可能なUIコンポーネント
- レスポンシブデザイン対応

### ⚡ **開発効率化**
- ホットリロード機能
- SCSS自動コンパイル
- 画像最適化
- HTMLテンプレート処理

## 前提条件
- Node.js (推奨: v18以上)
- PHP (推奨: v8.0以上)
- npm または pnpm

## セットアップ手順

### 1. 依存関係のインストール
```bash
npm install
# または
pnpm install
```

### 2. 開発環境の起動
```bash
# PHPプロジェクト（current-project）
npm run dev

# 静的HTMLプロジェクト（html-project）
npm run dev -- --project=html-project
```

### 3. アクセス
- **PHPプロジェクト**: `http://localhost:3000`
- **HTMLプロジェクト**: `http://localhost:3000` (SSI対応)

## プロジェクト構造

```
site_data/
├── projects/
│   ├── current-project/          # PHP動的サイト
│   │   ├── assets/
│   │   │   ├── _scss/            # SCSSソースファイル
│   │   │   │   ├── component/    # UIコンポーネント
│   │   │   │   ├── layout/       # レイアウト
│   │   │   │   ├── project/      # ページ固有スタイル
│   │   │   │   └── setting/      # 設定ファイル
│   │   │   ├── css/              # コンパイル済みCSS
│   │   │   ├── js/               # JavaScriptファイル
│   │   │   └── img/              # 画像ファイル
│   │   ├── includes/             # PHP共通パーツ
│   │   ├── templates/             # PHPテンプレート
│   │   ├── pages/                 # ページファイル
│   │   └── components/            # コンポーネント例
│   └── html-project/              # 静的HTMLサイト
│       ├── includes/              # SSI共通パーツ
│       ├── templates/              # HTMLテンプレート
│       ├── scripts/               # ビルドスクリプト
│       └── .htaccess              # SSI設定
├── .scripts/                      # PowerShellスクリプト
├── gulpfile.js                    # Gulp設定
├── package.json                   # 依存関係
└── README.md                      # このファイル
```

## 機能詳細

### ✅ **実装済み機能**

#### **SCSSコンパイル**
- 自動コンパイルとソースマップ生成
- Autoprefixer対応
- CSS最適化（minify）

#### **コンポーネントシステム**
- **ボタン**: プライマリ、セカンダリ、アウトライン、ゴースト
- **カード**: Grid、Flexレイアウト対応
- **リスト**: 番号付き、チェック、矢印、カード形式
- **タブパネル**: アクセシブルなタブ切り替え
- **アコーディオン**: スムーズな開閉アニメーション
- **フォーム**: 入力フィールド、ラベル、バリデーション

#### **レイアウトシステム**
- **ヘッダー**: レスポンシブナビゲーション
- **フッター**: サイト情報とリンク
- **コンテナ**: 最大幅制御とセンタリング
- **メイン**: メインコンテンツエリア

#### **アクセシビリティ**
- ARIA属性対応
- キーボードナビゲーション
- セマンティックHTML
- スキップリンク

#### **静的HTML生成**
- SSI（Server Side Includes）対応
- テンプレート変数処理
- 相対パス自動計算
- 完全な静的HTML出力

### 🔧 **技術スタック**
- **Gulp**: タスクランナー
- **BrowserSync**: 自動リロード
- **Sass**: SCSSコンパイル
- **Node.js**: サーバー環境
- **PHP**: 動的コンテンツ処理
- **SSI**: 静的サイト共通パーツ

## コマンド一覧

### **開発用**
```bash
npm run dev                    # 開発サーバー起動（current-project）
npm run dev -- --project=html-project  # HTMLプロジェクト起動
npm run build                  # 本番用ビルド
npm run compile                # SCSSのみコンパイル
```

### **プロジェクト管理**
```bash
# PowerShellスクリプト（Windows）
.\.scripts\new-project.ps1     # 新プロジェクト作成
.\.scripts\dev.ps1             # 開発サーバー起動
.\.scripts\build.ps1           # ビルド実行
.\.scripts\images.ps1           # 画像最適化
```

### **手動操作**
```bash
# プロセス確認
Get-Process | Where-Object {$_.ProcessName -like "*node*"}

# プロセス停止
Get-Process | Where-Object {$_.ProcessName -like "*node*"} | Stop-Process -Force

# ポート確認
netstat -an | findstr :3000
```

## 開発ワークフロー

### **1. SCSS編集**
```scss
// assets/_scss/component/_c-btn.scss
.c-btn {
  &--primary {
    background-color: var(--color-primary);
    color: var(--color-white);
  }
}
```
→ 自動でCSSにコンパイル + ブラウザリロード

### **2. PHP編集**
```php
// includes/layout/header.php
<header role="banner" class="l-header">
  <nav id="global-nav" class="l-nav">
    <!-- ナビゲーション -->
  </nav>
</header>
```
→ ブラウザリロード

### **3. HTML編集**
```html
<!-- templates/base.html -->
<main id="main-content" class="l-main" role="main">
  {{content}}
</main>
```
→ ブラウザリロード

### **4. 静的HTML生成**
```bash
# HTMLプロジェクト用
node projects/html-project/scripts/build-html.js html-project
```

## コンポーネント使用例

### **ボタン**
```html
<!-- プライマリボタン -->
<a href="#" class="c-btn c-btn--primary">プライマリボタン</a>

<!-- セカンダリボタン -->
<button class="c-btn c-btn--secondary">セカンダリボタン</button>

<!-- アウラインボタン -->
<a href="#" class="c-btn c-btn--outline">アウラインボタン</a>
```

### **カード**
```html
<!-- Gridレイアウト -->
<div class="c-card c-card--grid-3">
  <div class="c-card__item">
    <h3 class="c-card__title">カードタイトル</h3>
    <p class="c-card__content">カードの内容</p>
  </div>
</div>

<!-- Flexレイアウト -->
<div class="c-card c-card--flex">
  <div class="c-card__item">項目1</div>
  <div class="c-card__item">項目2</div>
</div>
```

### **リスト**
```html
<!-- チェックリスト -->
<ul class="c-list c-list--check">
  <li>チェック項目1</li>
  <li>チェック項目2</li>
</ul>

<!-- 番号付きリスト -->
<ol class="c-list c-list--numbered">
  <li>番号付き項目1</li>
  <li>番号付き項目2</li>
</ol>
```

## トラブルシューティング

### **よくある問題と解決方法**

#### **1. 「Cannot GET」エラー**
- **原因**: PHPサーバーが正しく起動していない
- **解決**: プロセスを停止して再起動
```bash
Get-Process | Where-Object {$_.ProcessName -like "*node*"} | Stop-Process -Force
npm run dev
```

#### **2. SCSSコンパイルエラー**
- **原因**: 構文エラーまたはインポートパス問題
- **解決**: エラーメッセージを確認し、ファイルパスと構文を修正

#### **3. パスエラー**
- **原因**: 相対パスの設定ミス
- **解決**: ファイルの配置に応じてパスを調整

#### **4. SSIが動作しない**
- **原因**: Apache設定または.htaccess問題
- **解決**: `.htaccess`ファイルの確認とApache設定

## ファイル構成

### **package.json**
```json
{
  "name": "site-data-dev",
  "version": "1.0.0",
  "description": "Modern web development template with Gulp, PHP, and static HTML support",
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
    "gulp-replace": "^1.1.4"
  }
}
```

## 注意事項

### **PHP設定**
- PHP 8.3での非推奨警告を回避するため、null合体演算子を使用
- `$_SERVER` 変数の存在チェックを実装

### **パス設定**
- 相対パスはファイルの配置に応じて調整
- 静的HTML生成時は自動でパス計算

### **開発環境**
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

**作成日**: 2025年1月27日  
**バージョン**: 2.0.0  
**対応環境**: Windows 10/11, Node.js, PHP  
**ライセンス**: MIT