<?php

/**
 * Implements hook_preprocess_html().
 */
function ohio_dui_preprocess_html(&$variables){
  // This function looks for node 1 and only adds the javascript for this.
  // However it can be extended in different ways if required
  if (arg(0) == 'node' && arg(2) == '') {
    if (arg(1) == '78' || arg(1) == '79') {
      drupal_add_js('misc/form.js');
      drupal_add_js('misc/collapse.js');
    }
  }
}

/**
 * Implements hook_preprocess_views_view().
 */
function ohio_dui_preprocess_views_view(&$vars) {
  $view = &$vars['view'];

  // Only work on the user account view
  if ($view->name == 'user_account') {
    // Drupal adds the current page, so all we need is the front page.
    $breadcrumb[] = l('Home','<front>');
    drupal_set_breadcrumb($breadcrumb);
  }
}

/**
 * Implements hook_field_widget_form_alter()
 */
function ohio_dui_form_alter(&$form, &$form_state, $form_id) {
  // Check to make sure we are viewing the user account page view.
  if ($form_id == 'views_form_user_account_page') {
    // Edit the value of the editable field buttons.
    $form['field_name']['0']['actions']['edit']['#value'] = '[Edit]';
    $form['field_gender']['0']['actions']['edit']['#value'] = '[Edit]';
    $form['field_date_of_birth']['0']['actions']['edit']['#value'] = '[Edit]';
    $form['field_address']['0']['actions']['edit']['#value'] = '[Edit]';
    $form['field_phone']['0']['actions']['edit']['#value'] = '[Edit]';
    
    // Hide the 'Save' button since our fields are editable.
    $form['actions']['submit']['#attributes']['class'][] = 'element-invisible';
  }
}