# 新しいプロジェクトを作成するスクリプト
param(
    [Parameter(Mandatory=$true)]
    [string]$ProjectName
)

$sourceProject = "current-project"
$newProjectPath = "projects\$ProjectName"

Write-Host "📁 プロジェクト: $ProjectName を作成します..." -ForegroundColor Cyan

# プロジェクトディレクトリが既に存在するかチェック
if (Test-Path $newProjectPath) {
    Write-Host "❌ エラー: プロジェクト '$ProjectName' は既に存在します" -ForegroundColor Red
    exit 1
}

# プロジェクトディレクトリを作成
New-Item -ItemType Directory -Path $newProjectPath -Force | Out-Null

# ファイルをコピー（.htaccessも含む）
Write-Host "📋 ファイルをコピー中..." -ForegroundColor Yellow
xcopy "projects\$sourceProject\*" "$newProjectPath\" /E /I /Y | Out-Null

# aboutディレクトリもコピー
if (Test-Path "projects\$sourceProject\about") {
    xcopy "projects\$sourceProject\about" "$newProjectPath\about\" /E /I /Y | Out-Null
}

Write-Host "✅ プロジェクト '$ProjectName' が作成されました！" -ForegroundColor Green
Write-Host "🚀 開発サーバーを起動します..." -ForegroundColor Cyan

# 開発サーバーを起動
& ".\\.scripts\dev.ps1" $ProjectName
