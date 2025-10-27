<?php
/**
 * HTMLヘッダーコンポーネント
 * メタタグ、CSS、外部リソースの読み込み
 */

// ページ情報とメタタグを取得
$meta = generateMetaTags();
$navigation = setActiveNavigation();
?>
<!DOCTYPE html>
<html class="no-js" lang="ja">
<head prefix="og: https://ogp.me/ns#">
    <!-- 基本メタタグ -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    
    <!-- SEOメタタグ -->
    <title><?= e($page['title']) ?> - <?= e(config('name')) ?></title>
    <meta name="description" content="<?= e($page['description']) ?>">
    <meta name="keywords" content="<?= e($page['keywords']) ?>">
    <meta name="author" content="<?= e(config('author')) ?>">
    
    <!-- Open Graph -->
    <meta property="og:type" content="<?= e($meta['og_type']) ?>">
    <meta property="og:title" content="<?= e($page['title']) ?>">
    <meta property="og:description" content="<?= e($page['description']) ?>">
    <meta property="og:url" content="<?= e($page['full_url']) ?>">
    <meta property="og:site_name" content="<?= e(config('name')) ?>">
    <meta property="og:image" content="<?= e($meta['og_image']) ?>">
    <meta property="og:image:width" content="<?= e($meta['og_image_width']) ?>">
    <meta property="og:image:height" content="<?= e($meta['og_image_height']) ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="<?= e(config('meta.twitter_card')) ?>">
    <meta name="twitter:title" content="<?= e($page['title']) ?>">
    <meta name="twitter:description" content="<?= e($page['description']) ?>">
    <meta name="twitter:image" content="<?= e($meta['og_image']) ?>">
    
    <!-- ファビコン -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= e(path()->relative(config('favicon.apple_touch_icon'))) ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= e(path()->relative(config('favicon.icon_32'))) ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= e(path()->relative(config('favicon.icon_16'))) ?>">
    <link rel="manifest" href="<?= e(path()->relative(config('favicon.manifest'))) ?>">
    <link rel="mask-icon" href="<?= e(path()->relative(config('favicon.mask_icon'))) ?>" color="<?= e(config('favicon.mask_color')) ?>">
    <meta name="msapplication-TileColor" content="<?= e(config('favicon.ms_tile_color')) ?>">
    <meta name="theme-color" content="<?= e(config('meta.theme_color')) ?>">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?= e(path()->relative('assets/css/style.css')) ?>?<?= @filemtime(__DIR__ . '/../../assets/css/style.css') ?>">
    
    <!-- 代替案：元のシステムのパス計算 -->
    <?php
    // 元のシステムのパス計算
    $url = $_SERVER['REQUEST_URI'] ?? '/';
    $urlpath = explode("/", $url);
    $path_depth = count(array_filter($urlpath)) - 1;
    $path = str_repeat('../', max(0, $path_depth));
    ?>
    <!-- DEBUG: Original Path = <?= e($path) ?> -->
    <!-- DEBUG: Original CSS = <?= e($path . 'assets/css/style.css') ?> -->
    
    <!-- Google Fonts -->
    <?php if (config('external.google_fonts')): ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=<?= implode('&family=', config('external.google_fonts.families')) ?>&display=<?= e(config('external.google_fonts.display')) ?>" rel="stylesheet">
    <?php endif; ?>
    
    <!-- Google Analytics -->
    <?php if (config('external.analytics.ga4_id')): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e(config('external.analytics.ga4_id')) ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?= e(config('external.analytics.ga4_id')) ?>');
    </script>
    <?php endif; ?>
    
    <!-- 構造化データ -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "<?= e(config('name')) ?>",
        "url": "<?= e(path()->fullUrl()) ?>",
        "description": "<?= e(config('description')) ?>"
    }
    </script>
</head>
<body class="<?= css_class('page', [$page['is_home'] ? 'home' : 'sub']) ?>">
