# pnpm + Gulp 開発環境ガイド

## 📋 概要

このプロジェクトは、pnpmワークスペースとGulpを使用したマルチプロジェクト開発環境です。
複数のプロジェクトを効率的に管理し、SCSSコンパイル、自動リロード、PHP処理を提供します。

## 🚀 クイックスタート

### 1. 環境の準備
```bash
# Node.js (v18以上) と pnpm をインストール
npm install -g pnpm

# プロジェクトの依存関係をインストール
pnpm install
```

### 2. 開発サーバーの起動
```bash
# デフォルトプロジェクト（current-project）で開発
.\.scripts\dev.ps1

# 特定のプロジェクトで開発
.\.scripts\dev.ps1 test-project
.\.scripts\dev.ps1 next-project
```

### 3. ブラウザでアクセス
http://localhost:3000 にアクセス

## 📁 プロジェクト構造

```
site_data/
├── projects/
│   ├── current-project/     # デフォルトプロジェクト
│   │   ├── index.php
│   │   ├── about/
│   │   │   └── index.php
│   │   ├── assets/
│   │   │   ├── _scss/       # SCSSファイル
│   │   │   ├── css/         # コンパイル済みCSS
│   │   │   ├── inc/         # PHPインクルードファイル
│   │   │   └── js/          # JavaScriptファイル
│   │   └── .htaccess        # URL設定
│   ├── test-project/        # テスト用プロジェクト
│   └── next-project/        # 次のプロジェクト
├── .scripts/                # PowerShellスクリプト
│   ├── dev.ps1             # 開発サーバー起動
│   ├── build.ps1           # ビルド実行
│   └── new-project.ps1     # 新プロジェクト作成
├── package.json             # 依存関係とスクリプト
├── gulpfile.js             # Gulp設定
└── README.md               # このファイル
```

## 🛠️ 使用方法

### プロジェクトの切り替え

#### 方法1: PowerShellスクリプト（推奨）
```bash
# デフォルトプロジェクト
.\.scripts\dev.ps1

# 特定のプロジェクト
.\.scripts\dev.ps1 test-project
.\.scripts\dev.ps1 my-awesome-project
```

#### 方法2: 環境変数
```bash
# PowerShell
$env:PROJECT="test-project"; pnpm run dev

# デフォルト（current-project）
pnpm run dev
```

#### 方法3: Gulpコマンド直接
```bash
gulp dev --project=test-project
gulp dev
```

### 新しいプロジェクトの作成

#### 自動作成（推奨）
```bash
# 新しいプロジェクトを作成して即座に開発開始
.\.scripts\new-project.ps1 client-a
```

#### 手動作成
```bash
# 1. プロジェクトディレクトリを作成
mkdir projects\my-new-project

# 2. ベースファイルをコピー
xcopy projects\current-project projects\my-new-project /E /I

# 3. 開発開始
.\.scripts\dev.ps1 my-new-project
```

### ページの作成

#### ディレクトリ構造でのページ作成
```bash
# aboutページを作成
mkdir projects\current-project\about
# about/index.php を作成

# contactページを作成
mkdir projects\current-project\contact
# contact/index.php を作成
```

#### URL対応
- `http://localhost:3000/` → `index.php`
- `http://localhost:3000/about` → `about/index.php`
- `http://localhost:3000/contact` → `contact/index.php`

## 🔧 コマンド一覧

### 開発用
```bash
# 開発サーバー起動
.\.scripts\dev.ps1 [プロジェクト名]

# 環境変数でプロジェクト指定
$env:PROJECT="プロジェクト名"; pnpm run dev

# Gulpコマンド直接
gulp dev --project=プロジェクト名
```

### ビルド用
```bash
# 本番用ビルド
.\.scripts\build.ps1 [プロジェクト名]

# 環境変数でプロジェクト指定
$env:PROJECT="プロジェクト名"; pnpm run build

# Gulpコマンド直接
gulp build --project=プロジェクト名
```

