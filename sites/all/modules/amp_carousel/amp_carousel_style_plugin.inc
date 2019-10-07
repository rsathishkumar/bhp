<?php

/**
 * @file
 * Demonstrate the actual plugin options.
 */

/**
 * Implements views_plugin_style().
 */
class amp_carousel_style_plugin extends views_plugin_style {

  /**
   * Set default options.
   */
  public function option_definition() {
    $options = parent::option_definition();

    $options['layout'] = array('default' => 'responsive');
    $options['type'] = array('default' => 'slides');
    $options['autoplay'] = array('default' => 'off');
    $options['delay'] = array('default' => '0');
    $options['width'] = array('default' => '1024');
    $options['height'] = array('default' => '576');

    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    $form['type'] = array(
      '#title' => t('Type'),
      '#type' => 'select',
      '#options' => array('carousel' => t('carousel'), 'slides' => t('slides')),
      '#default_value' => $this->options['type'],
    );
    $form['layout'] = array(
      '#title' => t('Layout'),
      '#type' => 'select',
      '#options' => array('fixed-height' => t('fixed-height'), 'responsive' => t('responsive')),
      '#default_value' => $this->options['layout'],
    );
    $form['autoplay'] = array(
      '#title' => t('Autoplay'),
      '#type' => 'select',
      '#options' => array('off' => t('Off'), 'autoplay' => t('On')),
      '#default_value' => $this->options['autoplay'],
      '#prefix' => '<div id="amp-carousel-autoplay-setting">',
      '#suffix' => '</div>',
    );
    $form['delay'] = array(
      '#title' => t('Delay'),
      '#type' => 'textfield',
      '#default_value' => $this->options['delay'],
      '#states' => array(
        'invisible' => array(
          '#amp-carousel-autoplay-setting select' => array(
            'value' => 'off',
          ),
        ),
      ),
    );
    $form['width'] = array(
      '#title' => t('Width'),
      '#type' => 'textfield',
      '#default_value' => $this->options['width'],
      '#required' => TRUE,
    );
    $form['height'] = array(
      '#title' => t('Height'),
      '#type' => 'textfield',
      '#default_value' => $this->options['height'],
      '#required' => TRUE,
    );
  }

}
