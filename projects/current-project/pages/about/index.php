<?php
/**
 * Aboutページ
 */

// アプリケーション初期化
require_once __DIR__ . '/../../includes/core/init.php';

// ページ情報の設定
$title = 'About';
$description = 'Aboutページの説明文です。';
$isHome = false;

// ページコンテンツ
ob_start();
?>
<div class="p-about">
    <div class="l-container">
        <div class="c-page">
            <header class="c-page__header">
                <h1 class="c-page__title">About</h1>
                <p class="c-page__description">私たちについて</p>
            </header>
            
            <div class="c-page__content">
                <section class="p-about__intro">
                    <h2>会社概要</h2>
                    <p>会社の説明文が入ります。私たちはお客様に最高のサービスを提供することを使命としています。</p>
                </section>
                
                <section class="p-about__team">
                    <h2>チーム</h2>
                    <div class="p-about__team-grid">
                        <div class="c-card">
                            <h3 class="c-card__title">代表取締役</h3>
                            <p class="c-card__content">代表の紹介文が入ります。</p>
                        </div>
                        <div class="c-card">
                            <h3 class="c-card__title">開発チーム</h3>
                            <p class="c-card__content">開発チームの紹介文が入ります。</p>
                        </div>
                    </div>
                </section>
                
                <div class="p-about__actions">
                    <a href="<?= e(path()->relative('/')) ?>" class="c-btn c-btn--primary">
                        トップページに戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();

// ベーステンプレートを読み込み
include __DIR__ . '/templates/base.php';
?>
