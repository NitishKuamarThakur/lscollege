<?php
/**
 * @file
 * Contains \Drupal\admission\Form\AddAdmissionForm.
 */
namespace Drupal\admission\Form;

use Drupal\Core\Url;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

class AddAdmissionForm extends FormBase {
  /**
   * {@inheritdoc}
   */

  public function getFormId() {
      return 'admission_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state) {
      $form['name'] = array(
        '#type' => 'textfield',
        '#title' => t('Name:'),
        '#required' => TRUE,
      );
      $form['father_name'] = array(
          '#type' => 'textfield',
          '#title' => t('Father Name:'),
          '#required' => TRUE,
        );
        $form['mother_name'] = array(
          '#type' => 'textfield',
          '#title' => t('Mother Name:'),
          '#required' => TRUE,
        );
      $form['rollno'] = array(
        '#type' => 'textfield',
        '#title' => t('Enter Enrollment Number:'),
        '#required' => TRUE,
      );
      
      $form['dob'] = array (
        '#type' => 'date',
        '#title' => t('Enter DOB:'),
        '#required' => TRUE,
      );
      $form['gender'] = array (
        '#type' => 'select',
        '#title' => ('Select Gender:'),
        '#options' => array(
          'Male' => t('Male'),
      'Female' => t('Female'),
          'Other' => t('Other'),
        ),
      );
      $form['actions']['#type'] = 'actions';
      $form['actions']['submit'] = array(
        '#type' => 'submit',
        '#value' => $this->t('Register'),
        '#button_type' => 'primary',
      );
      
      $form['#theme'] = 'add_admission_form';

      return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    try{
      $conn = Database::getConnection();
      
      $field = $form_state->getValues();
       
      $fields["name"] = $field['name'];
      $fields["father_name"] = $field['father_name'];
      $fields["mother_name"] = $field['mother_name'];
      $fields["rollno"] = $field['rollno'];
      $fields["dob"] = $field['dob'];
      $fields["gender"] = $field['gender'];
      $fields["cretaed"] = (new DrupalDateTime())->getTimestamp();
      
      $id = $conn->insert('admission')
          ->fields($fields)
          ->execute();
      \Drupal::messenger()->addMessage($this->t('The admission data has been succesfully saved'));

      $redirect_path = '/admission/'. $id;
      $url = url::fromUserInput($redirect_path);
      $form_state->setRedirectUrl($url);
       
    } catch(Exception $ex){
      \Drupal::logger('dn_students')->error($ex->getMessage());
    }
  }
}
