<?php
/**
 * @file
 * Contains \Drupal\admission\Form\EditAdmissionForm.
 */
namespace Drupal\admission\Form;

use Drupal\Core\Url;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EditAdmissionForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle($id = NULL) {
    
    $conn = Database::getConnection();
    $add = $conn->select('admission', 'a')
      ->condition('a.id', $id, '=')
      ->fields('a', ['name'])
      ->execute()
      ->fetchAssoc();
    $data = 'Edit ';

    if($add) {
      foreach ($add as $key => $value) {
        $data .= $add['name'];
      }
    } else {
      $data = 'Data not found.';
    }

    return ['#markup' => $data,];
  } 

  /**
   * {@inheritdoc}
   */

  public function getFormId() {
      return 'edit_admission_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state, $id = null) {
    $conn = Database::getConnection();
    $add = $conn->select('admission', 'a')
      ->condition('a.id', $id, '=')
      ->fields('a', ['name', 'father_name', 'mother_name', 'rollno', 'dob', 'gender'])
      ->execute()
      ->fetchAssoc();

    if(!$add) {
      $url = Url::fromRoute('system.403');
      return new RedirectResponse($url->toString());
    }

    $form['id'] = array(
      '#type' => 'hidden',
      '#value' => $id
    );
    $form['name'] = array(
        '#type' => 'textfield',
        '#title' => t('Name:'),
        '#required' => TRUE,
        '#default_value' => $add['name'], 
      );
      $form['father_name'] = array(
          '#type' => 'textfield',
          '#title' => t('Father Name:'),
          '#required' => TRUE,
          '#default_value' => $add['father_name'],
        );
        $form['mother_name'] = array(
          '#type' => 'textfield',
          '#title' => t('Mother Name:'),
          '#required' => TRUE,
          '#default_value' => $add['mother_name'],
        );
      $form['rollno'] = array(
        '#type' => 'textfield',
        '#title' => t('Enter Enrollment Number:'),
        '#required' => TRUE,
        '#default_value' => $add['rollno'],
      );
      
      $form['dob'] = array (
        '#type' => 'date',
        '#title' => t('Enter DOB:'),
        '#required' => TRUE,
        '#default_value' => $add['dob'],
      );
      $form['gender'] = array (
        '#type' => 'select',
        '#title' => ('Select Gender:'),
        '#options' => array(
          'Male' => t('Male'),
          'Female' => t('Female'),
          'Other' => t('Other'),
        ),
        '#default_value' => $add['gender'],
      );
      $form['actions']['#type'] = 'actions';
      $form['actions']['submit'] = array(
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
        '#button_type' => 'primary',
      );

      $form['#theme'] = 'edit_admission_form';

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
      $fields["updated"] = (new DrupalDateTime())->getTimestamp();
      
      $conn->update('admission')
          ->fields($fields)
          ->condition('id', $field['id'], '=')
          ->execute();
      \Drupal::messenger()->addMessage($this->t('The admission data has been succesfully updaated'));
      
      $redirect_path = '/admission/'. $field['id'];
      $url = url::fromUserInput($redirect_path);
      $form_state->setRedirectUrl($url);
        
    } catch(Exception $ex){
      \Drupal::logger('admission')->error($ex->getMessage());
    }
  }
}
