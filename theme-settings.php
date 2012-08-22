<?php
/**
 * @file
 * Theme setting callbacks for the blogs99 theme.
 */

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function blogs99_form_system_theme_settings_alter(&$form, &$form_state) {

  $form['blogs99_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Corporate Blue Theme Settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  $form['blogs99_settings']['breadcrumbs'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show breadcrumbs in a page'),
    '#default_value' => theme_get_setting('breadcrumbs', 'blogs99'),
    '#description'   => t("Check this option to show breadcrumbs in page. Uncheck to hide."),
  );

  $form['blogs99_settings']['social'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social Icon'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['blogs99_settings']['social']['display'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Social Icon'),
    '#default_value' => theme_get_setting('display', 'blogs99'),
    '#description'   => t("Check this option to show Social Icon. Uncheck to hide."),
  );
  $form['blogs99_settings']['social']['twitter'] = array(
    '#type' => 'textfield',
    '#title' => t('Twitter URL'),
    '#default_value' => theme_get_setting('twitter', 'blogs99'),
    '#description' => t("Enter your Twitter Profile URL."),
  );
  $form['blogs99_settings']['social']['facebook'] = array(
    '#type' => 'textfield',
    '#title' => t('Facebook URL'),
    '#default_value' => theme_get_setting('facebook', 'blogs99'),
    '#description'   => t("Enter your Facebook Profile URL."),
  );
  $form['blogs99_settings']['social']['linkedin'] = array(
    '#type' => 'textfield',
    '#title' => t('LinkedIn URL'),
    '#default_value' => theme_get_setting('linkedin', 'blogs99'),
    '#description'   => t("Enter your LinkedIn Profile URL."),
  );
  $form['blogs99_settings']['about'] = array(
    '#type' => 'fieldset',
    '#title' => t('Author Infomration Text'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['blogs99_settings']['about']['about_display'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Author Infomration'),
    '#default_value' => theme_get_setting('about_display', 'blogs99'),
    '#description'   => t("Check this option to show Author Infomration. Uncheck to hide."),
  );
  $form['blogs99_settings']['about']['about_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Title'),
    '#default_value' => theme_get_setting('about_title', 'blogs99'),
    '#description'   => t("Enter title for Author Infomration at Left Column."),
  );
  $form['blogs99_settings']['about']['about_text'] = array(
    '#type' => 'textarea',
    '#title' => t('Add Description'),
    '#default_value' => theme_get_setting('about_text', 'blogs99'),
    '#description'   => t("Enter your Description for Author Infomration at Left Column."),
  );
  $form['blogs99_settings']['footer_info'] = array(
    '#type' => 'fieldset',
    '#title' => t('Footer Infomration'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['blogs99_settings']['footer_info']['footer_show'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Footer Infomration'),
    '#default_value' => theme_get_setting('footer_show', 'blogs99'),
    '#description'   => t("Check this option to show Footer Infomration. Uncheck to hide."),
  );
  $form['blogs99_settings']['footer_info']['footer_text'] = array(
    '#type' => 'textfield',
    '#title' => t('Footer'),
    '#default_value' => theme_get_setting('footer_text', 'blogs99'),
    '#description'   => t("Enter title for Footer Infomration at Bottom."),
  );
  $form['blogs99_settings']['style-switcher'] = array(
    '#type' => 'fieldset',
    '#title' => t('Style switcher'),
    '#description' => t('Choose your default style of your simple screen theme'),
    '#prefix' => '<div id="blogs99-style"><div class="blogs99-settings">',
    '#suffix' => '</div></div>',
  );
  $path = drupal_get_path('theme', 'blogs99');
  drupal_add_css($path . '/css/theme_settings.css');

  $style_options = array(
  '669933' => 'Green',
  '7C283F' => 'Crimson',
  '8A3586' => 'Magenta ',
  '01B8F1' => 'Cerulean',
  'F9C222' => 'Yellow',
  );

  if (count(variable_get('blogs99_style_options', array())) == 0) {
    variable_set('blogs99_style_options', $style_options);
  }

  $settings['blogs99_style_options'] = variable_get('blogs99_style_options');
  $options = array();
  foreach ($style_options as $color => $color_name) {
    $color = '_' . $color;
    $class = $color;

    $options[$color] = '<span class="icon ' . $class . '"><span>&nbsp;</span></span>'
    . '<span class="name">'
    . $color_name
    . '</span>';
  }

  $form['blogs99_settings']['style-switcher']['blogs99_style'] = array(
  '#type' => 'radios',
  '#options' => $options,
  '#default_value' => theme_get_setting('blogs99_style', 'blogs99'),
  );
}
