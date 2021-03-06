<?php

/**
 * @file
 * Contains \Drupal\fk\Form\fk_prodinfoSettingsForm.
 */

namespace Drupal\fk\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class fk_prodinfoSettingsForm.
 *
 * @package Drupal\fk\Form
 *
 * @ingroup fk
 */
class fk_prodinfoSettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'fk_prodinfo_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }


  /**
   * Defines the settings form for Fk_prodinfo entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['fk_prodinfo_settings']['#markup'] = 'Settings form for Fk_prodinfo entities. Manage field settings here.';
    return $form;
  }

}
