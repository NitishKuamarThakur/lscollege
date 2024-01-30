<?php
/**
 * @file
 * Contains \Drupal\admission\Form\DeleteAdmissionForm.
 */
namespace Drupal\admission\Form;

use Drupal\Core\Url;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DeleteAdmissionForm extends ConfirmFormBase {
  /**
   * ID of the item to delete.
   *
   * @var int
   */
  protected $id;

  /**
   * {@inheritdoc}
   */
  public function getFormId() : string {
    return "delete_admission_form";
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, string $id = NULL) {
    $this->id = $id;
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // @todo: Do the deletion.
    try{
      $conn = Database::getConnection();
      
      $conn->delete('admission')
          ->condition('id', $this->id)
          ->execute();
      \Drupal::messenger()->addMessage($this->t('The admission data has been succesfully deleted'));
      
      $url = Url::fromRoute('view.admission.page_1');
      $form_state->setRedirectUrl($url);
        
    } catch(Exception $ex){
      \Drupal::logger('admission')->error($ex->getMessage());
    }
  }


  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Do you want to delete %id?', ['%id' => $this->id]);
  }

  /**
   * Returns the route to go to if the user cancels the action.
   *
   * @return \Drupal\Core\Url
   *   A URL object.
   */
  public function getCancelUrl() {
    return Url::fromRoute('view.admission.page_1');
  }

}

