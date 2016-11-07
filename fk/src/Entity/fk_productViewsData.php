<?php

/**
 * @file
 * Contains \Drupal\fk\Entity\fk_product.
 */

namespace Drupal\fk\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Fk_product entities.
 */
class fk_productViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['fk_product']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Fk_product'),
      'help' => $this->t('The Fk_product ID.'),
    );

    return $data;
  }

}
