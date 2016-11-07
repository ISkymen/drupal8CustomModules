<?php

/**
 * @file
 * Contains \Drupal\fk\Form\fk_productForm.
 */

namespace Drupal\fk\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\jdf\Sclass\SkyFunction;

/**
 * Form controller for Fk_product edit forms.
 *
 * @ingroup fk
 */
class fk_productForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\fk\Entity\fk_product */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;


    return $form;
  }



// public function validateForm(array &$form, FormStateInterface $form_state) {
/*   if (SkyFunction::barcode_check($form_state->getValue('barcode')[0]['value'])) {
      return TRUE;

   }
   else {
          $form_state->setErrorByName('barcode', $this->t('Wrong barcode!'));
     return FALSE;
   }*/


  // dpm($this->barcode_check($form_state->getValue('barcode')[0]['value']));
  //  }



  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Fk_product.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Fk_product.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.fk_product.canonical', ['fk_product' => $entity->id()]);
  }

}
