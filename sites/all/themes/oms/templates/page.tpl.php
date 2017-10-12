<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>

<div id="wrap">
  <?php
  include(drupal_get_path('theme', 'oms').'/templates/header.tpl.php');
  ?>
    <div id="main">
        <div class="container">
            <div class="content-header">
              <?php if (theme_get_setting('breadcrumbs')): ?><div id="breadcrumbs"><?php if ($breadcrumb): print $breadcrumb; endif;?></div><?php endif; ?>
              <?php print $messages; ?>
              <?php if ($page['content_top']): ?><div id="content_top"><?php print render($page['content_top']); ?></div><?php endif; ?>
              <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper clearfix"><?php print render($tabs); ?></div><?php endif; ?>
              <?php print render($page['help']); ?>
              <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
                <?php
                $n=menu_get_object();
                if (!$n) { ?>
                    <h1><?php echo $title; ?></h1>
                    <?php
                }
                ?>
            </div>
            <div class="row">
              <?php if ($page['sidebar_first']): ?>
                  <div class="col-md-3">
                      <aside id="sidebar" role="complementary" class="sidebar clearfix">
                        <?php print render($page['sidebar_first']); ?>
                      </aside>
                  </div>
              <?php endif; ?>
              <?php
              $main_class="col-md-12";
              if($page['sidebar_first'] AND $page['sidebar_second']){
                $main_class="col-md-6";
              }elseif(!$page['sidebar_first'] AND !$page['sidebar_second']){
                $main_class="col-md-12";
              }else{
                $main_class="col-md-9";
              }
              ?>
                <div class="<?php echo $main_class?>">
                  <?php
                  if($page['banner_top_content']){
                    ?>
                      <div class="banner-second">
                        <?php print render($page['banner_top_content']);?>
                      </div>
                    <?php
                  }
                  ?>
                    <section id="post-content" role="main">
                      <?php print render($page['content']); ?>
                    </section>
                  <?php
                  if($page['content_after']){
                    ?>
                      <div class="content-after">
                          <div class="container">
                            <?php print render($page['content_after']);?>
                          </div>
                      </div>
                    <?php

                  }?>
                </div>

              <?php if ($page['sidebar_second']): ?>
                  <div class="col-md-3">
                      <aside id="sidebar" role="complementary" class="sidebar clearfix">
                        <?php print render($page['sidebar_second']); ?>
                      </aside>
                  </div>
              <?php endif; ?>

            </div>
        </div>
      <?php
      if($page['content_footer']){
        ?>
          <div class="content-footer">
              <div class="container">
                <?php print render($page['content_footer']);?>
              </div>
          </div>
        <?php

      }?>
    </div>

  <?php
  include(drupal_get_path('theme', 'oms').'/templates/footer.tpl.php');
  ?>
</div>
