<?php

/**
 * @file views-view-amp-carousel.tpl.php
 * Default simple view template to display a list of rows.
 *
 * - $options : Carousel options and settings.
 * @ingroup views_templates
 */
?>

<?php print '<amp-carousel width="' . check_plain($options['width']) . '" height="' . check_plain($options['height']) . '" layout="' . $options['layout'] . '" type="' . $options['type'] . '"' . ($options['autoplay'] == 'autoplay' ? 'autoplay' : '') . ' delay="' . $options['delay'] . '">'; ?>
  <?php foreach ($rows as $row): ?>
    <?php print $row; ?>
  <?php endforeach; ?>
</amp-carousel>
