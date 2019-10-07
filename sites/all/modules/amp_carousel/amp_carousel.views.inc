<?php

/**
 * @file
 * Settings for the style of this plugin.
 */

/**
 * Implements hook_views_plugins().
 */
function amp_carousel_views_plugins() {
  return array(
    'style' => array(
      'amp_carousel' => array(
        'title' => t('AMP Carousel'),
        'help' => t('Display an amp-carousel component for images.'),
        'help topic' => 'style-amp-carousel',
        'handler' => 'amp_carousel_style_plugin',
        'uses options' => TRUE,
        'uses row plugin' => TRUE,
        'uses row class' => TRUE,
        'uses fields' => TRUE,
        'type' => 'normal',
        'theme' => 'views_view_amp_carousel',
        'theme path' => drupal_get_path('module', 'amp_carousel') . '/theme',
        'theme file' => 'amp_carousel.theme.inc',
      ),
    ),
  );
}
