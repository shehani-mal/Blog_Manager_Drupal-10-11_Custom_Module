<?php

namespace Drupal\blog_manager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Defines a form for edit blog editor account
 */
class EditBlogEditorStatusForm extends FormBase {

   /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'edit_blog_editor_status_form';
  }

   /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, User $user = NULL) {
    
    if (!$user || !$user->hasRole('blog_editor')) {
      throw new NotFoundHttpException();
    }

    $form['user_id'] = [
      '#type' => 'hidden',
      '#value' => $user->id(),
    ];

    $form['status'] = [
      '#type' => 'radios',
      '#title' => $this->t('Status'),
      '#default_value' => $user->isActive() ? 1 : 0,
      '#options' => [
        1 => $this->t('Active'),
        0 => $this->t('Blocked'),
      ],
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

   /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $user_id = $form_state->getValue('user_id');
    $status = $form_state->getValue('status');

    $user = User::load($user_id);
    if ($user) {
      $user->set('status', $status);
      $user->save();
      $this->messenger()->addStatus($this->t('The status of %name has been updated.', ['%name' => $user->getAccountName()]));
    } else {
      $this->messenger()->addError($this->t('User not found.'));
    }

   // $form_state->setRedirect('entity.user.collection');
   $form_state->setRedirect('blog_manager.list_editors'); // Redirect to the editors view page
  }

}
