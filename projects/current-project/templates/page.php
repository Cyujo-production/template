<?php
/**
 * ページテンプレート
 * 個別ページ用のテンプレート
 */

// ページ情報の初期化
$page = initializePage($title ?? '', $description ?? '', $isHome ?? false);

// コンテンツの開始バッファリング
ob_start();
?>
<div class="l-container">
    <div class="c-page">
        <header class="c-page__header">
            <h1 class="c-page__title"><?= e($page['title']) ?></h1>
            <?php if ($page['description']): ?>
            <p class="c-page__description"><?= e($page['description']) ?></p>
            <?php endif; ?>
        </header>
        
        <div class="c-page__content">
            <?= $content ?? '' ?>
        </div>
    </div>
</div>
<?php
// コンテンツを取得
$content = ob_get_clean();

// ベーステンプレートを読み込み
include __DIR__ . '/base.php';
?>
