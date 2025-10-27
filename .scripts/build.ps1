# プロジェクトを指定してビルドするスクリプト
param(
    [Parameter(Position=0)]
    [string]$ProjectName = "current-project"
)

Write-Host "📦 プロジェクト: $ProjectName をビルドします..." -ForegroundColor Green
$env:PROJECT = $ProjectName
pnpm run build

