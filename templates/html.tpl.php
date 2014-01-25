<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr'
 *   or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see coeus_preprocess_html()
 * @see coeus_preprocess_html_tag()
 * @see coeus_html_head_alter()
 * @see coeus_process_html()
 */
?>
<!DOCTYPE html>
<html
<?php print $html_attributes; ?>
<?php print $rdfa_namespaces; ?>>
<head>
<?php print $head; ?>
<?php print $styles; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
<div id="skip-link"><a href="#main-content" class="clear"><?php print t('Skip to content'); ?></a>
</div>
<?php print $page_top; ?>
<?php print $page; ?>
<section id="scripts">
<?php print $scripts; ?>
</section>
<?php print $page_bottom; ?>
</body>
</html>
