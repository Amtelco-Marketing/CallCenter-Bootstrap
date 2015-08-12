<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 */
?>
<div id="page-wrapper">
  <div id="page" class="<?php print $classes; ?>">
    <header id="header" role="banner" class="<?php print $navbar_classes; ?>">
      <div class="container">
        <div class="navbar-header navbar-default">
          <?php if ($logo): ?>
          <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="logo-normal" />
            <img src="<?php print $logo_small; ?>" alt="<?php print t('Home'); ?>" class="logo-small" />
          </a>
          <?php endif; ?>

          <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fa fa-navicon"></i> <span>Menu</span>
          </button>
        </div>

        <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['search'])): ?>
          <div class="navbar-collapse collapse">
          <?php if (!empty($secondary_nav)): ?>
            <?php print render($secondary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($page['search'])): ?>
            <?php print render($page['search']); ?>
          <?php endif; ?>
            <nav role="navigation">
              <?php if (!empty($primary_nav)): ?>
                <?php print render($primary_nav); ?>
              <?php endif; ?>
            </nav>
          </div>
        <?php endif; ?>
      </div>
    </header>

    <div class="main-container">
      <?php if (isset($banner)): ?>
      <header role="banner" id="page-header">
        <?php print render($banner); ?>
      </header> <!-- /#page-header -->
      <?php endif; ?>

      <?php if (!empty($page['sidebar_first'])): ?>
        <aside class="col-sm-3" role="complementary">
          <?php print render($page['sidebar_first']); ?>
        </aside>  <!-- /#sidebar-first -->
      <?php endif; ?>

      <?php if (isset($banner)): ?>
        <div class="container">
        </div>
      <?php endif; ?>

      <div class="page-title-header">
        <div class="container">
          <a id="main-content"></a>
          <?php print render($title_prefix); ?>
          <?php if (!empty($title) && !$is_front): ?>
            <h1 class="page-header"><?php print $title; ?></h1>
          <?php endif; ?>
          <?php print render($title_suffix); ?>
          <?php print render($page['title_bar']); ?>
        </div>
      </div>

      <div class="container">
        <?php if (!isset($banner)): ?>
      <?php endif; ?>
        <?php print $messages; ?>
        <?php if (!empty($tabs)): ?>
          <?php print render($tabs); ?>
        <?php endif; ?>
        <?php if (!empty($page['help'])): ?>
          <?php print render($page['help']); ?>
        <?php endif; ?>
        <?php if (!empty($action_links)): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
      </div>

      <?php print render($page['content']); ?>

      <?php if (!empty($page['sidebar_second'])): ?>
        <aside class="col-sm-3" role="complementary">
          <?php print render($page['sidebar_second']); ?>
        </aside>  <!-- /#sidebar-second -->
      <?php endif; ?>

    </div>
  </div><!-- /#page -->
  <footer id="footer" class="footer">
    <div id="footer-top">
      <div  class="container">
        <div class="row">
          <?php print render($page['footer_top']); ?>
        </div>
      </div>
    </div>
    <div id="footer-main">
      <div  class="container">
        <div class="row">
          <?php print render($page['footer']); ?>
        </div>
      </div>
    </div>
    <div id="footer-bottom">
      <div  class="container">
        <div class="row">
          <?php print render($page['footer_bottom']); ?>
        </div>
      </div>
    </div>
  </footer>
</div>
