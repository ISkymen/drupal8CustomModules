<?php

/**
 * @file
 * Contains \Drupal\fk\Form\fk_purchaseForm.
 */

namespace Drupal\fk\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\jdf\Sclass\SkyFunction;
use Drupal\fk\Entity\fk_product;
use Drupal\jdf\Sclass\ImportSource;
use Drupal\Core\Url;
use Drupal\Core\Link;

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

    if (null !== $entity->id()) {

    $products = \Drupal::entityTypeManager()->getStorage('fk_product')->loadByProperties([
  'pid' => $entity->id()
]);



    $form['product'] = array(
  '#type' => 'table',
  '#caption' => 'Sample Table',
  '#header' => array('Barcode', 'Title', 'Price', 'Quantity', 'SP'),
);

foreach ($products as $key) {

 //$title = ImportSource::jdf_getfields($key->barcode->value, 1);
 //if (empty($title)) $title = Link::fromTextAndUrl('Google search', Url::fromUri('https://www.google.com.ua/search?q=' . $key->barcode->value))->toString();

  $form['product'][$key->id()]['barcode'] = array(
    '#markup' => $key->barcode->value,
  );



   $form['product'][$key->id()]['title'] = array(
    '#markup' => render ($title),
  );


  $form['product'][$key->id()]['price'] = array(
    '#type' => 'textfield',
    '#title' => t('Price'),
    '#title_display' => 'invisible',
    '#default_value' => $key->price->value,
  );

  $form['product'][$key->id()]['quantity'] = array(
    '#type' => 'number',
    '#title' => t('Quantity'),
    '#title_display' => 'invisible',
    '#default_value' => $key->quantity->value,
  );

  $form['product'][$key->id()]['special_price'] = array(
    '#type' => 'checkbox',
    '#title' => t('Special price'),
    '#title_display' => 'invisible',
    '#default_value' => $key->special_price->value,
  );

}




    }




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



    foreach ($form['product'] as $product) {

    $product = $form_state->getValues()[$product];
      if (null !== $product) {
     foreach ($product as $key => $value) {

   $node = fk_product::load($key);
$node->set("id", $key);
$node->set("price", $value['price']);
$node->set("quantity", $value['quantity']);
$node->set("special_price", $value['special_price']);
$node->save();

    }    }
    }


    $barcodes = $form_state->getValues()['barcodes'];
    $barcodes = explode("\n", $barcodes);
    $barcodes = array_map('trim', $barcodes);


    foreach ($barcodes as $barcode) {
        if (!empty($barcode)) {
            if (SkyFunction::barcode_check($barcode)) {
      $product = \Drupal\fk\Entity\fk_product::create(array(
            'barcode' => $barcode,
            'pid' => $entity->id(),
        ));
        $product->save();
        $prodname = ' (' . ImportSource::jdf_prodinfo($barcode, 'name') . ')';
        drupal_set_message($this->t('Product %barcode is saved.', ['%barcode' => $barcode . $prodname,]),'status');



  }

   else {
       drupal_set_message($this->t('Barcode %barcode is wrong!', ['%barcode' => $barcode,]), 'warning');
   }

        }
    }

    $form_state->setRedirect('entity.fk_purchase.canonical', ['fk_purchase' => $entity->id()]);
  }




}
