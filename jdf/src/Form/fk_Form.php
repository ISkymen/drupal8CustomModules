<?php

/**
 * @file
 * Contains \Drupal\jdf\Form\fk_Form.
 */

namespace Drupal\jdf\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Fk_purchase edit forms.
 *
 * @ingroup fk
 */

 dpm('dfs');
class fk_Form extends FormBase {
  /**
   * {@inheritdoc}
   */

     public function getFormId() {

  }


  public function buildForm(array $form, FormStateInterface $form_state) {
    $fruits = ['Apple', 'Banana', 'Blueberry', 'Grapes', 'Orange', 'Strawberry'];

$form['contacts'] = array(
  '#type' => 'table',
  '#caption' => 'Sample Table',
  '#header' => array('Name', 'Phone', 'id'),
);

for ($i=1; $i<=4; $i++) {
  $form['contacts'][$i]['name'] = array(
    '#type' => 'textfield',
    '#title' => t('Name'),
    '#title_display' => 'invisible',
  );

  $form['contacts'][$i]['phone'] = array(
    '#type' => 'tel',
    '#title' => t('Phone'),
    '#title_display' => 'invisible',
  );

  $form['contacts'][$i]['id'] = array(
    '#type' => 'textfield',
    '#title' => t('id'),
    '#title_display' => 'invisible',
    '#value' => 'textfield',
  );
}

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit!')
    );

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
