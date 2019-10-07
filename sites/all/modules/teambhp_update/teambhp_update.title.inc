<?php

function teambhp_update_form_node_form_alter_variant_prices(&$form, &$form_state, $form_id) {
        
  $found = FALSE;	
  $curNodeType = $form['type']['#value'];
   if($curNodeType == 'gallery-images') {
      $found = TRUE;
      break;
    }
   
  if(!$found) {
    return;
  }
  
}

function teambhp_update_form_node_form_alter_variant_prices_submit($form, &$form_state) {
echo "0";
exit;
 //$prices = json_decode($form_state['values']['teambhp_variant_price_hidden']);

 // drupal_static('teambhp_update_form_node_form_alter_variant_prices_submit', $prices);  
}

function teambhp_update_node_insert_variant_prices($node) {
echo "1";
exit;
  //$prices = &drupal_static('teambhp_update_form_node_form_alter_variant_prices_submit');
  //_teambhp_update_node_update_node_variant_prices($node, $prices);
}

function teambhp_update_node_update_variant_prices($node) {
echo "2";
exit;
  $prices = &drupal_static('teambhp_update_form_node_form_alter_variant_prices_submit');
 // _teambhp_update_node_update_node_variant_prices($node, $prices);
}
