<!DOCTYPE html>
<html class="no-js" lang="ja">
<head prefix="og: https://ogp.me/ns#">
<?php
// ページ情報の設定（$pathは自動計算されるので不要）
$title = 'ページタイトル';
$description = 'ディスクリプション';
$is_home = true; //トップページの判定用の変数 true false

// head.phpをインクルード
include_once('assets/inc/head.php');
?>
</head>
<body>
  <?php include_once('assets/inc/body.php'); ?>
  <div class="l-wrapper">
    <?php include_once('assets/inc/header.php'); ?>
    <main>

    </main>
    <?php include_once('assets/inc/footer.php'); ?>
  </div>

  <!--.l-wrapper END-->
</body>

</html>