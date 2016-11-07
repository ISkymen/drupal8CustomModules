<?php

/**
 * @file
 * Contains \Drupal\fk\Entity\fk_market.
 */

namespace Drupal\fk\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\fk\fk_marketInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Fk_market entity.
 *
 * @ingroup fk
 *
 * @ContentEntityType(
 *   id = "fk_market",
 *   label = @Translation("Fk_market"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\fk\fk_marketListBuilder",
 *     "views_data" = "Drupal\fk\Entity\fk_marketViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\fk\Form\fk_marketForm",
 *       "add" = "Drupal\fk\Form\fk_marketForm",
 *       "edit" = "Drupal\fk\Form\fk_marketForm",
 *       "delete" = "Drupal\fk\Form\fk_marketDeleteForm",
 *     },
 *     "access" = "Drupal\fk\fk_marketAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\fk\fk_marketHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "fk_market",
 *   admin_permission = "administer fk_market entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/fk_market/{fk_market}",
 *     "add-form" = "/admin/structure/fk_market/add",
 *     "edit-form" = "/admin/structure/fk_market/{fk_market}/edit",
 *     "delete-form" = "/admin/structure/fk_market/{fk_market}/delete",
 *     "collection" = "/admin/structure/fk_market",
 *   },
 *   field_ui_base_route = "fk_market.settings"
 * )
 */
class fk_market extends ContentEntityBase implements fk_marketInterface {
  use EntityChangedTrait;

    public function label() {
    return $this->get('name')->value . ' (' . $this->get('address')->value . ')';
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Fk_market entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Fk_market entity.'))
      ->setReadOnly(TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Fk_market entity.'))
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

    $fields['address'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Address'))
      ->setSettings(array(
        'max_length' => 250,
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

        $fields['latitude'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Latitude'))
      ->setDescription('Latitude of object')
      ->setSettings(array(
        'precision' => 7,
        'scale' => 5,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'inline',
        'type' => 'decimal',
        'weight' => 7,
        'scale' => 4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'number',
        'weight' => 7,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setSetting('default_value', 0);
    $fields['longitude'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Longitude'))
      ->setDescription('Longitude of object')
            ->setSettings(array(
        'precision' => 7,
        'scale' => 5,
      ))
            ->setDisplayOptions('view', array(
        'label' => 'inline',
        'type' => 'decimal',
        'weight' => 7,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'number',
        'weight' => 7,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setSetting('default_value', 0);

    return $fields;
  }


}
