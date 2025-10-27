<?php
/**
 * コンポーネント一覧ページ
 * テンプレートのコンポーネントの使い方をまとめたページ
 */

// プロジェクトルートのパスを設定
$path = realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR;

// 初期化スクリプトを読み込み
require_once $path . 'includes/core/init.php';

// ページ情報を初期化
initializePage('コンポーネント一覧 - ' . config('name'), 'テンプレートのコンポーネントの使い方をまとめたページです。');

// コンテンツをバッファリング
ob_start();
?>

<main class="l-main">
    <div class="l-container">
        <!-- ページヘッダー -->
        <header class="c-page-header">
            <h1 class="c-title c-title--h1">コンポーネント一覧</h1>
            <p class="c-page-header__description">
                このテンプレートで使用できるコンポーネントの使い方をまとめています。
            </p>
        </header>

        <!-- コンポーネント一覧 -->
        <div class="c-components-list">
            
            <!-- タイトルコンポーネント -->
            <section class="c-component-section">
                <h2 class="c-title c-title--h2">タイトル（c-title）</h2>
                <p class="c-component-section__description">
                    見出し用のコンポーネントです。サイズやスタイルを指定できます。
                </p>
                
                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">使用例</h3>
                    <div class="c-component-section__code">
                        <h1 class="c-title c-title--h1">H1タイトル</h1>
                        <h2 class="c-title c-title--h2">H2タイトル</h2>
                        <h3 class="c-title c-title--h3">H3タイトル</h3>
                    </div>
                </div>
                
                <div class="c-component-section__code-block">
                    <pre><code>&lt;h1 class="c-title c-title--h1"&gt;H1タイトル&lt;/h1&gt;
&lt;h2 class="c-title c-title--h2"&gt;H2タイトル&lt;/h2&gt;
&lt;h3 class="c-title c-title--h3"&gt;H3タイトル&lt;/h3&gt;</code></pre>
                </div>
            </section>

            <!-- ボタンコンポーネント -->
            <section class="c-component-section">
                <h2 class="c-title c-title--h2">ボタン（c-btn）</h2>
                <p class="c-component-section__description">
                    ボタン用のコンポーネントです。プライマリ、セカンダリ、アウトラインなどのバリエーションがあります。
                </p>
                
                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">基本スタイル</h3>
                    <div class="c-component-section__code">
                        <div class="c-btn-wrap">
                            <a href="#" class="c-btn c-btn--primary">プライマリボタン</a>
                            <a href="#" class="c-btn c-btn--secondary">セカンダリボタン</a>
                            <a href="#" class="c-btn c-btn--outline">アウトラインボタン</a>
                            <a href="#" class="c-btn c-btn--ghost">ゴーストボタン</a>
                        </div>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">サイズバリエーション</h3>
                    <div class="c-component-section__code">
                        <div class="c-btn-wrap c-btn-wrap--vertical">
                            <a href="#" class="c-btn c-btn--primary c-btn--xs">XSサイズ</a>
                            <a href="#" class="c-btn c-btn--primary c-btn--sm">SMサイズ</a>
                            <a href="#" class="c-btn c-btn--primary c-btn--md">MDサイズ（デフォルト）</a>
                            <a href="#" class="c-btn c-btn--primary c-btn--lg">LGサイズ</a>
                            <a href="#" class="c-btn c-btn--primary c-btn--xl">XLサイズ</a>
                        </div>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">個別padding調整</h3>
                    <div class="c-component-section__code">
                        <div class="c-btn-wrap c-btn-wrap--vertical">
                            <a href="#" class="c-btn c-btn--primary c-btn--minimal">Minimal</a>
                            <a href="#" class="c-btn c-btn--primary c-btn--compact">Compact</a>
                            <a href="#" class="c-btn c-btn--primary">通常</a>
                            <a href="#" class="c-btn c-btn--primary c-btn--spacious">Spacious</a>
                            <a href="#" class="c-btn c-btn--primary c-btn--generous">Generous</a>
                        </div>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">特殊用途</h3>
                    <div class="c-component-section__code">
                        <div class="c-btn-wrap">
                            <a href="#" class="c-btn c-btn--primary c-btn--icon-only">🔍</a>
                            <a href="#" class="c-btn c-btn--secondary c-btn--square">□</a>
                            <a href="#" class="c-btn c-btn--outline c-btn--text-only">テキストのみ</a>
                            <a href="#" class="c-btn c-btn--primary c-btn--icon">アイコン付き</a>
                        </div>
                    </div>
                </div>
                
                <div class="c-component-section__code-block">
                    <pre><code>&lt;!-- 基本ボタン --&gt;
