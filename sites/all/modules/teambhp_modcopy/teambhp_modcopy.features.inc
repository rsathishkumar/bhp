<?php

function _teambhp_modcopy_print_formatted ($obj) {
  echo '<pre>';
  print_r ($obj);
  echo '</pre>';
}

function _teambhp_get_features($nid) {
  $stat = db_select('team_bhp_features', 'vp')
            ->fields('vp')
            ->condition('nid', $nid)
            ->execute();
  $results = array();
  
  while($row = $stat->fetchObject()) {
    $results[] = $row;
  }
  
  return ($results);
}


function _teambhp_modcopy_node_update_node_features($node, $features) {

 $existing_features = _teambhp_get_features($node->nid);
  $i = 0;
   for(; $i < count($existing_features) && $i < count($features); $i++) {
    $updated = $features[$i];
   
    $existing = $existing_features[$i];
  //  print_r($existing);
    $id = $existing->id;
    
    db_update('team_bhp_features')
      ->fields(array(
      	  'category' => $updated->category,
          'feature_name' => $updated->feature_name,
          'feature_option' => $updated->feature_options
        ))
      ->condition('id', $id)
      ->execute();
   
  }

  for($j = $i; $j < count($features); $j++) {
  
    $updated = $features[$j];
   //  print_r($updated);
  //echo  $sql="insert into team_bhp_features values(NULL,$node->nid,'".$updated->feature_name."','".$updated->feature_options."')";
  //exit;
    db_insert('team_bhp_features')
      ->fields(array(
          'nid' => $node->nid,
          'category' => $updated->category,
          'feature_name' => $updated->feature_name,
          'feature_option' => $updated->feature_options
        ))
      ->execute();
  }

  for($k = $i; $k < count($existing_features); $k++) {
    $existing = $existing_features[$k];
    $id = $existing->id;
    db_delete('team_bhp_features')
      ->condition('id', $id)
      ->execute();
  }
}


