<?php

/**
 * @file
 * Contains \Drupal\fk\Entity\fk_prodinfo.
 */

namespace Drupal\fk\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\fk\fk_prodinfoInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Fk_prodinfo entity.
 *
 * @ingroup fk
 *
 * @ContentEntityType(
 *   id = "fk_prodinfo",
 *   label = @Translation("Fk_prodinfo"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\fk\fk_prodinfoListBuilder",
 *     "views_data" = "Drupal\fk\Entity\fk_prodinfoViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\fk\Form\fk_prodinfoForm",
 *       "add" = "Drupal\fk\Form\fk_prodinfoForm",
 *       "edit" = "Drupal\fk\Form\fk_prodinfoForm",
 *       "delete" = "Drupal\fk\Form\fk_prodinfoDeleteForm",
 *     },
 *     "access" = "Drupal\fk\fk_prodinfoAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\fk\fk_prodinfoHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "fk_prodinfo",
 *   admin_permission = "administer fk_prodinfo entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/fk_prodinfo/{fk_prodinfo}",
 *     "add-form" = "/admin/structure/fk_prodinfo/add",
 *     "edit-form" = "/admin/structure/fk_prodinfo/{fk_prodinfo}/edit",
 *     "delete-form" = "/admin/structure/fk_prodinfo/{fk_prodinfo}/delete",
 *     "collection" = "/admin/structure/fk_prodinfo",
 *   },
 *   field_ui_base_route = "fk_prodinfo.settings"
 * )
 */
class fk_prodinfo extends ContentEntityBase implements fk_prodinfoInterface {
  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }


  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Fk_prodinfo entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Fk_prodinfo entity.'))
      ->setReadOnly(TRUE);

    $fields['barcode'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Barcode'))
      ->setSettings(array(
        'type' => 'textfield',
        'size' => 13,
        'max_length' => 14,
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

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Fk_prodinfo entity.'))
      ->setSettings(array(
        'max_length' => 255,
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
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['weight'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Quantity'))
      ->setSettings(array(
        'unsigned' => TRUE,
        'size' => 'small',
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

    $fields['proteins'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Proteins'))
      ->setSettings(array(
        'precision' => 4,
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

    $fields['fats'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Fats'))
      ->setSettings(array(
        'precision' => 4,
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

    $fields['carbs'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Carbs'))
      ->setSettings(array(
        'precision' => 4,
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

    $fields['energy'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Energy'))
      ->setSettings(array(
        'precision' => 5,
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

    $fields['category'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Category'))
      ->setDescription(t('The name of the Fk_prodinfo entity.'))
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
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['link'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Link'))
      ->setDescription(t('The name of the Fk_prodinfo entity.'))
      ->setSettings(array(
        'max_length' => 255,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Image'))
      ->setDescription(t('Load image'))
      ->setSetting('target_type', 'file')
      ->setSetting('file_extensions', 'jpg jpeg')
      ->setSetting('file_directory', 'images/prodinfo')
      ->setSetting('title_field', FALSE)
      ->setSetting('title_field_required', FALSE)
      ->setSetting('alt_field', FALSE)
      ->setSetting('alt_field_required', FALSE)
      ->setSetting('min_resolution', '300x300')
      ->setSetting('max_resolution', '600x600')
      ->setSetting('max_filesize', '1 Mb')
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

    $fields['source'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Source'))
      ->setDescription(t('The ID of the Fk_prodinfo entity.'))
      ->setReadOnly(TRUE);

    return $fields;
  }

}
