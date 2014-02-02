<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
global $user, $base_url;
$assessment_node = get_assessment_information(arg(1));
$nid_array = array();
foreach ($assessment_node as $data) {
  $nid_array[] = $data->nid;
}

// Load the node data so we can call it later using $result->...
$result_node = node_load_multiple($nid_array);
foreach($result_node as $node_data) {
  $result = $node_data;
}
$link_path = drupal_lookup_path('alias', "node/".$result->nid);

/**
 * Setup of Variables
 *
 * Instead of calling each field's value in long-form 
 * (ie field_name['und'][0]['value']), we setup a variable where we only need
 * to name the field.
 */
$section_one = $result->field_asmentinfo_section_one['und'][0]['value'];
$section_two = $result->field_asmentinfo_section_two['und'][0]['value'];
$section_three = $result->field_asmentinfo_section_three['und'][0]['value'];
$section_four = $result->field_asmentinfo_section_four['und'][0]['value'];
$service_desc = $result->field_service_description['und'][0]['value'];
if (isset($result->field_assessment_right_image['und'][0]['uri'])) {
  $image_uri = $result->field_assessment_right_image['und'][0]['uri'];
  $image_style_uri = image_style_url('page_images', $image_uri);
}
$assessment_tid = $result->field_primary_service['und'][0]['tid'];
$assessment_nid = $result->nid;
$assessment_price = get_service_amount($assessment_tid);
if ($user->uid <= 0) {
  $redirect_url = $base_url.'/user/login?destination='.$link_path;
}
else {
  $redirect_url = $base_url.'/user/cart/nid/';
  $redirect_url .= $assessment_nid.'/tid/'.$assessment_tid;
}
?>
<div id="node-assessment" class="node clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);

      if (isset($image_uri)) {
        print '<img src="';
        print $image_style_uri;
        print '" class="assessment-img" align="right"'.$attributes.'>';
      }

      if (isset($section_one)) {
        print '<div class="assessment-section-one">'.$section_one.'</div>';
      }

      if ($assessment_price > 0) {
        print '<div class="assessment-price">$ '.$assessment_price;
        print '<div class="assessment-purchase-btn">';
        print '<a href="'.$redirect_url.'" class="grey_btn">Purchase Now</a>';
        print '</div></div>';
      }

      if (isset($service_desc)) {
        print '<div class="service-description">'.$service_desc.'</div>';
      }

      if (isset($section_two)) {
        print '<div class="assessment-section-two">'.$section_two.'</div>';
      }

      if (isset($section_three)) {
        print '<div class="assessment-section-three">'.$section_three.'</div>';
      }

      if (isset($section_four)) {
        print '<div class="assessment-section-four">'.$section_four.'</div>';
      }

      //print render($content);
    ?>
  </div>
</div>