<?php

/**
 * @file
 * Contains \Drupal\fk\fk_marketListBuilder.
 */

namespace Drupal\fk;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Fk_market entities.
 *
 * @ingroup fk
 */
class fk_marketListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Fk_market ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\fk\Entity\fk_market */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.fk_market.edit_form', array(
          'fk_market' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