### その他
```bash
# SCSSのみコンパイル
pnpm run compile

# 新しいプロジェクト作成
.\.scripts\new-project.ps1 プロジェクト名
```

## ⚙️ 設定ファイル

### package.json
```json
{
  "scripts": {
    "dev": "gulp dev",
    "build": "gulp build",
    "compile": "gulp compileSass"
  }
}
```

### gulpfile.js
- **動的プロジェクト選択**: 環境変数またはコマンドライン引数でプロジェクト名を指定
- **SCSSコンパイル**: 自動でCSSにコンパイル、ソースマップ生成
- **BrowserSync**: 自動リロード、PHP処理
- **URL設定**: `index.php`をURLに含めなくてもアクセス可能

## 🎯 よくある使用パターン

### パターン1: 複数プロジェクトの並行開発
```bash
# ターミナル1: test-projectで開発
.\.scripts\dev.ps1 test-project

# ターミナル2: next-projectで開発（別のポート）
$env:PROJECT="next-project"; pnpm run dev --port 3001
```

### パターン2: クライアント別プロジェクト管理
```bash
# クライアントAのプロジェクト
.\.scripts\new-project.ps1 client-a

# クライアントBのプロジェクト
.\.scripts\new-project.ps1 client-b

# 切り替え
.\.scripts\dev.ps1 client-a
.\.scripts\dev.ps1 client-b
```

### パターン3: 段階的な開発
```bash
# 1. プロトタイプ作成
.\.scripts\new-project.ps1 prototype

# 2. 本格開発
.\.scripts\new-project.ps1 production

# 3. 切り替え
.\.scripts\dev.ps1 prototype
.\.scripts\dev.ps1 production
```

## 🔍 トラブルシューティング

### よくある問題

#### 1. 「Cannot GET」エラー
- **原因**: PHPサーバーが正しく起動していない
- **解決**: プロセスを停止して再起動
```bash
Get-Process | Where-Object {$_.ProcessName -like "*node*"} | Stop-Process -Force
.\.scripts\dev.ps1 プロジェクト名
```

#### 2. ファイルがダウンロードされる
- **原因**: Content-Typeが正しく設定されていない
- **解決**: middlewareの設定を確認

#### 3. PHPの警告・エラー
- **原因**: PHP 8.3での非推奨警告
- **解決**: null合体演算子（`??`）を使用

#### 4. プロジェクトが見つからない
- **原因**: プロジェクトディレクトリが存在しない
- **解決**: プロジェクトを作成
```bash
.\.scripts\new-project.ps1 プロジェクト名
```

### デバッグ方法

#### ログの確認
```bash
# 開発サーバーのログを確認
.\.scripts\dev.ps1 プロジェクト名
# コンソールにデバッグ情報が表示される
```

#### プロセス確認
```bash
# Node.jsプロセスを確認
Get-Process | Where-Object {$_.ProcessName -like "*node*"}

# ポート使用状況を確認
netstat -an | findstr :3000
```

## 📚 参考情報

### 技術スタック
- **pnpm**: パッケージマネージャー
- **Gulp**: タスクランナー
- **BrowserSync**: 自動リロード
- **Sass**: SCSSコンパイル
- **Node.js**: サーバー環境
- **PHP**: 動的コンテンツ処理

### ファイル監視
- SCSSファイル変更時: 自動コンパイル + ブラウザリロード
- PHPファイル変更時: ブラウザリロード
- HTMLファイル変更時: ブラウザリロード

### URL設定
- `.htaccess`ファイルでURLの正規化
- `index.php`をURLに含めなくてもアクセス可能
- ディレクトリ構造でのページ作成に対応

---

**作成日**: 2025年10月27日  
**バージョン**: 1.0.0  
**対応環境**: Windows 10/11, Node.js, PHP, pnpm
