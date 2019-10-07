<?php

function _teambhp_update_print_formatted ($obj) {
  echo '<pre>';
  print_r ($obj);
  echo '</pre>';
}

function _teambhp_get_model($nid) {
  $stat = db_select('node', 'vp')
            ->fields('title')
            ->condition('nid', $nid)
            ->execute();
  $results = array();
  
  while($row = $stat->fetchObject()) {
    $results[] = $row;
  }
  
  return ($results);
}


/*function _teambhp_update_node_update_node_variant_prices($node, $prices) {
  $existing_prices = _teambhp_get_cities($node->nid);

  $i = 0;
  for(; $i < count($existing_prices) && $i < count($prices); $i++) {
    $updated = $prices[$i];
    
    $existing = $existing_prices[$i];
    $id = $existing->id;
    
    db_update('team_bhp_variant_price')
      ->fields(array(
          'city' => $updated->city,
          'on_road_price' => $updated->on_road_price,
          'ex_showroom_price' => $updated->ex_showroom_price,
          'taxes' => $updated->taxes,
          'insurance' => $updated->insurance
        ))
      ->condition('id', $id)
      ->execute();
  }

  for($j = $i; $j < count($prices); $j++) {
    $updated = $prices[$j];
    
    db_insert('team_bhp_variant_price')
      ->fields(array(
          'nid' => $node->nid,
          'city' => $updated->city,
          'on_road_price' => $updated->on_road_price,
          'ex_showroom_price' => $updated->ex_showroom_price,
          'taxes' => $updated->taxes,
          'insurance' => $updated->insurance
        ))
      ->execute();
  }

  for($k = $i; $k < count($existing_prices); $k++) {
    $existing = $existing_prices[$k];
    $id = $existing->id;
    
    
    db_delete('team_bhp_variant_price')
      ->condition('id', $id)
      ->execute();
  }
}*/
