<?php

/**
 * @file
 * Contains fk_purchase.page.inc..
 *
 * Page callback for Fk_purchase entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Fk_purchase templates.
 *
 * Default template: fk_purchase.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_fk_purchase(array &$variables) {
  // Fetch fk_purchase Entity Object.
  $fk_purchase = $variables['elements']['#fk_purchase'];
                              
  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
