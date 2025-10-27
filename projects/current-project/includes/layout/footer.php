<?php
/**
 * フッターコンポーネント
 */
?>
<footer class="l-footer" role="contentinfo">
    <div class="l-container is-flex">
        <div class="l-footer__logo">
            <p><?= e(config('name')) ?></p>
        </div>
        
        <div class="c-copyright">
            <p class="c-copyright__txt">
                &copy; <?= e(config('copyright')) ?> <?= e(config('name')) ?> All Rights Reserved.
            </p>
        </div>
    </div>
</footer>

<!-- JavaScript -->
<script src="<?= e(path()->relative('assets/js/common.js')) ?>"></script>

<?php if (config('environment.debug')): ?>
<!-- デバッグ情報 -->
<script>
console.log('Page Info:', <?= json_encode($page) ?>);
console.log('Path Info:', <?= json_encode([
    'current_url' => path()->currentUrl(),
    'base_path' => path()->relative(''),
    'full_url' => path()->fullUrl()
]) ?>);
</script>
<?php endif; ?>
