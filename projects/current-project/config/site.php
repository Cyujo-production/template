<?php
/**
 * サイト設定ファイル
 * サイト全体の設定を一元管理
 */

return [
    // 基本情報
    'name' => 'サイト名',
    'description' => 'サイトの説明文',
    'keywords' => 'キーワード1,キーワード2,キーワード3',
    'author' => 'サイト運営者',
    'copyright' => date('Y'),
    
    // URL設定
    'url' => [
        'protocol' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? 'https' : 'http',
        'domain' => $_SERVER['HTTP_HOST'] ?? 'localhost',
        'base' => '/',
    ],
    
    // メタタグ設定
    'meta' => [
        'og_image' => '/assets/img/common/og-image.jpg',
        'og_image_width' => 1200,
        'og_image_height' => 630,
        'twitter_card' => 'summary_large_image',
        'theme_color' => '#ffffff',
    ],
    
    // ファビコン設定
    'favicon' => [
        'apple_touch_icon' => '/assets/img/favicon/apple-touch-icon.png',
        'icon_32' => '/assets/img/favicon/favicon-32x32.png',
        'icon_16' => '/assets/img/favicon/favicon-16x16.png',
        'manifest' => '/assets/img/favicon/manifest.json',
        'mask_icon' => '/assets/img/favicon/safari-pinned-tab.svg',
        'mask_color' => '#5bbad5',
        'ms_tile_color' => '#da532c',
    ],
    
    // 外部リソース
    'external' => [
        'google_fonts' => [
            'families' => ['Noto+Sans+JP'],
            'display' => 'swap',
        ],
        'analytics' => [
            'ga4_id' => '', // Google Analytics 4 ID
        ],
    ],
    
    // ナビゲーション設定
    'navigation' => [
        'main' => [
            ['label' => 'HOME', 'url' => '/', 'active' => false],
            ['label' => 'ABOUT', 'url' => '/about/', 'active' => false],
            ['label' => 'COMPONENTS', 'url' => '/components/', 'active' => false],
            ['label' => 'EVENT', 'url' => '/event/', 'active' => false],
        ],
    ],
    
    // 連絡先情報
    'contact' => [
        'tel' => '0120-5292-39',
        'tel_display' => '0120-5292-39',
        'hours' => '10：00～17：00',
        'holidays' => '土・日・祝日',
    ],
    
    // 開発環境設定
    'environment' => [
        'debug' => true,
        'cache_bust' => true,
    ],
];