&lt;a href="#" class="c-btn c-btn--primary"&gt;プライマリボタン&lt;/a&gt;
&lt;a href="#" class="c-btn c-btn--secondary"&gt;セカンダリボタン&lt;/a&gt;
&lt;a href="#" class="c-btn c-btn--outline"&gt;アウトラインボタン&lt;/a&gt;
&lt;a href="#" class="c-btn c-btn--ghost"&gt;ゴーストボタン&lt;/a&gt;

&lt;!-- サイズバリエーション --&gt;
&lt;a href="#" class="c-btn c-btn--primary c-btn--small"&gt;小サイズ&lt;/a&gt;
&lt;a href="#" class="c-btn c-btn--primary"&gt;通常サイズ&lt;/a&gt;
&lt;a href="#" class="c-btn c-btn--primary c-btn--large"&gt;大サイズ&lt;/a&gt;

&lt;!-- ボタンラッパー --&gt;
&lt;div class="c-btn-wrap"&gt;
    &lt;a href="#" class="c-btn c-btn--primary"&gt;ボタン1&lt;/a&gt;
    &lt;a href="#" class="c-btn c-btn--secondary"&gt;ボタン2&lt;/a&gt;
&lt;/div&gt;

&lt;!-- 縦並び --&gt;
&lt;div class="c-btn-wrap c-btn-wrap--vertical"&gt;
    &lt;a href="#" class="c-btn c-btn--primary"&gt;ボタン1&lt;/a&gt;
    &lt;a href="#" class="c-btn c-btn--secondary"&gt;ボタン2&lt;/a&gt;
