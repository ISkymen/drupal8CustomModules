<?php

/**
 * @file
 * Contains fk_product.page.inc..
 *
 * Page callback for Fk_product entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Fk_product templates.
 *
 * Default template: fk_product.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_fk_product(array &$variables) {
  // Fetch fk_product Entity Object.
  $fk_product = $variables['elements']['#fk_product'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
