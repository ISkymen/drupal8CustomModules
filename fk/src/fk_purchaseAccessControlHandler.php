<?php

/**
 * @file
 * Contains \Drupal\fk\fk_purchaseAccessControlHandler.
 */

namespace Drupal\fk;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Fk_purchase entity.
 *
 * @see \Drupal\fk\Entity\fk_purchase.
 */
class fk_purchaseAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\fk\fk_purchaseInterface $entity */
    switch ($operation) {

    case 'view': 

    return AccessResult::allowedIfHasPermission($account, 'view published fk_purchase entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit fk_purchase entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete fk_purchase entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add fk_purchase entities');
  }

}
