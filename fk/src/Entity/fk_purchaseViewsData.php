<?php

/**
 * @file
 * Contains \Drupal\fk\Entity\fk_purchase.
 */

namespace Drupal\fk\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Fk_purchase entities.
 */
class fk_purchaseViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['fk_purchase']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Fk_purchase'),
      'help' => $this->t('The Fk_purchase ID.'),
    );

    return $data;
  }

}
