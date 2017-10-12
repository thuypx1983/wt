<?php
/**
 * Implements hook_html_head_alter().
 * This will overwrite the default meta character type tag with HTML5 version.
 */
function oms_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Insert themed breadcrumb page navigation at top of the node content.
 */
function oms_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Use CSS to hide titile .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // comment below line to hide current page to breadcrumb
    $breadcrumb[] = drupal_get_title();
    $output .= '<nav class="breadcrumb">' . implode(' » ', $breadcrumb) . '</nav>';
    return $output;
  }
}

/**
 * Override or insert variables into the html template.
 */
function oms_process_html(&$vars) {
  // Hook into color.module
  if (module_exists('color')) {
    _color_html_alter($vars);
  }
}

function oms_preprocess_html(&$variables) {

  drupal_add_css('//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i', array('type' => 'external'));
  drupal_add_css('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.min.css', array('type' => 'external'));
  drupal_add_css('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick-theme.min.css', array('type' => 'external'));
  drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.min.js', array('type' => 'external'));
}


/**
 * Override or insert variables into the page template.
 */
function oms_process_page(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }

}

/**
 * Override or insert variables into the page template.
 */
function oms_preprocess_page(&$vars) {
  if ($vars['is_front']) {
    unset($vars['page']['content']['system_main']);
  }

  if (isset($vars['node'])) {
    if($vars['node']->type=='webform')
    {
      // If the node type is "accommodation" the template suggestion will be "page--accommodation.tpl.php".
      $vars['theme_hook_suggestions'][] = 'page__'. $vars['node']->type;
      $vars['theme_hook_suggestions'][] = 'page__'. $vars['node']->type."__".$vars['node']->nid;
    }
    else{
      $vars['theme_hook_suggestions'][] = 'page__node__'. $vars['node']->type;
    }
  }

  if (isset($vars['main_menu'])) {
    $vars['main_menu'] = theme('links__system_main_menu', array(
      'links' => $vars['main_menu'],
      'attributes' => array(
        'class' => array('links', 'main-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['main_menu'] = FALSE;
  }
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_menu'] = theme('links__system_secondary_menu', array(
      'links' => $vars['secondary_menu'],
      'attributes' => array(
        'class' => array('links', 'secondary-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Secondary menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['secondary_menu'] = FALSE;
  }

  // Build footer_copyright variable to template.
  if (theme_get_setting('footer_copyright')) {
    if ($vars['site_name']) {
      $vars['footer_copyright'] = t('Copyright &copy; @year, @sitename.',
        array('@year' => date("Y"), '@sitename' => $vars['site_name'])
      );
    }
    else {
      $vars['footer_copyright'] = t('Copyright &copy; @year.',
        array('@year' => date("Y"), '@sitename' => $vars['site_name'])
      );
    }
  }
  else {
    $vars['footer_copyright'] = NULL;
  }
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function oms_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

/**
 * Override or insert variables into the node template.
 */
function oms_preprocess_node(&$variables) {
  $node = $variables['node'];
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
}

/**
 * Add javascript files for front-page jquery slideshow.
 */
if (drupal_is_front_page()) {
  //drupal_add_js(drupal_get_path('theme', 'oms') . '/js/sliding_effect.js');
}
