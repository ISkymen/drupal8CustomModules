<?php

/**
 * @file
 * Contains fk_market.page.inc..
 *
 * Page callback for Fk_market entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Fk_market templates.
 *
 * Default template: fk_market.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_fk_market(array &$variables) {
  // Fetch fk_market Entity Object.
  $fk_market = $variables['elements']['#fk_market'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
