<header id="header" class="header">
    <div class="container">

        <div class="header-content">
            <div class="mobile-menu hidden-lg hidden-md ">

                <div class="">
                    <div class="menu-btn">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </div>
                    <div class="search-icon">
                        <span class="fa fa-search"></span>
                    </div>
                </div>

            </div>
          <?php if ($logo): ?>
              <div id="logo" class="logo">

                  <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
                      <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />

                  </a>

              </div>
          <?php endif; ?>
            <div id="main-menu" class="main-menu">
                <a class="btn-main-menu" title="Menu Thể loại" rel="nofollow" href="javascript:void(0);"><i class="fa fa-navicon"></i> Thể Loại</a>
                <nav id="navigation" role="navigation">
                  <?php
                  if (module_exists('i18n_menu')) {
                    $main_menu_tree = i18n_menu_translated_tree(variable_get('menu_main_links_source', 'main-menu'));
                  } else {
                    $main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
                  }
                  print drupal_render($main_menu_tree);
                  ?>
                </nav>
            </div>
            <div id="second-menu" class="second-menu">
                <a class="btn-second-menu" title="Menu sắp xếp" rel="nofollow" href="javascript:void(0);"><i class="fa fa-sort"></i> Sắp Xếp</a>
                <nav id="navigation-second-menu" class="" >
                  <?php
                  if (module_exists('i18n_menu')) {
                    $main_menu_tree = i18n_menu_translated_tree(variable_get('menu_main_links_source', 'menu-second-menu'));
                  } else {
                    $main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'menu-second-menu'));
                  }
                  print drupal_render($main_menu_tree);
                  ?>
                </nav>
            </div>
            <div class="search-box">
              <?php

              $block = module_invoke('search', 'block_view', 'search');
              print render($block);

              ?>
            </div>
            <div class="user-menu">
                <a href="#" rel="nofollow"><i class="fa fa-user"></i> Thành Viên</a>
                <nav id="navigation-user-menu" class="" >
                  <?php
                  if (module_exists('i18n_menu')) {
                    $main_menu_tree = i18n_menu_translated_tree(variable_get('menu_main_links_source', 'user-menu'));
                  } else {
                    $main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'user-menu'));
                  }
                  print drupal_render($main_menu_tree);
                  ?>
                </nav>
            </div>
        </div>
        <div class="pull-right hidden-sm hidden-xs">
            <!-- end main-menu -->
        </div>
    </div>
</header>

<?php print render($page['header']); ?>

<?php print $messages; ?>
<div class="clearfix"></div>