&lt;/div&gt;</code></pre>
                </div>
            </section>

            <!-- カードコンポーネント -->
            <section class="c-component-section">
                <h2 class="c-title c-title--h2">カード（c-card）</h2>
                <p class="c-component-section__description">
                    カード形式のコンテンツ表示用コンポーネントです。GridレイアウトとFlexレイアウトの両方に対応しています。
                </p>
                
                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">Gridレイアウト（1列）</h3>
                    <div class="c-component-section__code">
                        <div class="c-card-grid">
                            <div class="c-card-grid__item">
                                <div class="c-card-grid__image">
                                    <img src="<?= e(path()->relative('assets/img/common/sample.jpg')) ?>" alt="サンプル画像">
                                </div>
                                <h3 class="c-card-grid__title">カードタイトル</h3>
                                <p class="c-card-grid__text">カードの説明文です。ここに詳細な内容を記載します。</p>
                                <a href="#" class="c-btn c-btn--primary">詳細を見る</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">Gridレイアウト（2列）</h3>
                    <div class="c-component-section__code">
                        <div class="c-card-grid c-card_2">
                            <div class="c-card-grid__item">
                                <div class="c-card-grid__image">
                                    <img src="<?= e(path()->relative('assets/img/common/sample.jpg')) ?>" alt="サンプル画像">
                                </div>
                                <h3 class="c-card-grid__title">カードタイトル1</h3>
                                <p class="c-card-grid__text">カードの説明文です。</p>
                                <a href="#" class="c-btn c-btn--primary c-btn--sm">詳細を見る</a>
                            </div>
                            <div class="c-card-grid__item">
                                <div class="c-card-grid__image">
                                    <img src="<?= e(path()->relative('assets/img/common/sample.jpg')) ?>" alt="サンプル画像">
                                </div>
                                <h3 class="c-card-grid__title">カードタイトル2</h3>
                                <p class="c-card-grid__text">カードの説明文です。</p>
                                <a href="#" class="c-btn c-btn--secondary c-btn--sm">詳細を見る</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">Gridレイアウト（3列）</h3>
                    <div class="c-component-section__code">
                        <div class="c-card-grid c-card_3">
                            <div class="c-card-grid__item">
                                <div class="c-card-grid__image">
                                    <img src="<?= e(path()->relative('assets/img/common/sample.jpg')) ?>" alt="サンプル画像">
                                </div>
                                <h3 class="c-card-grid__title">カード1</h3>
                                <p class="c-card-grid__text">説明文</p>
                                <a href="#" class="c-btn c-btn--primary c-btn--sm">詳細</a>
                            </div>
                            <div class="c-card-grid__item">
                                <div class="c-card-grid__image">
                                    <img src="<?= e(path()->relative('assets/img/common/sample.jpg')) ?>" alt="サンプル画像">
                                </div>
                                <h3 class="c-card-grid__title">カード2</h3>
                                <p class="c-card-grid__text">説明文</p>
                                <a href="#" class="c-btn c-btn--secondary c-btn--sm">詳細</a>
                            </div>
                            <div class="c-card-grid__item">
                                <div class="c-card-grid__image">
                                    <img src="<?= e(path()->relative('assets/img/common/sample.jpg')) ?>" alt="サンプル画像">
                                </div>
                                <h3 class="c-card-grid__title">カード3</h3>
                                <p class="c-card-grid__text">説明文</p>
                                <a href="#" class="c-btn c-btn--outline c-btn--sm">詳細</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">Flexレイアウト（2列）</h3>
                    <div class="c-component-section__code">
                        <div class="c-card-flex c-card_2">
                            <div class="c-card-flex__item">
                                <div class="c-card-flex__image">
                                    <img src="<?= e(path()->relative('assets/img/common/sample.jpg')) ?>" alt="サンプル画像">
                                </div>
                                <h3 class="c-card-flex__title">Flexカード1</h3>
                                <p class="c-card-flex__text">Flexレイアウトのカードです。</p>
                                <a href="#" class="c-btn c-btn--primary c-btn--sm">詳細を見る</a>
                            </div>
                            <div class="c-card-flex__item">
                                <div class="c-card-flex__image">
                                    <img src="<?= e(path()->relative('assets/img/common/sample.jpg')) ?>" alt="サンプル画像">
                                </div>
                                <h3 class="c-card-flex__title">Flexカード2</h3>
                                <p class="c-card-flex__text">Flexレイアウトのカードです。</p>
                                <a href="#" class="c-btn c-btn--secondary c-btn--sm">詳細を見る</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">Flexレイアウト（3列）</h3>
                    <div class="c-component-section__code">
                        <div class="c-card-flex c-card_3">
                            <div class="c-card-flex__item">
                                <div class="c-card-flex__image">
                                    <img src="<?= e(path()->relative('assets/img/common/sample.jpg')) ?>" alt="サンプル画像">
                                </div>
                                <h3 class="c-card-flex__title">Flex1</h3>
                                <p class="c-card-flex__text">説明</p>
                                <a href="#" class="c-btn c-btn--primary c-btn--xs">詳細</a>
                            </div>
                            <div class="c-card-flex__item">
                                <div class="c-card-flex__image">
                                    <img src="<?= e(path()->relative('assets/img/common/sample.jpg')) ?>" alt="サンプル画像">
                                </div>
                                <h3 class="c-card-flex__title">Flex2</h3>
                                <p class="c-card-flex__text">説明</p>
                                <a href="#" class="c-btn c-btn--secondary c-btn--xs">詳細</a>
                            </div>
                            <div class="c-card-flex__item">
                                <div class="c-card-flex__image">
                                    <img src="<?= e(path()->relative('assets/img/common/sample.jpg')) ?>" alt="サンプル画像">
                                </div>
                                <h3 class="c-card-flex__title">Flex3</h3>
                                <p class="c-card-flex__text">説明</p>
                                <a href="#" class="c-btn c-btn--outline c-btn--xs">詳細</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="c-component-section__code-block">
                    <pre><code>&lt;!-- Gridレイアウト（1列） --&gt;
&lt;div class="c-card-grid"&gt;
    &lt;div class="c-card-grid__item"&gt;
        &lt;div class="c-card-grid__image"&gt;
            &lt;img src="image.jpg" alt="画像"&gt;
        &lt;/div&gt;
        &lt;h3 class="c-card-grid__title"&gt;カードタイトル&lt;/h3&gt;
        &lt;p class="c-card-grid__text"&gt;カードの説明文&lt;/p&gt;
        &lt;a href="#" class="c-btn c-btn--primary"&gt;詳細を見る&lt;/a&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;!-- Gridレイアウト（2列） --&gt;
