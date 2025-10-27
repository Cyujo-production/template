<?php
/**
 * 共通関数集
 * サイト全体で使用する汎用関数
 */

/**
 * HTMLエスケープ
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * 配列から安全に値を取得
 */
function array_get($array, $key, $default = null) {
    $keys = explode('.', $key);
    $value = $array;
    
    foreach ($keys as $k) {
        if (is_array($value) && isset($value[$k])) {
            $value = $value[$k];
        } else {
            return $default;
        }
    }
    
    return $value;
}

/**
 * ファイルの存在確認とパス生成
 */
function asset_exists($path) {
    $fullPath = __DIR__ . '/../../assets/' . ltrim($path, '/');
    return file_exists($fullPath);
}

/**
 * 画像の最適化されたパスを生成
 */
function optimized_image($path, $webp = false) {
    if ($webp) {
        $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $path);
        if (asset_exists('img/' . $webpPath)) {
            return path()->image($webpPath);
        }
    }
    return path()->image($path);
}

/**
 * 日付のフォーマット
 */
function format_date($date, $format = 'Y年m月d日') {
    if (is_string($date)) {
        $date = strtotime($date);
    }
    return date($format, $date);
}

/**
 * 文字列の切り詰め
 */
function truncate($string, $length = 100, $suffix = '...') {
    if (mb_strlen($string) <= $length) {
        return $string;
    }
    return mb_substr($string, 0, $length) . $suffix;
}

/**
 * クラス名の生成
 */
function css_class($base, $modifiers = []) {
    $classes = [$base];
    
    foreach ($modifiers as $modifier) {
        if ($modifier) {
            $classes[] = $base . '--' . $modifier;
        }
    }
    
    return implode(' ', $classes);
}

/**
 * 条件付きクラス名
 */
function conditional_class($condition, $trueClass, $falseClass = '') {
    return $condition ? $trueClass : $falseClass;
}

/**
 * デバッグ用の出力
 */
function debug($data, $die = false) {
    if (!config('environment.debug')) {
        return;
    }
    
    echo '<pre style="background: #f0f0f0; padding: 10px; margin: 10px; border: 1px solid #ccc;">';
    print_r($data);
    echo '</pre>';
    
    if ($die) {
        die();
    }
}
