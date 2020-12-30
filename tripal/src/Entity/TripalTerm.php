<?php

namespace Drupal\tripal\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Controlled Vocabulary Term entity.
 *
 * @ingroup tripal
 *
 * @ContentEntityType(
 *   id = "tripal_term",
 *   label = @Translation("Tripal Controlled Vocabulary Term"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\tripal\ListBuilders\TripalTermListBuilder",
 *     "views_data" = "Drupal\tripal\Entity\TripalTermViewsData",
 *     "translation" = "Drupal\tripal\TripalTermTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\tripal\Form\TripalTermForm",
 *       "add" = "Drupal\tripal\Form\TripalTermForm",
 *       "edit" = "Drupal\tripal\Form\TripalTermForm",
 *       "delete" = "Drupal\tripal\Form\TripalTermDeleteForm",
 *     },
 *     "access" = "Drupal\tripal\Access\TripalTermAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\tripal\TripalTermHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "tripal_term",
 *   data_table = "tripal_term_field_data",
 *   translatable = FALSE,
 *   admin_permission = "administer controlled vocabulary term entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/tripal_term/{tripal_term}",
 *     "add-form" = "/admin/structure/tripal_term/add",
 *     "edit-form" = "/admin/structure/tripal_term/{tripal_term}/edit",
 *     "delete-form" = "/admin/structure/tripal_term/{tripal_term}/delete",
 *     "collection" = "/admin/structure/tripal_term",
 *   },
 *   field_ui_base_route = "tripal_term.settings"
 * )
 */
class TripalTerm extends ContentEntityBase implements TripalTermInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getID() {
    return $this->get('id')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return $this->getName();
  }

  /**
   * {@inheritdoc}
   */
  public function getVocabID(){
    return $this->get('vocab_id')->getString();
  }

  /**
   * {@inheritdoc}
   */
  public function setVocabID($vocab_id) {
    $this->set('vocab_id', $vocab_id);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getVocab() {
    $vocab_id = $this->getVocabID();
    $vocab = TripalVocab::load($vocab_id);
    return $vocab;
  }

  /**
   * {@inheritdoc}
   */
  public function getAccession() {
    return $this->get('accession')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setAccession($accession) {
    $this->set('accession', $accession);
    return $this;
  }

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
  public function getDefinition() {
    return $this->get('definition')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setDefinition($definition) {
    $this->set('definition', $definition);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getDetails() {
    $details = [];

    $details['TripalTerm'] = $this;
    $vocab = $this->getVocab();
    $details['vocabulary'] = $vocab->getDetails();
    $details['accession'] = $this->getAccession();
    $details['name'] = $this->getName();
    $details['definition'] = $this->getDefinition();

    return $details;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['vocab_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Vocabulary ID'))
      ->setDescription(t('The ID of the TripalVocab entity to which this term belongs.'))
      ->setSetting('target_type', 'tripal_vocab');

    $fields['accession'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Accession'))
      ->setDescription(t('The unique ID (or accession) of this term in the vocabulary.'))
      ->setSettings(array(
        'max_length' => 1024,
        'text_processing' => 0,
      ));

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The human readable name for this term.'))
      ->setSettings(array(
        'max_length' => 1024,
        'text_processing' => 0,
      ));

    $fields['definition'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Definition'))
      ->setDescription(t('The definition of this term.'))
      ->setSettings(array(
        'text_processing' => 0,
      ));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
