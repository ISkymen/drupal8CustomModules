<?php

/**
 * @file
 * Contains \Drupal\fk\Form\fk_ppForm.
 */

namespace Drupal\fk\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\jdf\Sclass\SkyFunction;

/**
 * Form controller for Fk_purchase edit forms.
 *
 * @ingroup fk
 */
class fk_purchaseForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\fk\Entity\fk_purchase */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    $form['barcodes'] = array(
        '#type' => 'textarea',
        '#rows' => 5,
        '#cols' => 5,
        '#resizable' => 'none',
        '#title' => t('Purchase'),
        '#title_display' => 'invisible',
    );

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
        drupal_set_message($this->t('Created the %label Fk_purchase.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Fk_purchase.', [
          '%label' => $entity->label(),
        ]));
    }

    $barcodes = $form_state->getValues()['barcodes'];
    $barcodes = explode("\n", $barcodes);
    $barcodes = array_map('trim', $barcodes);
    //dpm($barcodes);

    foreach ($barcodes as $barcode) {
        if (!empty($barcode)) {
            if (SkyFunction::barcode_check($barcode)) {
      $product = \Drupal\fk\Entity\fk_product::create(array(
            'barcode' => $barcode,
            'pid' => $entity->id(),
        ));
        $product->save();
        drupal_set_message($this->t('Product %barcode is saved.', ['%barcode' => $barcode,]),'status');
   }
   else {
       drupal_set_message($this->t('Barcode %barcode is wrong!', ['%barcode' => $barcode,]), 'warning');
   }

        }
    }

    $form_state->setRedirect('entity.fk_purchase.canonical', ['fk_purchase' => $entity->id()]);
  }




}
