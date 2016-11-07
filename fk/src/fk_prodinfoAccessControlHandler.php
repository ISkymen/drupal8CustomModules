<?php

/**
 * @file
 * Contains \Drupal\fk\fk_prodinfoAccessControlHandler.
 */

namespace Drupal\fk;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Fk_prodinfo entity.
 *
 * @see \Drupal\fk\Entity\fk_prodinfo.
 */
class fk_prodinfoAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\fk\fk_prodinfoInterface $entity */
    switch ($operation) {
      case 'view':

        return AccessResult::allowedIfHasPermission($account, 'view unpublished fk_prodinfo entities');
        return AccessResult::allowedIfHasPermission($account, 'view published fk_prodinfo entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit fk_prodinfo entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete fk_prodinfo entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add fk_prodinfo entities');
  }

}
