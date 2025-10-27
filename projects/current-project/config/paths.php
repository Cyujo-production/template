<?php
/**
 * パス管理システム
 * URLとファイルパスの自動計算
 */

class PathManager {
    private static $instance = null;
    private $config = [];
    private $currentUrl = '';
    private $pathDepth = 0;
    private $basePath = '';
    
    private function __construct() {
        error_log("PathManager: Starting constructor");
        $siteFile = __DIR__ . '/site.php';
        error_log("PathManager: Loading site.php from: " . $siteFile);
        
        if (!file_exists($siteFile)) {
            error_log("PathManager: ERROR - site.php not found at: " . $siteFile);
            die("Fatal error: site.php not found");
        }
        
        $this->config = require $siteFile;
        error_log("PathManager: site.php loaded successfully");
        $this->initialize();
        error_log("PathManager: Initialization completed");
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function initialize() {
        // より確実なURL取得方法
        $this->currentUrl = $_SERVER['REQUEST_URI'] ?? $_SERVER['SCRIPT_NAME'] ?? '/';
        
        // クエリパラメータを除去
        $this->currentUrl = strtok($this->currentUrl, '?');
        
        // ファイル名を除去（index.php等）
        $this->currentUrl = preg_replace('/\/[^\/]*\.php$/', '', $this->currentUrl);
        
        // URLの深さを正確に計算
        $urlParts = explode('/', trim($this->currentUrl, '/'));
        $filteredParts = array_filter($urlParts); // 空の要素を除外
        
        // ルートページ（/）の場合は深さ0
        if (empty($filteredParts)) {
            $this->pathDepth = 0;
        } else {
            $this->pathDepth = count($filteredParts);
        }
        
        // パス計算を修正：下層ページでは../を追加
        if ($this->pathDepth > 0) {
            $this->basePath = str_repeat('../', $this->pathDepth);
        } else {
            $this->basePath = '';
        }
        
        error_log("PathManager: URL = " . $this->currentUrl . ", Depth = " . $this->pathDepth . ", BasePath = " . $this->basePath);
    }
    
    /**
     * アセットパスを取得
     */
    public function asset($path = '') {
        return $this->basePath . 'assets/' . ltrim($path, '/');
    }
    
    /**
     * CSSパスを取得（キャッシュバスター付き）
     */
    public function css($filename) {
        $path = $this->asset('css/' . $filename);
        if ($this->config['environment']['cache_bust']) {
            $filePath = __DIR__ . '/../assets/css/' . $filename;
            if (file_exists($filePath)) {
                $path .= '?v=' . filemtime($filePath);
            }
        }
        return $path;
    }
    
    /**
     * JSパスを取得
     */
    public function js($filename) {
        return $this->asset('js/' . $filename);
    }
    
    /**
     * 画像パスを取得
     */
    public function image($path) {
        return $this->asset('img/' . ltrim($path, '/'));
    }
    
    /**
     * 現在のURLを取得
     */
    public function currentUrl() {
        return $this->currentUrl;
    }
    
    /**
     * 完全なURLを取得
     */
    public function fullUrl($path = '') {
        $protocol = $this->config['url']['protocol'];
        $domain = $this->config['url']['domain'];
        $base = $this->config['url']['base'];
        return $protocol . '://' . $domain . $base . ltrim($path, '/');
    }
    
    /**
     * 相対パスを取得
     */
    public function relative($path) {
        return $this->basePath . ltrim($path, '/');
    }
    
    /**
     * 設定値を取得
     */
    public function config($key = null) {
        if ($key === null) {
            return $this->config;
        }
        
        $keys = explode('.', $key);
        $value = $this->config;
        
        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return null;
            }
        }
        
        return $value;
    }
}

// グローバル関数として使用可能にする
function path() {
    return PathManager::getInstance();
}

function config($key = null) {
    error_log("config() function called with key: " . ($key ?? 'null'));
    $instance = PathManager::getInstance();
    error_log("PathManager instance obtained");
    $result = $instance->config($key);
    error_log("config() result: " . (is_array($result) ? 'array' : (is_string($result) ? $result : gettype($result))));
    return $result;
}