&lt;div class="c-card-grid c-card_2"&gt;
    &lt;div class="c-card-grid__item"&gt;...&lt;/div&gt;
    &lt;div class="c-card-grid__item"&gt;...&lt;/div&gt;
&lt;/div&gt;

&lt;!-- Gridレイアウト（3列） --&gt;
&lt;div class="c-card-grid c-card_3"&gt;
    &lt;div class="c-card-grid__item"&gt;...&lt;/div&gt;
    &lt;div class="c-card-grid__item"&gt;...&lt;/div&gt;
    &lt;div class="c-card-grid__item"&gt;...&lt;/div&gt;
&lt;/div&gt;

&lt;!-- Flexレイアウト（2列） --&gt;
&lt;div class="c-card-flex c-card_2"&gt;
    &lt;div class="c-card-flex__item"&gt;
        &lt;div class="c-card-flex__image"&gt;
            &lt;img src="image.jpg" alt="画像"&gt;
        &lt;/div&gt;
        &lt;h3 class="c-card-flex__title"&gt;カードタイトル&lt;/h3&gt;
        &lt;p class="c-card-flex__text"&gt;カードの説明文&lt;/p&gt;
        &lt;a href="#" class="c-btn c-btn--primary"&gt;詳細を見る&lt;/a&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;!-- Flexレイアウト（3列） --&gt;
&lt;div class="c-card-flex c-card_3"&gt;
    &lt;div class="c-card-flex__item"&gt;...&lt;/div&gt;
    &lt;div class="c-card-flex__item"&gt;...&lt;/div&gt;
    &lt;div class="c-card-flex__item"&gt;...&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>
            </section>

            <!-- リストコンポーネント -->
            <section class="c-component-section">
                <h2 class="c-title c-title--h2">リスト（c-list）</h2>
                <p class="c-component-section__description">
                    リスト表示用のコンポーネントです。ul、ol、dlなど様々なリストタグとスタイルに対応しています。
                </p>
                
                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">基本リスト（ul）</h3>
                    <div class="c-component-section__code">
                        <ul class="c-list c-list__plain">
                            <li>ドット付きリストアイテム1</li>
                            <li>ドット付きリストアイテム2</li>
                            <li>ドット付きリストアイテム3</li>
                        </ul>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">番号付きリスト（ol）</h3>
                    <div class="c-component-section__code">
                        <ol class="c-list c-list__numbered">
                            <li>番号付きリストアイテム1</li>
                            <li>番号付きリストアイテム2</li>
                            <li>番号付きリストアイテム3</li>
                        </ol>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">チェックマーク付きリスト</h3>
                    <div class="c-component-section__code">
                        <ul class="c-list c-list__check">
                            <li>チェックマーク付きアイテム1</li>
                            <li>チェックマーク付きアイテム2</li>
                            <li>チェックマーク付きアイテム3</li>
                        </ul>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">カード風リスト</h3>
                    <div class="c-component-section__code">
                        <ul class="c-list c-list__card">
                            <li>カード風リストアイテム1</li>
                            <li>カード風リストアイテム2</li>
                            <li>カード風リストアイテム3</li>
                        </ul>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">インラインリスト</h3>
                    <div class="c-component-section__code">
                        <ul class="c-list c-list__inline">
                            <li>タグ1</li>
                            <li>タグ2</li>
                            <li>タグ3</li>
                            <li>タグ4</li>
                        </ul>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">定義リスト（dl dt dd）</h3>
                    <div class="c-component-section__code">
                        <dl class="c-definition-list">
                            <dt>用語1</dt>
                            <dd>用語1の説明文です。詳細な内容をここに記載します。</dd>
                            <dt>用語2</dt>
                            <dd>用語2の説明文です。詳細な内容をここに記載します。</dd>
                            <dt>用語3</dt>
                            <dd>用語3の説明文です。詳細な内容をここに記載します。</dd>
                        </dl>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">横並び定義リスト</h3>
                    <div class="c-component-section__code">
                        <dl class="c-definition-list c-definition-list--horizontal">
                            <dt>項目1</dt>
                            <dd>項目1の説明</dd>
                            <dt>項目2</dt>
                            <dd>項目2の説明</dd>
                            <dt>項目3</dt>
                            <dd>項目3の説明</dd>
                        </dl>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">カード風定義リスト</h3>
                    <div class="c-component-section__code">
                        <dl class="c-definition-list c-definition-list--card">
                            <dt>カードタイトル1</dt>
                            <dd>カード風定義リストの説明文です。</dd>
                            <dt>カードタイトル2</dt>
                            <dd>カード風定義リストの説明文です。</dd>
                        </dl>
                    </div>
                </div>

                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">番号付きリスト（ol）バリエーション</h3>
                    <div class="c-component-section__code">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div>
                                <h4>通常の番号</h4>
                                <ol class="c-ordered-list">
                                    <li>アイテム1</li>
                                    <li>アイテム2</li>
                                    <li>アイテム3</li>
                                </ol>
                            </div>
                            <div>
                                <h4>括弧付き番号</h4>
                                <ol class="c-ordered-list c-ordered-list--parentheses">
                                    <li>アイテム1</li>
                                    <li>アイテム2</li>
                                    <li>アイテム3</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="c-component-section__code-block">
                    <pre><code>&lt;!-- 基本リスト（ul） --&gt;
