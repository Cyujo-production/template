<?php
/**
 * トップページ
 */

// アプリケーション初期化
require_once __DIR__ . '/../includes/core/init.php';

// ページ情報の設定
$title = 'ホーム';
$description = 'サイトのトップページです。';
$isHome = true;

// ページコンテンツ
ob_start();
?>
<div class="p-top">
    <section class="p-top__hero">
        <div class="l-container">
            <h1 class="p-top__hero-title"><?= e(config('name')) ?></h1>
            <p class="p-top__hero-description"><?= e(config('description')) ?></p>
            <div class="p-top__hero-actions">
                <a href="<?= e(path()->relative('/about/')) ?>" class="c-btn c-btn--primary">
                    Aboutを見る
                </a>
                <a href="#contact" class="c-btn c-btn--secondary">
                    お問い合わせ
                </a>
            </div>
        </div>
    </section>
    
    <section class="p-top__features">
        <div class="l-container">
            <h2 class="p-top__features-title">特徴</h2>
            <div class="p-top__features-grid">
                <div class="c-card">
                    <h3 class="c-card__title">特徴1</h3>
                    <p class="c-card__content">説明文が入ります。</p>
                </div>
                <div class="c-card">
                    <h3 class="c-card__title">特徴2</h3>
                    <p class="c-card__content">説明文が入ります。</p>
                </div>
                <div class="c-card">
                    <h3 class="c-card__title">特徴3</h3>
                    <p class="c-card__content">説明文が入ります。</p>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
$content = ob_get_clean();

// ベーステンプレートを読み込み
include __DIR__ . '/templates/base.php';
?>
