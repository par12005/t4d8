<?php

/**
 * @file
 * Contains \Drupal\tripal\Form\TripalHTML5TestForm.
 */

namespace Drupal\tripal\Form;

use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
/**
 * Provides a test form object.
 */
class TripalHTML5TestForm implements FormInterface {

  public function getFormID() {
    return 'tripal_html5_file_upload_test';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['mark'] = [
      '#markup' => 'HTML5 file test form<br><br>',
    ];

    $form['html5-file2'] = [
      '#type' => 'html5_file',
      '#title' => t('HTML5 File upload'),
      '#description' => 'Remember to click the "Upload" button below to send ' .
        'your file to the server.  This interface is capable of uploading very ' .
        'large files.  If you are disconnected you can return, reload the file and it ' .
        'will resume where it left off.  Once the file is uploaded the "Upload ' .
        'Progress" will indicate "Complete".  If the file is already present on the server ' .
        'then the status will quickly update to "Complete".',
      '#usage_type' => 'tripal_importer',
      '#usage_id' => 0,
      '#allowed_types' => [],
      '#cardinality' => 5,
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
  }
}
