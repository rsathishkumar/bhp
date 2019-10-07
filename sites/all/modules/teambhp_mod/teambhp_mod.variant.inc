<?php

function teambhp_mod_form_node_form_alter_variant_prices(&$form, &$form_state, $form_id) {
        
  $found = FALSE;
  $curNodeType = $form['type']['#value'];
  foreach(teambhp_mod_config::$variantNodeTypes as $nodeType) {
    if($nodeType == $curNodeType) {
      $found = TRUE;
      break;
    }
  }
  
  if(!$found) {
    return;
  }
  
  $cities = json_encode(teambhp_mod_config::$cities);
  
  //_teambhp_mod_print_formatted($form);
  drupal_add_library('system', 'ui.dialog');
  drupal_add_js(drupal_get_path('module', 'teambhp_mod') . '/js/variant.price.js');
  drupal_add_css(drupal_get_path('module', 'teambhp_mod') . '/css/variant.price.css');
  drupal_add_js("Prices.initialize('$cities');", 'inline');

  $nid = $form['nid']['#value'];
  //echo $nid;
  
  $prices = array();
  if($nid) {
    $prices = _teambhp_get_cities($nid);
  }
  
  $form['teambhp_variant_price'] = array (
      '#type' => 'fieldset',
      '#title' => 'Prices',
      '#collapsible' => TRUE,
      '#weight' => teambhp_mod_config::$weight,
    );

  $form['teambhp_variant_price']['teambhp_variant_price_non_numeric'] = array (
    '#type' => 'markup',
    '#markup' => '<div id="teambhp_variant_price_non_numeric" style="display: none">Please enter numeric values for monetary fields.</div>',
  );

  $form['teambhp_variant_price']['teambhp_variant_price_hidden'] = array (
    '#type' => 'hidden',
    '#default_value' => json_encode($prices),
  );
  
  $form['#submit'][] = 'teambhp_mod_form_node_form_alter_variant_prices_submit';
}

function teambhp_mod_form_node_form_alter_variant_prices_submit($form, &$form_state) {
 $prices = json_decode($form_state['values']['teambhp_variant_price_hidden']);

  drupal_static('teambhp_mod_form_node_form_alter_variant_prices_submit', $prices);  
}

function teambhp_mod_node_insert_variant_prices($node) {
  $prices = &drupal_static('teambhp_mod_form_node_form_alter_variant_prices_submit');
  _teambhp_mod_node_update_node_variant_prices($node, $prices);
}

function teambhp_mod_node_update_variant_prices($node) {
  $prices = &drupal_static('teambhp_mod_form_node_form_alter_variant_prices_submit');
  _teambhp_mod_node_update_node_variant_prices($node, $prices);
}
