<?php
// URLから自動的にルートパスを計算（汎用性あり）
$url = $_SERVER['REQUEST_URI'] ?? '/';
$urlpath = explode("/", $url);

// プロトコルの自動判定（http/https）
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
$domain = $protocol . ($_SERVER['HTTP_HOST'] ?? 'localhost');
$fullurl = $domain . $url;

// パス設定（URLベースで自動計算）
// 現在のURLの深さに応じて相対パスを生成
$path_depth = count(array_filter($urlpath)) - 1; // 空の要素を除外して深さを計算
$path = str_repeat('../', max(0, $path_depth)); // 深さに応じて../を生成
$root = '/';

//サイト名の設定
$sitename = "サイト名";
?>
<!--<meta name="robots" content="noindex">--><!--クロール拒否設定テストアップ用-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title><?php echo $title; ?> - <?php echo $sitename; ?></title>
<meta name="description" content="<?php echo $description; ?>">
<meta property="og:site_name" content="<?php echo $sitename; ?>">
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:description" content="<?php echo $description; ?>">
<?php
//og-typeの設定
if ($url == "/" || $url == "/index.php") {$og_type = "website";}
elseif ($url == "/blog/") {$og_type = "blog";}
elseif ($url == "/news/") {$og_type = "blog"; }
elseif (strpos($url ?? '', "/news/") === 0 && $url !== "/news/") {$og_type = "article";}
elseif (strpos($url ?? '', "/product/") === 0) {$og_type = "product";}
elseif (strpos($url ?? '', "/article/") === 0) {$og_type = "article";}
else { $og_type = "article";}; ?>
<meta property="og:type" content="<?php echo $og_type; ?>">
<meta property="og:url" content="<?= $fullurl; ?>">
<meta property="og:image" content="<?= $fullurl; ?>assets/img/common/og-image.jpg" /><!--1200?630px。形式はJPGまたはPNG。-->
<meta name="twitter:card" content="summary_large_image">
<!--
  <PageMap>
    <DataObject type="thumbnail">
      <Attribute name="src" value="http://www.example.com/recipes/applepie/applepie.jpg"/>
      <Attribute name="width" value="696"/>
      <Attribute name="height" value="696"/>
    </DataObject>
  </PageMap>
-->
<meta name="thumbnail" content="http://example/foo.jpg" /><!--696?696px。形式はJPGまたはPNG。-->
<link rel="apple-touch-icon" sizes="180x180" href="<?= $path; ?>assets/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= $path; ?>assets/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= $path; ?>assets/img/favicon/favicon-16x16.png">
<link rel="manifest" href="<?= $path; ?>assets/img/favicon/manifest.json">
<link rel="mask-icon" href="<?= $path; ?>assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<!-- CSS読み込み -->
<link rel="stylesheet" href="<?= $path; ?>assets/css/style.css?<?= @filemtime($path . 'assets/css/style.css'); ?>">
<!--GoogleFonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
