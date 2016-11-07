<?php

/**
 * @file
 * Contains \Drupal\fk\fk_purchaseListBuilder.
 */

namespace Drupal\fk;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Fk_purchase entities.
 *
 * @ingroup fk
 */
class fk_purchaseListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Fk_purchase ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\fk\Entity\fk_purchase */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.fk_purchase.edit_form', array(
          'fk_purchase' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
