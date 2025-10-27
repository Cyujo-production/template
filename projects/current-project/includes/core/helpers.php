<?php
/**
 * ヘルパー関数集
 * UIコンポーネント用の便利な関数
 */

/**
 * パンくずリストの生成
 */
function breadcrumb($items = []) {
    if (empty($items)) {
        // 自動生成
        $currentUrl = path()->currentUrl();
        $urlParts = explode('/', trim($currentUrl, '/'));
        $items = [];
        
        // projectsディレクトリを除外
        $urlParts = array_filter($urlParts, function($part) {
            return $part !== 'projects';
        });
        
        $currentPath = '';
        foreach ($urlParts as $part) {
            $currentPath .= '/' . $part;
            
            // ラベルの適切な表示名を設定
            $label = $part;
            if ($part === 'current-project' || $part === 'next-project' || $part === 'test-project') {
                $label = 'ホーム';
            } elseif ($part === 'about') {
                $label = 'About';
            } elseif ($part === 'contact') {
                $label = 'お問い合わせ';
            } elseif ($part === 'news') {
                $label = 'ニュース';
            } elseif ($part === 'blog') {
                $label = 'ブログ';
            } else {
                $label = ucfirst($part);
            }
            
            $items[] = [
                'label' => $label,
                'url' => $currentPath,
                'active' => $currentPath === $currentUrl
            ];
        }
    }
    
    $html = '<nav class="c-breadcrumb" aria-label="パンくずリスト">';
    $html .= '<ol class="c-breadcrumb__list">';
    
    foreach ($items as $index => $item) {
        $html .= '<li class="c-breadcrumb__item">';
        
        if ($item['active']) {
            $html .= '<span class="c-breadcrumb__current" aria-current="page">' . e($item['label']) . '</span>';
        } else {
            $html .= '<a href="' . e($item['url']) . '" class="c-breadcrumb__link">' . e($item['label']) . '</a>';
        }
        
        $html .= '</li>';
        
        if ($index < count($items) - 1) {
            $html .= '<li class="c-breadcrumb__separator" aria-hidden="true">></li>';
        }
    }
    
    $html .= '</ol>';
    $html .= '</nav>';
    
    return $html;
}

/**
 * ページネーションの生成
 */
function pagination($current, $total, $baseUrl = '', $perPage = 10) {
    if ($total <= $perPage) {
        return '';
    }
    
    $totalPages = ceil($total / $perPage);
    $html = '<nav class="c-pagination" aria-label="ページネーション">';
    $html .= '<ul class="c-pagination__list">';
    
    // 前のページ
    if ($current > 1) {
        $prevUrl = $baseUrl . ($current - 1 > 1 ? '?page=' . ($current - 1) : '');
        $html .= '<li class="c-pagination__item">';
        $html .= '<a href="' . e($prevUrl) . '" class="c-pagination__link c-pagination__link--prev" aria-label="前のページ">';
        $html .= '<span aria-hidden="true">‹</span>';
        $html .= '</a></li>';
    }
    
    // ページ番号
    $start = max(1, $current - 2);
    $end = min($totalPages, $current + 2);
    
    for ($i = $start; $i <= $end; $i++) {
        $html .= '<li class="c-pagination__item">';
        
        if ($i === $current) {
            $html .= '<span class="c-pagination__current" aria-current="page">' . $i . '</span>';
        } else {
            $url = $baseUrl . ($i > 1 ? '?page=' . $i : '');
            $html .= '<a href="' . e($url) . '" class="c-pagination__link">' . $i . '</a>';
        }
        
        $html .= '</li>';
    }
    
    // 次のページ
    if ($current < $totalPages) {
        $nextUrl = $baseUrl . '?page=' . ($current + 1);
        $html .= '<li class="c-pagination__item">';
        $html .= '<a href="' . e($nextUrl) . '" class="c-pagination__link c-pagination__link--next" aria-label="次のページ">';
        $html .= '<span aria-hidden="true">›</span>';
        $html .= '</a></li>';
    }
    
    $html .= '</ul>';
    $html .= '</nav>';
    
    return $html;
}

/**
 * 画像の遅延読み込み用HTML生成
 */
function lazy_image($src, $alt = '', $class = '', $width = '', $height = '') {
    $attributes = [];
    
    if ($class) $attributes[] = 'class="' . e($class) . '"';
    if ($width) $attributes[] = 'width="' . e($width) . '"';
    if ($height) $attributes[] = 'height="' . e($height) . '"';
    if ($alt) $attributes[] = 'alt="' . e($alt) . '"';
    
    $attrString = implode(' ', $attributes);
    
    return '<img src="' . e($src) . '" ' . $attrString . ' loading="lazy">';
}

/**
 * 外部リンクの判定とアイコン付与
 */
function external_link($url, $text, $class = '') {
    $isExternal = (strpos($url, 'http') === 0 && strpos($url, $_SERVER['HTTP_HOST']) === false);
    $icon = $isExternal ? '<span class="c-icon c-icon--external" aria-hidden="true"></span>' : '';
    
    $attributes = [];
    if ($class) $attributes[] = 'class="' . e($class) . '"';
    if ($isExternal) {
        $attributes[] = 'target="_blank"';
        $attributes[] = 'rel="noopener noreferrer"';
    }
    
    $attrString = implode(' ', $attributes);
    
    return '<a href="' . e($url) . '" ' . $attrString . '>' . e($text) . $icon . '</a>';
}

/**
 * 電話番号リンクの生成
 */
function tel_link($number, $display = null, $class = '') {
    $display = $display ?: $number;
    $attributes = [];
    
    if ($class) $attributes[] = 'class="' . e($class) . '"';
    
    $attrString = implode(' ', $attributes);
    
    return '<a href="tel:' . e($number) . '" ' . $attrString . '>' . e($display) . '</a>';
}
