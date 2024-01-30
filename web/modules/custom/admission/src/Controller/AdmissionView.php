<?php
/**
 * @file
 * Contains \Drupal\admission\Controller\AdmissionView.
 */
namespace Drupal\admission\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

class AdmissionView extends ControllerBase {
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
    $data = '';

    if($add) {
      foreach ($add as $key => $value) {
        $data = $add['name'];
      }
    } else {
      $data = 'Data not found.';
    }

    return ['#markup' => $data,];
  } 

  /**
   * {@inheritdoc}
   */
  public function content($id = NULL) {
    
    $conn = Database::getConnection();
    $add = $conn->select('admission', 'a')
      ->condition('a.id', $id, '=')
      ->fields('a', ['name', 'father_name', 'mother_name', 'rollno', 'dob', 'gender'])
      ->execute()
      ->fetchAssoc();
    $data = '';
    //dd($add);

    if($add) {
      foreach ($add as $key => $value) {
        $data .= '
        <div class="field-item">
          <div class="field-lable fw-bold">'. str_replace("_"," ",$key) .':</div>
          <div class="field-value">'.$value.'</div>
        </div>';
      }


    } else {
      $data = 'Data not found.';
    }


    return [
      '#markup' => $data,
    ];
  }  
}
