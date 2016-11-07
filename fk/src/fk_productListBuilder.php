<?php

/**
 * @file
 * Contains \Drupal\fk\fk_productListBuilder.
 */

namespace Drupal\fk;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Fk_product entities.
 *
 * @ingroup fk
 */
class fk_productListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Fk_product ID');
    $header['barcode'] = $this->t('Barcode');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\fk\Entity\fk_product */
    $row['id'] = $entity->id();
    $row['barcode'] = $this->l(
      $entity->getBarcode(),
      new Url(
        'entity.fk_product.edit_form', array(
          'fk_product' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
