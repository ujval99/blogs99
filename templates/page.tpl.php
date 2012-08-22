<?php

/**
 * @file
 * blogs99's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system folder.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/blogs99.
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
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
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
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see blogs99_process_page()
 */
?>
<div id="page-wrapper">
  <div id="page">
    <div id="main-wrapper" class="clearfix">
      <div id="main" class="clearfix">
        
        <!-- footer_text-and-searchblock-and-social_links_block -->
        <?php if (overlay_get_mode() <>'child'): ?> 
          <div class="page-fix">
            <div class="page-fix-0">
              <?php if (theme_get_setting('footer_show', 'blogs99')): print theme_get_setting('footer_text', 'blogs99'); endif; ?>
            </div>
            <div class="page-fix-1">
              <?php if (theme_get_setting('display', 'blogs99')): blogs99_social_links_block(); endif; ?>
              <div class="searchblock">  
                <?php 
                    $block = module_invoke('search', 'block_view', 'form'); 
                    print render($block); 
                ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <!-- /footer_text-and-searchblock-and-social_links_block -->
        
        <div id="sidebar-first" class="column sidebar">
          <div class="section">
            <?php if ($logo): ?> <!-- logo -->
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
                <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
              </a>
            <?php endif; ?> <!-- /logo -->

            <?php if ($site_name || $site_slogan): ?> <!-- site_name-and-site_slogan -->
              <div id="name-and-slogan"<?php if ($hide_site_name && $hide_site_slogan) : print ' class="element-invisible"'; endif; ?>>
                <?php if ($site_name): ?>
                  <?php if ($title): ?>
                    <div id="site-name"<?php if ($hide_site_name) :  print ' class="element-invisible"'; endif; ?>>
                      <strong>
                        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
                      </strong>
                    </div>
                  <?php else: /* Use h1 when the content title is empty */ ?>
                    <h1 id="site-name"<?php if ($hide_site_name) : print ' class="element-invisible"'; endif; ?>>
                      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
                    </h1>
                  <?php endif; ?>
                <?php endif; ?>

                <?php if ($site_slogan): ?>
                  <div id="site-slogan"<?php if ($hide_site_slogan) : print ' class="element-invisible"'; endif; ?>>
                    <?php print $site_slogan; ?>
                  </div>
                <?php endif; ?>
              </div> 
            <?php endif; ?> <!-- /site_name-and-site_slogan -->
        
            <?php if ($main_menu): ?> <!-- main-menu -->
              <div id="main-menu" class="navigation">
                <?php print theme('links__system_main_menu', array(
                  'links' => $main_menu,
                  'attributes' => array(
                    'id' => 'main-menu-links',
                    'class' => array('links', 'clearfix'),
                  ),
                  'heading' => array(
                    'text' => t('Main menu'),
                    'level' => 'h2',
                    'class' => array('element-invisible'),
                  ),
                )); ?>
              </div> 
            <?php endif; ?> <!-- /main-menu -->
          
            <?php if (theme_get_setting('about_display', 'blogs99')):  
                    blogs99_about_display_block();
                  endif;
            ?>
          
            <?php print render($page['sidebar_first']); ?>
          </div>
        </div> <!-- /section, /sidebar-first -->

        <div id="content" class="column">

          <?php if ($secondary_menu): ?>
            <div class="t-wrapper">
              <div class="t-data">   
                <div id="secondary-menu" class="navigation">
                  <?php print theme('links__system_secondary_menu', array(
                    'links' => $secondary_menu,
                    'attributes' => array(
                      'id' => 'secondary-menu-links',
                      'class' => array('links', 'inline', 'clearfix'),
                    ),
                    'heading' => array(
                      'text' => t('Secondary menu'),
                      'level' => 'h2',
                      'class' => array('element-invisible'),
                    ),
                  )); ?>
                </div> <!-- /secondary-menu -->
              </div>
            </div>
          <?php endif; ?>    
 
          <?php if ($messages): ?>
            <div id="messages"><div class="section clearfix">
              <?php print $messages; ?>
            </div></div> <!-- /section, /messages -->
          <?php endif; ?>
   
          <div class="section">
            <?php if ($breadcrumb): ?>
              <div id="breadcrumb"><?php print $breadcrumb; ?></div>
            <?php endif; ?>
      

            <?php print render($title_prefix); ?>
            <?php if ($title): ?>
              <h1 class="title" id="page-title">
                <?php print $title; ?>
              </h1>
            <?php endif; ?>
            <?php print render($title_suffix); ?>
            <?php if ($tabs): ?>
              <div class="tabs">
                <?php print render($tabs); ?>
              </div>
            <?php endif; ?>
            <?php print render($page['help']); ?>
            <?php if ($action_links): ?>
              <ul class="action-links">
                <?php print render($action_links); ?>
              </ul>
            <?php endif; ?>
            <?php print render($page['content']); ?>
            <?php print $feed_icons; ?>
          </div>
        </div> 
      </div> <!-- /main -->
    </div> <!--  /main-wrapper -->
  </div><!-- /page -->
</div> <!-- /page-wrapper -->
