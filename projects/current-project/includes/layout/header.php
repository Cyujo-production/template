<?php
/**
 * ヘッダーナビゲーションコンポーネント
 */

$navigation = setActiveNavigation();
?>
<header class="l-header" role="banner">
    <div class="l-container is-flex">
        <!-- ロゴ -->
        <div class="l-header__logo">
            <h1>
                <a href="<?= e(path()->relative('/')) ?>" class="l-header__logo-link" aria-label="<?= e(config('name')) ?>のホームページ">
                    <?= e(config('name')) ?>
                </a>
            </h1>
        </div>
        
        <!-- モバイルメニューボタン -->
        <button data-nav-toggle class="l-header__toggle" aria-label="メニューを開く" aria-expanded="false" aria-controls="global-nav">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </button>
        
        <!-- ナビゲーション -->
        <nav id="global-nav" data-global-nav class="l-nav" role="navigation" aria-label="メインナビゲーション">
            <div class="l-nav__logo">
                <p><?= e(config('name')) ?></p>
            </div>
            
            <ul class="l-nav__list" role="menubar">
                <?php foreach ($navigation as $item): ?>
                <li class="l-nav__item" role="none">
                    <a href="<?= e(path()->relative($item['url'])) ?>" 
                       class="l-nav__link <?= conditional_class($item['active'], 'is-active') ?>"
                       role="menuitem"
                       <?= $item['active'] ? 'aria-current="page"' : '' ?>>
                        <?= e($item['label']) ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            
            <!-- 連絡先情報 -->
            <address class="l-nav__contact">
                <p class="l-nav__contact-label">●お電話でお問い合わせの方はコチラ</p>
                <a href="tel:<?= e(config('contact.tel')) ?>" class="l-nav__contact-link">
                    <span class="l-nav__contact-tel"><?= e(config('contact.tel_display')) ?></span>
                    <small class="l-nav__contact-hours">受付時間／<?= e(config('contact.hours')) ?>（定休日／<?= e(config('contact.holidays')) ?>）</small>
                </a>
            </address>
            
            <!-- CTAボタン -->
            <a href="#contact" class="l-header__btn c-btn c-btn--primary">
                お問い合わせ
            </a>
        </nav>
    </div>
</header>
