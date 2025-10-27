# 画像処理専用スクリプト
param(
    [Parameter(Position=0)]
    [string]$ProjectName = "current-project",
    [Parameter(Position=1)]
    [string]$Task = "optimize"
)

$env:PROJECT = $ProjectName

switch ($Task) {
    "optimize" {
        Write-Host "📸 プロジェクト: $ProjectName の画像を最適化します（圧縮 + WebP変換）..." -ForegroundColor Cyan
        pnpm run images
    }
    "compress" {
        Write-Host "🗜️ プロジェクト: $ProjectName の画像を圧縮します..." -ForegroundColor Green
        pnpm run compress
    }
    "webp" {
        Write-Host "🔄 プロジェクト: $ProjectName の画像をWebPに変換します..." -ForegroundColor Blue
        pnpm run webp
    }
    default {
        Write-Host "❌ 無効なタスクです。使用可能なタスク:" -ForegroundColor Red
        Write-Host "  optimize  - 画像の圧縮とWebP変換（デフォルト）" -ForegroundColor Yellow
        Write-Host "  compress  - 画像の圧縮のみ" -ForegroundColor Yellow
        Write-Host "  webp      - WebP変換のみ" -ForegroundColor Yellow
        Write-Host ""
        Write-Host "使用例:" -ForegroundColor Cyan
        Write-Host "  .\.scripts\images.ps1 current-project optimize" -ForegroundColor White
        Write-Host "  .\.scripts\images.ps1 test-project compress" -ForegroundColor White
        Write-Host "  .\.scripts\images.ps1 next-project webp" -ForegroundColor White
    }
}
