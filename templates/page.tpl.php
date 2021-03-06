<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $is_front: TRUE if the current page is the front page.
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
 *
 * Regions:
 * - $page['header']: Main content header of the current page.
 * - $page['main_menu']: Main menu region of the site.
 * - $page['user_menu']: User menu region of the site.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar']: Items for the sidebar.
 * - $page['footer']: Items for the footer region.
 *
 * @see html.tpl.php
 */

// Sets up some variables to be used later.
global $user, $base_url;
$logged_in = FALSE;
$developer = FALSE;
$user_name = '';
$account_link = '';
$dev_url = 'http://dev.ohioduieval.com';
$prod_url = 'http://ohioduieval.com';

if ($user->uid) {
  $logged_in = TRUE;
  $user_name = $user->name;
  $account_link = '<a href="' . $base_url . '/user' . '">My Account</a>';
}

if ($user->uid == 5) {
  $developer = TRUE;
  $account_link = '<a href="' . $dev_url . '/user' . '">My Account</a>';
}
?>
<div id="page-container">
  <header id="top-nav" class="clearfix">
    <div id="top-nav-wrapper" class="container_12">
      <div id="client-wrapper">
        <?php if (!$logged_in): ?>
        <div id="login">
          <a href="http://ohioduieval.com/user/login">Login</a>
        </div>
        <?php endif; ?>
        <?php if ($logged_in): ?>
        <div id="client-menu">
          <ul>
            <li><?php print $account_link; ?></li>
            <?php if ($developer): ?>
              <?php if ($base_url == $prod_url): ?>
              <li><a href="<?php print $dev_url; ?>">Dev Site</a></li>
              <?php elseif ($base_url == $dev_url): ?>
              <li><a href="<?php print $prod_url; ?>">Main Site</a></li>
              <?php endif; ?>
            <?php endif; ?>
            <li><a href="<?php print $base_url . '/user/logout'; ?>">Log Out</a></li>
          </ul>
        </div>
        <?php endif; ?>
      </div>
      <div id="branding-wrapper">
        <div id="branding">
        <?php if ($logo): ?>
          <figure id="logo-figure">
            <?php print $site_logo; ?>
          </figure>
        <?php endif; ?>
        <?php if (!$logo): ?>
        <?php print $site_name; ?>
        <?php endif; ?>
        </div>
  
        <div id="navbar">
          <nav id="main-nav">
          <?php if ($page['main_menu']): ?>
          <?php print render($page['main_menu']); ?>
          <?php endif; ?>
          </nav>
        </div>
      </div>
    </div>
  </header>
  
  <section id="page-header" class="container_12 clearfix">
  	<div id="page-title-search" class="grid_12 clearfix">
    	<div id="page-title-wrapper" class="grid_9 alpha">
      	<?php print render($title_prefix); ?>
        <?php //if (arg(0) == 'usera'): ?>
        <!-- <h1 id="page-title"><?php //print $user_name; ?></h1> -->
        <?php //endif; ?>
        <?php //if (arg(0) != 'user'): ?>
      	<h1 id="page-title"><?php print $title; ?></h1>
        <?php ///endif; ?>
      	<?php print render($title_suffix); ?>
    	</div>
      <?php if (module_exists('search')): ?>
    	<div id="search-block-wrapper" class="grid_3 omega">
      	<?php $search_block = module_invoke('search', 'block_view', 'search');
      	print render($search_block); ?>
    	</div>
      <?php endif; ?>
    </div>
    <?php if ($breadcrumb): ?>
      <div id="breadcrumb-wrapper" class="grid_12 clearfix">
        <?php print $breadcrumb; ?>
      </div>
    <?php endif; ?>
  </section>
  
  <?php if ($messages || $page['highlighted'] || $page['help']): ?>
  <section id="highlights" class="container_12 clearfix">

    <?php if ($messages): ?>
      <div id="site-messages"><?php print $messages; ?></div>
    <?php endif; ?>
  
    <?php if ($page['highlighted']): ?>
      <div id="highlighted"><?php print render($page['highlighted']); ?></div>
    <?php endif; ?>
  
    <?php if ($page['help']): ?>
      <div id="help"><?php print render($page['help']); ?></div>
    <?php endif; ?>
  </section>
  <?php endif; ?>
  
  <section id="content-section" class="container_12 clearfix">
    <a id="main-content"></a>
    
    <?php if ($page['header']): ?>
      <div id="content-header"><?php print render($page['header']); ?></div>
    <?php endif; ?>
  
    <?php if ($tabs): ?>
      <div id="tabs"><?php print render($tabs); ?></div>
    <?php endif; ?>
  
    <?php if ($action_links): ?>
      <ul id="action-links"><?php print render($action_links); ?></ul>
    <?php endif; ?>

    <div id="content" class="container_12">
      <?php if (!empty($page['sidebar'])): ?>
        <article id="page-content" class="grid_9 alpha">
          <?php print render($page['content']); ?>
        </article>
        <aside id="sidebar" class="grid_3 omega">
          <?php print render($page['sidebar']); ?>
        </aside>
      <?php endif; ?>
      <?php if (empty($page['sidebar'])): ?>
        <article id="page-content" class="grid_12">
          <?php print render($page['content']); ?>
        </article>
      <?php endif; ?>
    </div>

    <?php print $feed_icons; ?>
  </section>
  
  <?php include('includes/footer.php'); ?>
</div>
