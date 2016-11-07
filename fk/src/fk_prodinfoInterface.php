<?php

/**
 * @file
 * Contains \Drupal\fk\fk_prodinfoInterface.
 */

namespace Drupal\fk;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface for defining Fk_prodinfo entities.
 *
 * @ingroup fk
 */
interface fk_prodinfoInterface extends ContentEntityInterface {
  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Fk_prodinfo name.
   *
   * @return string
   *   Name of the Fk_prodinfo.
   */
  public function getName();

  /**
   * Sets the Fk_prodinfo name.
   *
   * @param string $name
   *   The Fk_prodinfo name.
   *
   * @return \Drupal\fk\fk_prodinfoInterface
   *   The called Fk_prodinfo entity.
   */
  public function setName($name);

  /**
   * Gets the Fk_prodinfo creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Fk_prodinfo.
   */
 

}