&lt;ul class="c-list c-list__plain"&gt;
    &lt;li&gt;ドット付きリストアイテム1&lt;/li&gt;
    &lt;li&gt;ドット付きリストアイテム2&lt;/li&gt;
    &lt;li&gt;ドット付きリストアイテム3&lt;/li&gt;
&lt;/ul&gt;

&lt;!-- 番号付きリスト（ol） --&gt;
&lt;ol class="c-list c-list__numbered"&gt;
    &lt;li&gt;番号付きリストアイテム1&lt;/li&gt;
    &lt;li&gt;番号付きリストアイテム2&lt;/li&gt;
    &lt;li&gt;番号付きリストアイテム3&lt;/li&gt;
&lt;/ol&gt;

&lt;!-- チェックマーク付きリスト --&gt;
&lt;ul class="c-list c-list__check"&gt;
    &lt;li&gt;チェックマーク付きアイテム1&lt;/li&gt;
    &lt;li&gt;チェックマーク付きアイテム2&lt;/li&gt;
    &lt;li&gt;チェックマーク付きアイテム3&lt;/li&gt;
&lt;/ul&gt;

&lt;!-- カード風リスト --&gt;
&lt;ul class="c-list c-list__card"&gt;
    &lt;li&gt;カード風リストアイテム1&lt;/li&gt;
    &lt;li&gt;カード風リストアイテム2&lt;/li&gt;
    &lt;li&gt;カード風リストアイテム3&lt;/li&gt;
&lt;/ul&gt;

&lt;!-- インラインリスト --&gt;
&lt;ul class="c-list c-list__inline"&gt;
    &lt;li&gt;タグ1&lt;/li&gt;
    &lt;li&gt;タグ2&lt;/li&gt;
    &lt;li&gt;タグ3&lt;/li&gt;
&lt;/ul&gt;

&lt;!-- 定義リスト（dl dt dd） --&gt;
&lt;dl class="c-definition-list"&gt;
    &lt;dt&gt;用語1&lt;/dt&gt;
    &lt;dd&gt;用語1の説明文です。&lt;/dd&gt;
    &lt;dt&gt;用語2&lt;/dt&gt;
    &lt;dd&gt;用語2の説明文です。&lt;/dd&gt;
&lt;/dl&gt;

&lt;!-- 横並び定義リスト --&gt;
&lt;dl class="c-definition-list c-definition-list--horizontal"&gt;
    &lt;dt&gt;項目1&lt;/dt&gt;
    &lt;dd&gt;項目1の説明&lt;/dd&gt;
&lt;/dl&gt;

&lt;!-- カード風定義リスト --&gt;
&lt;dl class="c-definition-list c-definition-list--card"&gt;
    &lt;dt&gt;カードタイトル&lt;/dt&gt;
    &lt;dd&gt;カード風定義リストの説明文です。&lt;/dd&gt;
&lt;/dl&gt;

&lt;!-- 番号付きリスト（ol）バリエーション --&gt;
&lt;ol class="c-ordered-list"&gt;
    &lt;li&gt;通常の番号&lt;/li&gt;
&lt;/ol&gt;

&lt;ol class="c-ordered-list c-ordered-list--parentheses"&gt;
    &lt;li&gt;括弧付き番号&lt;/li&gt;
