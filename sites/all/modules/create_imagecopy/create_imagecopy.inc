<?php

function _create_imagecopy_print_formatted ($obj) {
  echo '<pre>';
  print_r ($obj);
  echo '</pre>';
}

function _teambhp_get_cities($nid) {
  $stat = db_select('team_bhp_variant_price', 'vp')
            ->fields('vp')
            ->condition('nid', $nid)
            ->execute();
  $results = array();
  
  while($row = $stat->fetchObject()) {
    $results[] = $row;
  }
  
  return ($results);
}


function _create_imagecopy_node_update_node_variant_prices($node, $prices) {
  print_r($node->field_gallery_image);
exit;
}

