<?php

/**
 * Preprocess all templates.
 */
function bmp_ampsubtheme_preprocess(&$vars, $hook) {
  $vars['ampsubtheme_path_file'] = DRUPAL_ROOT . '/' . drupal_get_path('theme', 'bmp_ampsubtheme');
}

/**
 * Implements hook_preprocess_HOOK() for HTML document templates.
 *
 * Example of a preprocess hook for a subtheme that could be used to change
 * variables in templates in order to support custom styling of AMP pages.
 */
function bmp_ampsubtheme_preprocess_html(&$variables) {
  $res = array(
    '#tag' => 'script',
    '#attributes' => array(
   //   'src' => 'https://cdn.ampproject.org/v0/amp-carousel-0.1.js',
     // 'custom-element' =>"amp-carousel",
      'async' => 'async'
    ),
  );
  drupal_add_html_head($res, 'amp_carousel');

}

function bmp_ampsubtheme_preprocess_page(&$vars) {
  $links = menu_tree_output(menu_tree_all_data(variable_get('menu_main_links_source', 'main-menu')));
  $amp_all_links = '';
  foreach ($links as $key => $value) {
    if (isset($links[$key]['#title']) && isset($links[$key]['#href'])) {
      $title_link = $links[$key]['#title'];
      $url = url(drupal_get_path_alias($links[$key]['#href']));

      $amp_all_links .= '<li class="menu-item"><a href="' . $url . '">' . $title_link . '</a></li>';
    }
  }

  $prefix_amp_sidebar = '<amp-sidebar id="sidebar" layout="nodisplay" side="left" data-close-button-aria-label="X"><ul class="amp-sidebar-menu">';
  $suffix_amp_sidebar = '</ul></amp-sidebar>';
  $amp_sidebar = $prefix_amp_sidebar . $amp_all_links  . $suffix_amp_sidebar;
  $vars['amp_sidebar'] = $amp_sidebar;
}

function bmp_ampsubtheme_preprocess_node(&$vars) {
  $vars['time_ago'] = '';
  if ($vars['type'] == 'news') {
    $created = $vars['created'];
    $time_ago = time_elapsed_string(date('Y-m-d H:i:s', $created));
    $vars['time_ago'] = $time_ago;
  }
}

function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
    'y' => 'year',
    'm' => 'month',
    'w' => 'week',
    'd' => 'day',
    'h' => 'hour',
    'i' => 'minute',
    's' => 'second',
  );
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}