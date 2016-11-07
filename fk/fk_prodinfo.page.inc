<?php

/**
 * @file
 * Contains fk_prodinfo.page.inc..
 *
 * Page callback for Fk_prodinfo entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Fk_prodinfo templates.
 *
 * Default template: fk_prodinfo.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_fk_prodinfo(array &$variables) {
  // Fetch fk_prodinfo Entity Object.
  $fk_prodinfo = $variables['elements']['#fk_prodinfo'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
