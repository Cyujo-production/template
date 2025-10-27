//----------------------------------------
//プロジェクト単位で不要なスクリプトは非表示または削除すること
//このテンプレートに記述するスクリプトはバニラJSで記述すること
//----------------------------------------

//----------------------------------------
// 自動で画像サイズ（表示サイズ）を取得して付与する
//----------------------------------------

function setImgSizeAttributes() {
  const imgs = document.getElementsByTagName('img');
  for (const img of imgs) {
    // 任意: disable-size-setting クラスなど無視する条件があるなら
    if (img.classList.contains('disable-size-setting')) {
      continue;
    }
    
    // すでに width または height 属性が設定されている場合はスキップ
    if (img.hasAttribute('width') || img.hasAttribute('height')) {
      continue;
    }

    // 実際の表示サイズを取得
    const displayedWidth = img.offsetWidth;
    const displayedHeight = img.offsetHeight;

    // console.log('displayed:', displayedWidth, displayedHeight);

    // offsetWidth または offsetHeight が 0 の場合（画像が非表示の場合）はスキップ
    if (displayedWidth && displayedHeight) {
      img.setAttribute('width', displayedWidth);
      img.setAttribute('height', displayedHeight);
    }
  }
}

window.addEventListener('load', setImgSizeAttributes);

//----------------------------------------
// スムーススクロール
//----------------------------------------
document.addEventListener("DOMContentLoaded", function () {
  const header = document.querySelector(".l-header");
  let headerHeight = 0;

  if (header) {
    const headerPosition = window.getComputedStyle(header).position;
    if (headerPosition === "fixed" || headerPosition === "absolute") {
      headerHeight = header.offsetHeight;
    }
  }

  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const href = anchor.getAttribute("href");
      const target = document.getElementById(href.replace("#", ""));

      if (target) {
        const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        });
      }
    });
  });
});


//----------------------------------------
// グローバルメニュートグルボタン開閉処理
//----------------------------------------
//ドロワーメニュー制御
document.addEventListener("DOMContentLoaded", function () {
  const navToggle = document.querySelector("[data-nav-toggle]");
  const globalNav = document.querySelector("[data-global-nav]");
  const body = document.body;

  // data-nav-toggleをクリックした際の処理
  navToggle.addEventListener("click", function () {
    this.classList.toggle("is-active");
    globalNav.classList.toggle("is-show");
    body.classList.toggle("is-scroll_off");
  });

  // data-global-nav内のコンテンツをクリックした際の処理
  globalNav.addEventListener("click", function () {
    navToggle.classList.remove("is-active");
    this.classList.remove("is-show");
    body.classList.remove("is-scroll_off");
  });

  // 画面サイズが1200px以上になった際の処理
  window.addEventListener("resize", function () {
    if (window.innerWidth >= 1200) {
      navToggle.classList.remove("is-active");
      globalNav.classList.remove("is-show");
      body.classList.remove("is-scroll_off");
    }
  });
});

//----------------------------------------
// スクロールフェードインアニメーション
//----------------------------------------

function scroll_effect() {
  const elements = document.getElementsByClassName('js-scroll-up');
  if (!elements.length) return;

  const { scrollY, innerHeight: windowH } = window;
  const showTiming = 100;

  for (const elem of elements) {
    const { top: elemTop } = elem.getBoundingClientRect();
    if (scrollY > elemTop + scrollY - windowH + showTiming) {
      elem.classList.add('is-show');
    }
  }
}

window.addEventListener('scroll', scroll_effect);
window.addEventListener('load', scroll_effect); 


//----------------------------------------
//ページ内ナビゲーション カレント表示
//----------------------------------------

document.addEventListener('DOMContentLoaded', () => {
  const headerHeight = document.querySelector('.l-header').offsetHeight;
  const navLinks = document.querySelectorAll('[data-global-nav] a'); // ナビゲーションリンクを選択

  function onScroll() {
      let found = false;
      navLinks.forEach((link) => {
          if (found) return;
          const sectionId = link.getAttribute('href').substring(1);
          const section = document.getElementById(sectionId);
          if (section) {
              const rect = section.getBoundingClientRect();
              const top = rect.top;
              const bottom = rect.bottom;
              // ビューポート内にセクションがあるかチェック
              if (top <= headerHeight && bottom >= headerHeight) {
                  link.classList.add('is-current');
                  found = true; // 一つ見つかったら他はチェックしない
              } else {
                  link.classList.remove('is-current');
              }
          }
      });
  }
  window.addEventListener('scroll', onScroll);
});

//----------------------------------------
// .c-accordion アコーディオンを設定
//----------------------------------------
document.addEventListener('DOMContentLoaded', function() {
  const accordions = document.querySelectorAll('.c-accordion');
  
  accordions.forEach(accordion => {
    const summary = accordion.querySelector('summary');
    const details = accordion.querySelector('details');
    const answer = accordion.querySelector('.c-accordion__box');
    
    if (!summary || !details || !answer) return;
    
    // アニメーション設定
    const animTiming = {
      duration: 300,
      easing: 'ease-in-out'
    };
    
    const closingAnimation = (element) => [
      { height: element.scrollHeight + 'px', opacity: 1 },
      { height: 0, opacity: 0 }
    ];
    
    const openingAnimation = (height) => [
      { height: 0, opacity: 0 },
      { height: height + 'px', opacity: 1 }
    ];
    
    summary.addEventListener("click", (event) => {
      event.preventDefault();

      if (details.hasAttribute("open")) {
        details.removeAttribute("open");

        const closingAnim = answer.animate(closingAnimation(answer), animTiming);
        // アニメーション中は display: none を設定しない
        closingAnim.onfinish = () => {
          // アニメーション完了後に非表示化
          answer.style.display = "none";
          answer.style.height = "";
          answer.style.opacity = "";
        };
      } else {
        details.setAttribute("open", "true");
        answer.style.display = "block";

        const height = answer.scrollHeight;
        const openingAnim = answer.animate(openingAnimation(height), animTiming);
        openingAnim.onfinish = () => {
          answer.style.height = "";
          answer.style.opacity = "";
        };
      }
    });
  });
});

//----------------------------------------
//c-tabs タブ切り替え
//----------------------------------------
document.addEventListener("DOMContentLoaded", function () {
  // タブの要素を取得
  const tabs = document.querySelectorAll(".c-tab-panel__tab");
  const panels = document.querySelectorAll(".c-tab-panel__panel");

  if (tabs.length === 0 || panels.length === 0) return;

  tabs.forEach((tab) => {
    tab.addEventListener("click", tabSwitch, false);
  });

  function tabSwitch() {
    // すでにアクティブなタブとコンテンツを取得
    const activeTab = document.querySelector(".c-tab-panel__tab.is-active");
    const activePanel = document.querySelector(".c-tab-panel__panel.is-active");

    // 既存のアクティブ状態を解除
    if (activeTab) {
      activeTab.classList.remove("is-active");
      activeTab.setAttribute("aria-selected", "false");
    }
    if (activePanel) {
      activePanel.classList.remove("is-active");
    }

    // クリックしたタブをアクティブにする
    this.classList.add("is-active");
    this.setAttribute("aria-selected", "true");

    // data-tab属性を使用して対応するパネルを取得
    const tabId = this.getAttribute("data-tab");
    const targetPanel = document.querySelector(`[data-panel="${tabId}"]`);
    
    if (targetPanel) {
      targetPanel.classList.add("is-active");
    }
  }
});