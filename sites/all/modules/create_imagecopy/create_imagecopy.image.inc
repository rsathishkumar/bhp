<?php

function create_imagecopy_form_node_form_alter_variant_prices(&$form, &$form_state, $form_id) {
        
  $found = FALSE;
  $curNodeType = $form['type']['#value'];
  foreach(create_imagecopy_config::$variantNodeTypes as $nodeType) {
    if($nodeType == $curNodeType) {
      $found = TRUE;
      break;
    }
  }
  
  if(!$found) {
    return;
  }
  
  $cities = json_encode(create_imagecopy_config::$cities);
  
  //_create_imagecopy_print_formatted($form);
  drupal_add_library('system', 'ui.dialog');
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
      '#weight' => create_imagecopy_config::$weight,
    );

  $form['teambhp_variant_price']['teambhp_variant_price_non_numeric'] = array (
    '#type' => 'markup',
    '#markup' => '<div id="teambhp_variant_price_non_numeric" style="display: none">Please enter numeric values for monetary fields.</div>',
  );

  $form['teambhp_variant_price']['teambhp_variant_price_hidden'] = array (
    '#type' => 'hidden',
    '#default_value' => json_encode($prices),
  );
  
  $form['#submit'][] = 'create_imagecopy_form_node_form_alter_variant_prices_submit';
}

function create_imagecopy_form_node_form_alter_variant_prices_submit($form, &$form_state) {
 $prices = json_decode($form_state['values']['teambhp_variant_price_hidden']);

  drupal_static('create_imagecopy_form_node_form_alter_variant_prices_submit', $prices);  
}

function create_imagecopy_node_insert_variant_prices($node) {
  $prices = &drupal_static('create_imagecopy_form_node_form_alter_variant_prices_submit');
  _create_imagecopy_node_update_node_variant_prices($node, $prices);
}

function create_imagecopy_node_update_variant_prices($node) {
  $prices = &drupal_static('create_imagecopy_form_node_form_alter_variant_prices_submit');
  _create_imagecopy_node_update_node_variant_prices($node, $prices);
}
