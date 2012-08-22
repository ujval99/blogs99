<?php
/**
 * @file
 * Template Override for the blogs99 theme.
 */

/**
 * Add body classes if certain regions have content.
 */
function blogs99_preprocess_html(&$variables) {

  if (empty($variables['page']['sidebar_first'])) {
    $variables['classes_array'][] = 'one-sidebar sidebar-first';
  }
}

/**
 * Override or insert variables into the page template for HTML output.
 */
function blogs99_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

/**
 * Override or insert variables into the page template.
 */
function blogs99_process_page(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
  // Since the title and the shortcut link are both block level elements,
  // positioning them next to each other is much simpler with a wrapper div.
  if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
    // Add a wrapper div using the title_prefix and title_suffix render elements.
    $variables['title_prefix']['shortcut_wrapper'] = array(
      '#markup' => '<div class="shortcut-wrapper clearfix">',
      '#weight' => 100,
    );
    $variables['title_suffix']['shortcut_wrapper'] = array(
      '#markup' => '</div>',
      '#weight' => -99,
    );
    // Make sure the shortcut link is the first item in title_suffix.
    $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
  }
}

/**
 * Implements hook_preprocess_maintenance_page().
 */
function blogs99_preprocess_maintenance_page(&$variables) {
  if (!$variables['db_is_active']) {
    unset($variables['site_name']);
  }
  drupal_add_css(drupal_get_path('theme', 'blogs99') . '/css/maintenance-page.css');
}

/**
 * Override or insert variables into the maintenance page template.
 */
function blogs99_process_maintenance_page(&$variables) {
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
}

/**
 * Override or insert variables into the node template.
 */
function blogs99_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
}

/**
 * Override or insert variables into the block template.
 */
function blogs99_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Implements theme_menu_tree().
 */
function blogs99_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function blogs99_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '">' . $output . '</div>';

  return $output;
}

/**
 * Social Media Links.
 */
function blogs99_social_links_block() {
  global $base_path;
  $theme_path = $base_path . '/' . drupal_get_path('theme', 'blogs99');
  $twitter = theme_get_setting('twitter', 'blogs99');
  $facebook = theme_get_setting('facebook', 'blogs99');
  $feed = theme_get_setting('feed', 'blogs99');
  $linkedin = theme_get_setting('linkedin', 'blogs99');
  $output = '<ul id="follow-icon">';
  if ((theme_get_setting('twitter', 'blogs99'))):
    $output .= '<li>';
    $output .= l("<img src=" . $theme_path . "/images/twitter.png>", $twitter, array('attributes' => array('title' => t('twitter'), 'target' => '_blank'), 'html' => TRUE));
    $output .= '</li>';
  endif;
  if ((theme_get_setting('facebook', 'blogs99'))):
    $output .= '<li>';
    $output .=  l("<img src=" . $theme_path . "/images/facebook.png>", $facebook, array('attributes' => array('title' => t('facebook'), 'target' => '_blank'), 'html' => TRUE));
    $output .= '</li>';
  endif;
  if ((theme_get_setting('linkedin', 'blogs99'))):
    $output .= '<li>';
    $output .= l("<img src=" . $theme_path . "/images/linkedin.png>", $linkedin, array('html' => TRUE, 'attributes' => array('title' => t('linkedin'), 'target' => '_blank')));
    $output .= '</li>';
  endif;
  $output .= '</ul>';
  print $output;
}

/**
 * Social Media Links.
 */
function blogs99_about_display_block() {
  $output = '<div class="block block-block-about">';
  if ((theme_get_setting('twitter', 'blogs99'))):
    $output .= '<h2>';
    $output .= theme_get_setting('about_title', 'blogs99');
    $output .= '</h2>';
  endif;
  if ((theme_get_setting('twitter', 'blogs99'))):
    $output .= '<div class="content">';
    $output .= theme_get_setting('about_text', 'blogs99');
    $output .= '</div>';
  endif;
  $output .= '</div>';
  print $output;
}

/**
 * Adding CSS.
 */
function blogs99_preprocess_page(&$vars) {
  $theme_path = drupal_get_path('theme', 'blogs99');
  drupal_add_css($theme_path . '/css/themes/' . theme_get_setting('blogs99_style') . '.css', 'theme');
  $vars['styles'] = drupal_get_css();
}
