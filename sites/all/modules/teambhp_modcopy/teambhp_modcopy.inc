<?php

function teambhp_modcopy_form_node_form_alter_features(&$form, &$form_state, $form_id) {
 $found = FALSE;
  $curNodeType = $form['type']['#value'];
  foreach(teambhp_modcopy_config::$Nodetype as $nodeType) {
    if($nodeType == $curNodeType) {
      $found = TRUE;
      break;
    }
  }
  
  if(!$found) {
    return;
  }
  
  $features = json_encode(teambhp_modcopy_config::$features);
  
  //_teambhp_mod_print_formatted($form);
  drupal_add_library('system', 'ui.dialog');
  drupal_add_js(drupal_get_path('module', 'teambhp_modcopy') . '/js/features.js');
  drupal_add_css(drupal_get_path('module', 'teambhp_modcopy') . '/css/variant.price.css');
  drupal_add_js("Features.initialize();", 'inline');

  $nid = $form['nid']['#value'];
  //echo $nid;
  
  $features = array();
  if($nid) {
    $features = _teambhp_get_features($nid);
  }
  
  
  $form['teambhp_features'] = array (
      '#type' => 'fieldset',
      '#title' => 'Custom Fields',
      '#collapsible' => TRUE,
      '#weight' => teambhp_modcopy_config::$weight,
    );

  $form['teambhp_features']['teambhp_features_non_numeric'] = array (
    '#type' => 'markup',
    '#markup' => '<div id="teambhp_features_non_numeric" style="display: none">Please enter values for monetary fields.</div>',
  );

  $form['teambhp_features']['teambhp_features_hidden'] = array (
    '#type' => 'hidden',
    '#default_value' => json_encode($features),
  );
  
  $form['#submit'][] = 'teambhp_modcopy_form_node_form_alter_features_submit';
}

function teambhp_modcopy_form_node_form_alter_features_submit($form, &$form_state) {
	$features = json_decode($form_state['values']['teambhp_features_hidden']);
	drupal_static('teambhp_modcopy_form_node_form_alter_features_submit', $features);  
  }

function teambhp_modcopy_node_insert_features($node) {
  $features = &drupal_static('teambhp_modcopy_form_node_form_alter_features_submit');
  _teambhp_modcopy_node_update_node_features($node, $features);
}

function teambhp_modcopy_node_update_features($node) {
  $features = &drupal_static('teambhp_modcopy_form_node_form_alter_features_submit');
  _teambhp_modcopy_node_update_node_features($node, $features);
}
