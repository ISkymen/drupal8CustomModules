<?php

/**
 * @file
 * Contains \Drupal\jdf\Plugin\views\field\PHPViewsField.
 */

namespace Drupal\jdf\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Random;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;
use Drupal\jdf\Sclass\ImportSource;

/**
 * A handler to provide a field that is completely custom by the administrator.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("phpviews_field")
 */
 class PHPViewsField extends FieldPluginBase {
/**
 * {@inheritdoc}
 */
 public function usesGroupBy() {
   return FALSE;
 }

/**
 * {@inheritdoc}
 */
 public function query() {
   // do nothing -- to override the parent query.
 }

/**
 * {@inheritdoc}
 */
 protected function defineOptions() {
   $options = parent::defineOptions();

   $options['hide_alter_empty'] = array('default' => FALSE);
   return $options;
 }

/**
 * {@inheritdoc}
 */
 public function buildOptionsForm(&$form, FormStateInterface $form_state) {
   parent::buildOptionsForm($form, $form_state);
 }

/**
 * {@inheritdoc}
 */
 public function render(ResultRow $values) {

    $barcode = strip_tags($this->view->field['barcode']->original_value);
    $memory = memory_get_usage();
    $time = microtime(true);

    $output = ImportSource::jdf_prodinfo($barcode, 'name', 'RemoteSave');

    $memory = round((memory_get_usage() - $memory)/1000);
    $time = round((microtime(true) - $time)*1000);
    //dpm($barcode . ' - ' . $time . ' - ' . $memory);

    return $output . ' (' . $time . ' ms, ' . $memory . ' KB)';
 }


}