&lt;/ol&gt;

&lt;ol class="c-ordered-list c-ordered-list--roman"&gt;
    &lt;li&gt;ローマ数字&lt;/li&gt;
&lt;/ol&gt;

&lt;ol class="c-ordered-list c-ordered-list--alpha"&gt;
    &lt;li&gt;アルファベット&lt;/li&gt;
&lt;/ol&gt;</code></pre>
                </div>
            </section>

            <!-- パンくずリストコンポーネント -->
            <section class="c-component-section">
                <h2 class="c-title c-title--h2">パンくずリスト（c-breadcrumb）</h2>
                <p class="c-component-section__description">
                    パンくずリスト用のコンポーネントです。PHPのbreadcrumb()関数で自動生成できます。
                </p>
                
                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">使用例</h3>
                    <div class="c-component-section__code">
                        <?= breadcrumb() ?>
                    </div>
                </div>
                
                <div class="c-component-section__code-block">
                    <pre><code>&lt;?= breadcrumb() ?&gt;</code></pre>
                </div>
            </section>

            <!-- タブパネルコンポーネント -->
            <section class="c-component-section">
                <h2 class="c-title c-title--h2">タブパネル（c-tab-panel）</h2>
                <p class="c-component-section__description">
                    タブ切り替え用のコンポーネントです。JavaScriptで動作し、様々なデザインバリエーションに対応しています。
                </p>
                
                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">基本タブパネル</h3>
                    <div class="c-component-section__code">
                        <div class="c-tab-panel" role="tablist">
                            <div class="c-tab-panel__tabs">
                                <button class="c-tab-panel__tab is-active" 
                                        data-tab="tab1" 
                                        role="tab" 
                                        aria-selected="true" 
                                        aria-controls="panel-tab1"
                                        id="tab-tab1">タブ1</button>
                                <button class="c-tab-panel__tab" 
                                        data-tab="tab2" 
                                        role="tab" 
                                        aria-selected="false" 
                                        aria-controls="panel-tab2"
                                        id="tab-tab2">タブ2</button>
                                <button class="c-tab-panel__tab" 
                                        data-tab="tab3" 
                                        role="tab" 
                                        aria-selected="false" 
                                        aria-controls="panel-tab3"
                                        id="tab-tab3">タブ3</button>
                            </div>
                            <div class="c-tab-panel__panel is-active" 
                                 data-panel="tab1" 
                                 role="tabpanel" 
                                 aria-labelledby="tab-tab1"
                                 id="panel-tab1">
                                <p>タブ1のコンテンツです。</p>
                            </div>
                            <div class="c-tab-panel__panel" 
                                 data-panel="tab2" 
                                 role="tabpanel" 
                                 aria-labelledby="tab-tab2"
                                 id="panel-tab2">
                                <p>タブ2のコンテンツです。</p>
                            </div>
                            <div class="c-tab-panel__panel" 
                                 data-panel="tab3" 
                                 role="tabpanel" 
                                 aria-labelledby="tab-tab3"
                                 id="panel-tab3">
                                <p>タブ3のコンテンツです。</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="c-component-section__code-block">
                    <pre><code>&lt;div class="c-tab-panel"&gt;
    &lt;div class="c-tab-panel__tabs"&gt;
        &lt;button class="c-tab-panel__tab is-active" data-tab="tab1"&gt;タブ1&lt;/button&gt;
        &lt;button class="c-tab-panel__tab" data-tab="tab2"&gt;タブ2&lt;/button&gt;
    &lt;/div&gt;
    &lt;div class="c-tab-panel__panel is-active" data-panel="tab1"&gt;
        タブ1のコンテンツ
    &lt;/div&gt;
    &lt;div class="c-tab-panel__panel" data-panel="tab2"&gt;
        タブ2のコンテンツ
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>
            </section>

            <!-- アコーディオンコンポーネント -->
            <section class="c-component-section">
                <h2 class="c-title c-title--h2">アコーディオン（c-accordion）</h2>
                <p class="c-component-section__description">
                    アコーディオン形式のコンテンツ表示用コンポーネントです。&lt;details&gt;と&lt;summary&gt;を使用したセマンティックな実装です。
                </p>
                
                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">使用例</h3>
                    <div class="c-component-section__code">
                        <details class="c-accordion">
                            <summary class="c-accordion__label">アコーディオン1</summary>
                            <div class="c-accordion__box">
                                <div class="l-inner">
                                    <p>アコーディオン1のコンテンツです。詳細な情報をここに記載します。</p>
                                </div>
                            </div>
                        </details>
                        <details class="c-accordion">
                            <summary class="c-accordion__label">アコーディオン2</summary>
                            <div class="c-accordion__box">
                                <div class="l-inner">
                                    <p>アコーディオン2のコンテンツです。詳細な情報をここに記載します。</p>
                                </div>
                            </div>
                        </details>
                    </div>
                </div>
                
                <div class="c-component-section__code-block">
                    <pre><code>&lt;details class="c-accordion"&gt;
    &lt;summary class="c-accordion__label"&gt;アコーディオン1&lt;/summary&gt;
    &lt;div class="c-accordion__box"&gt;
        &lt;div class="l-inner"&gt;
            &lt;p&gt;アコーディオン1のコンテンツ&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/details&gt;</code></pre>
                </div>
            </section>

            <!-- ページネーションコンポーネント -->
            <section class="c-component-section">
                <h2 class="c-title c-title--h2">ページネーション（c-pagination）</h2>
                <p class="c-component-section__description">
                    ページネーション用のコンポーネントです。PHPのpagination()関数で自動生成できます。
                </p>
                
                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">使用例</h3>
                    <div class="c-component-section__code">
                        <?= pagination(3, 10, '/components') ?>
                    </div>
                </div>
                
                <div class="c-component-section__code-block">
                    <pre><code>&lt;?= pagination(3, 10, '/components') ?&gt;</code></pre>
                </div>
            </section>

            <!-- フォームコンポーネント -->
            <section class="c-component-section">
                <h2 class="c-title c-title--h2">フォーム（c-form）</h2>
                <p class="c-component-section__description">
                    フォーム用のコンポーネントです。入力フィールドやボタンなどのスタイルが定義されています。
                </p>
                
                <div class="c-component-section__example">
                    <h3 class="c-title c-title--h3">使用例</h3>
                    <div class="c-component-section__code">
                        <form class="c-form">
                            <dl class="c-form_row">
                                <dt class="c-form_label">
                                    <label for="name">お名前</label>
                                </dt>
                                <dd class="c-form_input_l">
                                    <input type="text" id="name" placeholder="お名前を入力してください">
                                </dd>
                            </dl>
                            <dl class="c-form_row">
                                <dt class="c-form_label">
                                    <label for="email">メールアドレス</label>
                                </dt>
                                <dd class="c-form_input_l">
                                    <input type="email" id="email" placeholder="メールアドレスを入力してください">
                                </dd>
                            </dl>
                            <dl class="c-form_row">
                                <dt class="c-form_label">
                                    <label for="message">お問い合わせ内容</label>
                                </dt>
                                <dd class="c-form_input_l">
                                    <textarea id="message" placeholder="お問い合わせ内容を入力してください"></textarea>
                                </dd>
                            </dl>
                            <div class="c-form_row">
                                <button type="submit" class="c-btn c-btn--primary">送信する</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="c-component-section__code-block">
                    <pre><code>&lt;form class="c-form"&gt;
    &lt;dl class="c-form_row"&gt;
        &lt;dt class="c-form_label"&gt;
            &lt;label for="name"&gt;お名前&lt;/label&gt;
        &lt;/dt&gt;
        &lt;dd class="c-form_input_l"&gt;
            &lt;input type="text" id="name"&gt;
        &lt;/dd&gt;
    &lt;/dl&gt;
    &lt;div class="c-form_row"&gt;
        &lt;button type="submit" class="c-btn c-btn--primary"&gt;送信する&lt;/button&gt;
    &lt;/div&gt;
&lt;/form&gt;</code></pre>
                </div>
            </section>

        </div>

        <!-- ナビゲーション -->
        <nav class="c-page-nav">
            <a href="<?= e(path()->relative('/')) ?>" class="c-btn c-btn--outline">トップページに戻る</a>
            <a href="<?= e(path()->relative('/about')) ?>" class="c-btn c-btn--primary">Aboutページへ</a>
        </nav>

    </div>
</main>

<?php
// コンテンツを取得
$content = ob_get_clean();

// ベーステンプレートを読み込み
include $path . 'templates/base.php';
?>

