<?php

/**
 * @file
 * Contains \Drupal\fk\Entity\fk_product.
 */

namespace Drupal\fk\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\fk\fk_productInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Fk_product entity.
 *
 * @ingroup fk
 *
 * @ContentEntityType(
 *   id = "fk_product",
 *   label = @Translation("Fk_product"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\fk\fk_productListBuilder",
 *     "views_data" = "Drupal\fk\Entity\fk_productViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\fk\Form\fk_productForm",
 *       "add" = "Drupal\fk\Form\fk_productForm",
 *       "edit" = "Drupal\fk\Form\fk_productForm",
 *       "delete" = "Drupal\fk\Form\fk_productDeleteForm",
 *     },
 *     "access" = "Drupal\fk\fk_productAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\fk\fk_productHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "fk_product",
 *   admin_permission = "administer fk_product entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/fk_product/{fk_product}",
 *     "add-form" = "/admin/structure/fk_product/add",
 *     "edit-form" = "/admin/structure/fk_product/{fk_product}/edit",
 *     "delete-form" = "/admin/structure/fk_product/{fk_product}/delete",
 *     "collection" = "/admin/structure/fk_product",
 *   },
 *   field_ui_base_route = "fk_product.settings"
 * )
 */
class fk_product extends ContentEntityBase implements fk_productInterface {
  use EntityChangedTrait;

  public function getBarcode() {
    return $this->get('barcode')->value;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Testy entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Testy entity.'))
      ->setReadOnly(TRUE);

    $fields['pid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Purchase'))
      ->setDescription(t('Purchase information'))
      ->setSetting('target_type', 'fk_purchase')

      ->setSettings(array(
    'handler'          => 'default',
    'handler_settings' => array(            // Added
      'auto_create'    => TRUE              // Added
    )
  ))
  ->setDisplayOptions('form', array(
    'type'     => 'entity_reference_autocomplete',
    'settings' => array(
      'match_operator' => 'CONTAINS',
      'size'           => 60,
      'placeholder'    => ''
    ),
    'weight'   => 1
  ))
  ->setRequired(TRUE)

      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['barcode'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Barcode'))
      ->setSettings(array(
        'type' => 'textfield',
        'size' => 13,
        'max_length' => 13,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => 2,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'textfield',
        'size' => 13,
        'max_length' => 13,
        'weight' => 2,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['price'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Price'))
      ->setSettings(array(
        'precision' => 10,
        'scale' => 2,
      ))
      ->setDefaultValue('0.00')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'decimal',
        'weight' => 3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'number',
        'weight' => 3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['quantity'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Quantity'))
      ->setSettings(array(
        'unsigned' => TRUE,
      ))
      ->setDefaultValue('1')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'integer',
        'weight' => 4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'number',
        'weight' => 4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['special_price'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Special price'))
      ->setDefaultValue(FALSE)

->setDisplayOptions('form', array(
        'type' => 'boolean_checkbox',
        'settings' => array(
          'display_label' => TRUE,
        ),
        'weight' => 5,
      ))

      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'boolean',
        'weight' => 5,
    ))

      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
