# プロジェクトを指定して開発サーバーを起動するスクリプト
param(
    [Parameter(Position=0)]
    [string]$ProjectName = "current-project"
)

Write-Host "🚀 プロジェクト: $ProjectName で開発サーバーを起動します..." -ForegroundColor Cyan
Write-Host "📸 画像の自動圧縮とWebP変換が有効です" -ForegroundColor Yellow
$env:PROJECT = $ProjectName
pnpm run dev

