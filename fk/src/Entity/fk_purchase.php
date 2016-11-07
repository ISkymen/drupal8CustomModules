<?php

/**
 * @file
 * Contains \Drupal\fk\Entity\fk_purchase.
 */

namespace Drupal\fk\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\fk\fk_purchaseInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Fk_purchase entity.
 *
 * @ingroup fk
 *
 * @ContentEntityType(
 *   id = "fk_purchase",
 *   label = @Translation("Fk_purchase"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\fk\fk_purchaseListBuilder",
 *     "views_data" = "Drupal\fk\Entity\fk_purchaseViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\fk\Form\fk_purchaseForm",
 *       "add" = "Drupal\fk\Form\fk_purchaseForm",
 *       "edit" = "Drupal\fk\Form\fk_purchaseForm",
 *       "delete" = "Drupal\fk\Form\fk_purchaseDeleteForm",
 *     },
 *     "access" = "Drupal\fk\fk_purchaseAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\fk\fk_purchaseHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "fk_purchase",
 *   admin_permission = "administer fk_purchase entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "date",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/fk_purchase/{fk_purchase}",
 *     "add-form" = "/admin/structure/fk_purchase/add",
 *     "edit-form" = "/admin/structure/fk_purchase/{fk_purchase}/edit",
 *     "delete-form" = "/admin/structure/fk_purchase/{fk_purchase}/delete",
 *     "collection" = "/admin/structure/fk_purchase",
 *   },
 *   field_ui_base_route = "fk_purchase.settings"
 * )
 */
class fk_purchase extends ContentEntityBase implements fk_purchaseInterface {
  use EntityChangedTrait;
  /**
   * {@inheritdoc}
   */

   public function getDate() {
    return $this->get('date')->value;
  }

    public function label() {
    $ent = entity_load('fk_market', $this->get('mid')->target_id);
    return $this->get('date')->value . ' (' . $ent->label() . ')';
  }

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Fk_purchase entity.'))
      ->setReadOnly(TRUE);
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Fk_purchase entity.'))
      ->setReadOnly(TRUE);

    $fields['mid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Market ID'))
      ->setDescription(t('Market'))
      ->setSetting('target_type', 'fk_market')

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

      ->setDisplayOptions('view', array(
      'label' => 'hidden',
      'type' => 'string',
      'weight' => 1,
    ))

  ->setRequired(TRUE)

      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Date'))
      ->setDescription(t('Date'))
      ->setSetting('datetime_type', 'date')
      ->setDisplayOptions('view', array(
        'type' => 'datetime_default',
        'label' => 'hidden',
        'weight' => -4,
      ))
      ->setDefaultValue(array(0 => array(
        'default_date_type' => 'now',
        'default_date' => 'now',
      )))

      ->setDisplayOptions('form', array(
        'type' => 'datetime_default',
        'weight' => 2,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['note'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Note'))
      ->setDescription(t('The name of the Fk_purchase entity.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => 3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


    $fields['check'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Image'))
      ->setDescription(t('Load image'))
      ->setSetting('target_type', 'file')
      ->setSetting('file_extensions', 'jpg jpeg')
      ->setSetting('file_directory', 'images/check')
      ->setSetting('title_field', FALSE)
      ->setSetting('title_field_required', FALSE)
      ->setSetting('alt_field', FALSE)
      ->setSetting('alt_field_required', FALSE)
      ->setSetting('min_resolution', '300x300')
      ->setSetting('max_resolution', '300x3000')
      ->setSetting('max_filesize', '10 Mb')
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'image',
        'weight' => 2,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'image',
        'weight' => 4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


    return $fields;
  }

}
