<?php
/**
 * ベーステンプレート
 * 全ページの共通レイアウト
 */

// ページ情報の初期化（各ページで設定）
if (!isset($page)) {
    $page = initializePage();
}
?>
<!DOCTYPE html>
<html class="no-js" lang="ja">
<head prefix="og: https://ogp.me/ns#">
    <?php include __DIR__ . '/../includes/layout/head.php'; ?>
</head>
<body class="<?= css_class('page', [$page['is_home'] ? 'home' : 'sub']) ?>">
    <!-- スキップリンク -->
    <a href="#main-content" class="skip-link">メインコンテンツにスキップ</a>
    
    <div class="l-wrapper">
        <?php include __DIR__ . '/../includes/layout/header.php'; ?>
        
        <main id="main-content" class="l-main" role="main">
            <?php if (!$page['is_home']): ?>
            <!-- パンくずリスト -->
            <nav class="breadcrumb-nav" aria-label="パンくずリスト">
                <div class="l-container">
                    <?= breadcrumb() ?>
                </div>
            </nav>
            <?php endif; ?>
            
            <!-- ページコンテンツ -->
            <?= $content ?? '' ?>
        </main>
        
        <?php include __DIR__ . '/../includes/layout/footer.php'; ?>
    </div>
</body>
</html>
