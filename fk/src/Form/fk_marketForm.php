<?php

/**
 * @file
 * Contains \Drupal\fk\Form\fk_marketForm.
 */

namespace Drupal\fk\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Fk_market edit forms.
 *
 * @ingroup fk
 */
class fk_marketForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\fk\Entity\fk_market */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Fk_market.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Fk_market.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.fk_market.canonical', ['fk_market' => $entity->id()]);
  }

}
