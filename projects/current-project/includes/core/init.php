<?php
/**
 * アプリケーション初期化
 * 必要な設定とライブラリを読み込み
 */

// デバッグ情報
error_log("Init: Starting initialization");

// パス管理システムを読み込み（config()関数の定義を含む）
$pathsFile = __DIR__ . '/../../config/paths.php';
error_log("Init: Loading paths.php from: " . $pathsFile);

if (!file_exists($pathsFile)) {
    error_log("Init: ERROR - paths.php not found at: " . $pathsFile);
    die("Fatal error: paths.php not found");
}

require_once $pathsFile;
error_log("Init: paths.php loaded successfully");

// config()関数の存在確認
if (!function_exists('config')) {
    error_log("Init: ERROR - config() function not found after loading paths.php");
    die("Fatal error: config() function not found");
}
error_log("Init: config() function exists");

// エラーレポート設定
if (config('environment.debug')) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    error_log("Init: Debug mode enabled");
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    error_log("Init: Debug mode disabled");
}

// 共通関数を読み込み
require_once __DIR__ . '/functions.php';

// ヘルパー関数を読み込み
require_once __DIR__ . '/helpers.php';

/**
 * ページ情報の初期化
 */
function initializePage($title = '', $description = '', $isHome = false) {
    global $page;
    
    $page = [
        'title' => $title ?: config('name'),
        'description' => $description ?: config('description'),
        'keywords' => config('keywords'),
        'is_home' => $isHome,
        'url' => path()->currentUrl(),
        'full_url' => path()->fullUrl(path()->currentUrl()),
    ];
    
    return $page;
}

/**
 * メタタグの生成
 */
function generateMetaTags() {
    global $page;
    
    $ogType = 'website';
    $currentUrl = path()->currentUrl();
    
    // OGタイプの自動判定
    if ($page['is_home']) {
        $ogType = 'website';
    } elseif (strpos($currentUrl, '/blog/') === 0 || strpos($currentUrl, '/news/') === 0) {
        $ogType = 'blog';
    } elseif (strpos($currentUrl, '/product/') === 0) {
        $ogType = 'product';
    } elseif (strpos($currentUrl, '/article/') === 0 || strpos($currentUrl, '/news/') === 0) {
        $ogType = 'article';
    } else {
        $ogType = 'article';
    }
    
    return [
        'og_type' => $ogType,
        'og_image' => path()->fullUrl(config('meta.og_image')),
        'og_image_width' => config('meta.og_image_width'),
        'og_image_height' => config('meta.og_image_height'),
    ];
}

/**
 * ナビゲーションのアクティブ状態を設定
 */
function setActiveNavigation() {
    $navigation = config('navigation.main');
    $currentUrl = path()->currentUrl();
    
    foreach ($navigation as &$item) {
        $item['active'] = ($item['url'] === $currentUrl || 
                          ($item['url'] !== '/' && strpos($currentUrl, $item['url']) === 0));
    }
    
    return $navigation;
}
