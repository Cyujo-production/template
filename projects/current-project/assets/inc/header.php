<header id="header" class="l-header">
  <div class="l-container is-flex">
    <div class="l-header_logo">
      <h1><?php echo $sitename; ?></h1> 
    </div>
    <!-- // .l-header_logo END -->
    <div id="js-nav-toggle" class="l-header_toggle"><span></span></div>
    <nav id="global-nav" class="l-nav is-flex">
      <div class="l-nav_logo"><p><?php echo $sitename; ?></p></div>
      <ul>
        <li><a href="<?php echo $path; ?>">HOME</a></li>
        <li><a href="<?php echo $path; ?>about/">ABOUT</a></li>
        <li><a href="<?php echo $path; ?>event/">EVENT</a>
        </li>
      </ul>
      <div class="l-nav_contact_tel">
        <p>●お電話でお問い合わせの方はコチラ</p>
        <a href="tel:0120-5292-39"><span>0120-5292-39</span><small>受付時間／10：00～17：00（定休日／土･日･祝日）</small></a>
      </div>
      <a class="l-header_btn" href="#contact">お問い合わせ</a>
    </nav>
    <!-- // #global-nav END -->
  </div>
  <!-- // .is-flex END -->
</header>
<!-- // .l-header END -->