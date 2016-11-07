<?php

/**
 * @file
 * Contains \Drupal\fk\Entity\fk_market.
 */

namespace Drupal\fk\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Fk_market entities.
 */
class fk_marketViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['fk_market']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Fk_market'),
      'help' => $this->t('The Fk_market ID.'),
    );

    return $data;
  }

}
