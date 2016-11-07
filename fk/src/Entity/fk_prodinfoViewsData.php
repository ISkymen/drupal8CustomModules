<?php

/**
 * @file
 * Contains \Drupal\fk\Entity\fk_prodinfo.
 */

namespace Drupal\fk\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Fk_prodinfo entities.
 */
class fk_prodinfoViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['fk_prodinfo']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Fk_prodinfo'),
      'help' => $this->t('The Fk_prodinfo ID.'),
    );

    return $data;
  }

}
