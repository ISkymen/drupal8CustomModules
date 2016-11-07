<?php

/**
 * @file
 * Contains \Drupal\fk\fk_marketAccessControlHandler.
 */

namespace Drupal\fk;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Fk_market entity.
 *
 * @see \Drupal\fk\Entity\fk_market.
 */
class fk_marketAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\fk\fk_marketInterface $entity */
    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view published fk_market entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit fk_market entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete fk_market entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add fk_market entities');
  }

}
