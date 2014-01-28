<?php
/**
 * @file
 * assessment_node_form.tpl.php
 */
global $base_path, $base_url;
//echo '<pre>';
//print_r($form);
//echo '</pre>';
?>

<h1>Add/Edit an Assessment</h1>
<div class="wd_1 aeassessment_page">
  <div class="form-item_custum"> <?php print drupal_render($form['field_primary_service']); ?>
    <label id="primary_service_amount" class="label_item">
      <?php //print '$' . $form['#node']->field_primary_service_amount['und'][0]['value']; ?>
    </label>
  </div>
  <div class="form-item_custum" style='display:none;'> <?php print drupal_render($form['field_primary_service_amount']); ?> </div>
  <!--
    <div class="form-item_custum">
        <label id="primary_service_amount">
            <?php //print '$' . $form['#node']->field_primary_service_amount['und'][0]['value']; ?>
        </label>
    </div>
	-->
  <div class="form-item_custum"> <?php print drupal_render($form['field_assessment_title']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_online_questionnaire']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_upload_questionnaire']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_assessment_status']); ?> </div>
  <div class="dotted_hr"></div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_service_one']); ?>
    <label id="primary_service_amount_one" class="label_item"> <?php print '$' . $form['#node']->field_rush_order_amount_one['und'][0]['value']; ?> </label>
  </div>
  <div class="form-item_custum" style='display:none;'> <?php print drupal_render($form['field_rush_order_amount_one']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_title_one']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_status_one']); ?> </div>
  <div class="dotted_hr"></div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_service_two']); ?>
    <label id="primary_service_amount_two" class="label_item"> <?php print '$' . $form['#node']->field_rush_order_amount_two['und'][0]['value']; ?> </label>
  </div>
  <div class="form-item_custum" style='display:none;'> <?php print drupal_render($form['field_rush_order_amount_two']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_title_two']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_status_two']); ?> </div>
  <div class="dotted_hr"></div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_service_three']); ?>
    <label id="primary_service_amount_three" class="label_item"> <?php print '$' . $form['#node']->field_rush_order_amount_three['und'][0]['value']; ?> </label>
  </div>
  <div class="form-item_custum" style='display:none;'> <?php print drupal_render($form['field_rush_order_amount_three']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_title_three']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_status_three']); ?> </div>
  <div class="dotted_hr"></div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_service_four']); ?>
    <label id="primary_service_amount_four" class="label_item"> <?php print '$' . $form['#node']->field_rush_order_amount_four['und'][0]['value']; ?> </label>
  </div>
  <div class="form-item_custum" style='display:none;'> <?php print drupal_render($form['field_rush_order_amount_four']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_title_four']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['field_rush_order_status_four']); ?> </div>
  
  <!-- Assessment Description field added START -->
  <div class="dotted_hr"></div>
  <div class="form-item_custum"> <?php print str_replace('Switch to plain text editor', '', drupal_render($form['field_asmentinfo_section_one'])); ?> </div>
  <div class="form-item_custum"> <?php print str_replace('Switch to plain text editor', '', drupal_render($form['field_service_description'])); ?> </div>
  <div class="form-item_custum"> <?php print str_replace('Switch to plain text editor', '', drupal_render($form['field_asmentinfo_section_two'])); ?> </div>
  <div class="form-item_custum"> <?php print str_replace('Switch to plain text editor', '', drupal_render($form['field_asmentinfo_section_three'])); ?> </div>
  <div class="form-item_custum"> <?php print str_replace('Switch to plain text editor', '', drupal_render($form['field_asmentinfo_section_four'])); ?> </div>
  <div class="form-item_custum"> <?php print str_replace('Switch to plain text editor', '', drupal_render($form['field_assessment_right_image'])); ?> </div>
  <!-- Assessment Description field added END -->
  
  <div class="dotted_hr"></div>
  <div class="form-item_custum"> <?php print drupal_render($form['meta_keywords']); ?> </div>
  <div class="form-item_custum"> <?php print drupal_render($form['meta_description']); ?> </div>
  <div style='display:inline;'>
    <?php
        //  Use to render the drupal 7 form
        print drupal_render_children($form);
        ?>
    <?php
//            echo '<pre>';
//            print_r($form);
//            echo '</pre>';
        ?>
  </div>
  <div class="form-item_custum"> <?php print drupal_render($form['actions']['submit']); ?> </div>
</div>
<script>
jQuery(document).ready(function() {
  jQuery('#edit-field-primary-service-und').unbind('change');
  jQuery('#edit-field-primary-service-und').bind('change',function() {
    var postdata = jQuery('#edit-field-primary-service-und').val();
    var idval = 'primary_service_amount';
    var idval_txt_box = 'edit-field-primary-service-amount-und-0-value';
    ajaxRequest(postdata, idval, idval_txt_box);
  });

  jQuery('#edit-field-rush-order-service-one-und').unbind('change');
  jQuery('#edit-field-rush-order-service-one-und').bind('change',function() {
    var postdata = jQuery('#edit-field-rush-order-service-one-und').val();
    var idval = 'primary_service_amount_one';
    var idval_txt_box = 'edit-field-rush-order-amount-one-und-0-value';
    ajaxRequest(postdata, idval, idval_txt_box);
  });

  jQuery('#edit-field-rush-order-service-two-und').unbind('change');
  jQuery('#edit-field-rush-order-service-two-und').bind('change',function() {
    var postdata = jQuery('#edit-field-rush-order-service-two-und').val();
    var idval = 'primary_service_amount_two';
    var idval_txt_box = 'edit-field-rush-order-amount-two-und-0-value';
    ajaxRequest(postdata, idval, idval_txt_box);
  });

  jQuery('#edit-field-rush-order-service-three-und').unbind('change');
  jQuery('#edit-field-rush-order-service-three-und').bind('change',function() {
    var postdata = jQuery('#edit-field-rush-order-service-three-und').val();
    var idval = 'primary_service_amount_three';
    var idval_txt_box = 'edit-field-rush-order-amount-three-und-0-value';
    ajaxRequest(postdata, idval, idval_txt_box);
  });

  jQuery('#edit-field-rush-order-service-four-und').unbind('change');
  jQuery('#edit-field-rush-order-service-four-und').bind('change',function() {
    var postdata = jQuery('#edit-field-rush-order-service-four-und').val();
    var idval = 'primary_service_amount_four';
    var idval_txt_box = 'edit-field-rush-order-amount-four-und-0-value';
    ajaxRequest(postdata, idval, idval_txt_box);
  }); 
});    

function ajaxRequest(postdata, idval, idval_txt_box) {
  // Fire the ajax request
  jQuery.ajax({
    url: '<?php print $base_url; ?>/assessment/getprice',
    type: 'post',
    data: { postdata: postdata },
    success: function(response) {
      jQuery('#'+idval).html('$'+response);
      jQuery('#'+idval_txt_box).val(response);
    }
  });
}    
</script>