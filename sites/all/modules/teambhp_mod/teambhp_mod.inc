<?php

function _teambhp_mod_print_formatted ($obj) {
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


function _teambhp_mod_node_update_node_variant_prices($node, $prices) {
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
}

function bhp_news_callback() {
  try {
    _bhp_headers();
	
	ob_start();
	include(drupal_get_path('theme', 'bhp') . '/includes/price.inc');
	$returned = ob_get_contents();
	ob_end_clean();
	
	die($returned);
  }
  catch (Exception $e) {
    die($e->getMessage() + "\n" + $e->getTraceAsString());
  }
}

function bhp_news_list_callback() {
  try {
    _bhp_headers();
	
	ob_start();
  global $theme_key;
    if(!$theme_key){
        $theme_key = 'bhp';
    }
	include(drupal_get_path('theme', $theme_key) . '/news.inc');
	$returned = ob_get_contents();
	ob_end_clean();
	
	die($returned);
  }
  catch (Exception $e) {
    die($e->getMessage() + "\n" + $e->getTraceAsString());
  }
}

function bhp_session_callback() {
  try {
    _bhp_headers();
	
	ob_start();
	include(drupal_get_path('theme', 'bhp') . '/includes/setSession.inc');
	$returned = ob_get_contents();
	ob_end_clean();
	
	die($returned);
  }
  catch (Exception $e) {
    die($e->getMessage() + "\n" + $e->getTraceAsString());
  }
}

function bhp_hotthread_callback() {
  try {
    _bhp_headers();
	
	ob_start();
    global $theme_key;
      if(!$theme_key){
          $theme_key = 'bhp';
      }
	include(drupal_get_path('theme', $theme_key) . '/hotthread.inc');
	$returned = ob_get_contents();
	ob_end_clean();
	
	die($returned);
  }
  catch (Exception $e) {
    die($e->getMessage() + "\n" + $e->getTraceAsString());
  }
}

function bhp_advice_callback() {
  try {
    _bhp_headers();
	
	ob_start();
	global $theme_key;
  if(!$theme_key){
      $theme_key = 'bhp';
  }
	include(drupal_get_path('theme', $theme_key) . '/advice.inc');
	$returned = ob_get_contents();
	ob_end_clean();
	
	die($returned);
  }
  catch (Exception $e) {
    die($e->getMessage() + "\n" + $e->getTraceAsString());
  }
}

function bhp_rss_feed() {
  try {
    _bhp_headers();
	
	ob_start();
	include(drupal_get_path('theme', 'bhp') . '/rss-feed.inc');
	$returned = ob_get_contents();
	ob_end_clean();
	
	die($returned);
  }
  catch (Exception $e) {
    die($e->getMessage() + "\n" + $e->getTraceAsString());
  }
}

function bhp_techstuff_callback() {
  try {
    _bhp_headers();
	
	ob_start();
  global $theme_key;
  if(!$theme_key){
      $theme_key = 'bhp';
  }
	include(drupal_get_path('theme', $theme_key) . '/tech-stuff.inc');
	$returned = ob_get_contents();
	ob_end_clean();
	
	die($returned);
  }
  catch (Exception $e) {
    die($e->getMessage() + "\n" + $e->getTraceAsString());
  }
}

function bhp_safety_callback() {
  try {
    _bhp_headers();
	
	ob_start();
	  global $theme_key;
    if(!$theme_key){
        $theme_key = 'bhp';
    }
	include(drupal_get_path('theme', $theme_key) . '/safety.inc');
	$returned = ob_get_contents();
	ob_end_clean();
	
	die($returned);
  }
  catch (Exception $e) {
    die($e->getMessage() + "\n" + $e->getTraceAsString());
  }
}

function _bhp_headers() {
  header("Content-type: text/html");
  header("Expires: Wed, 29 Jan 1975 04:15:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
}
