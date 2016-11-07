<?php

/**
 * @file
 * Contains \Drupal\fk\fk_prodinfoListBuilder.
 */

namespace Drupal\fk;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Fk_prodinfo entities.
 *
 * @ingroup fk
 */
class fk_prodinfoListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Fk_prodinfo ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\fk\Entity\fk_prodinfo */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.fk_prodinfo.edit_form', array(
          'fk_prodinfo' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
