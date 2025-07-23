<?php

namespace Drupal\blog_manager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;

/**
 * Defines a form for create blog editor account
 */
class CreateBlogEditorForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'create_blog_editor_form';
  }
  
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#required' => TRUE,
    ];

    $form['mail'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];

    $form['pass'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Create Blog Editor User'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (user_load_by_name($form_state->getValue('name'))) {
      $form_state->setErrorByName('name', $this->t('The username is already taken.'));
    }

    if (user_load_by_mail($form_state->getValue('mail'))) {
      $form_state->setErrorByName('mail', $this->t('The email address is already in use.'));
    }
  }
  
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $user = User::create([
      'name' => $form_state->getValue('name'),
      'mail' => $form_state->getValue('mail'),
      'pass' => $form_state->getValue('pass'),
      'status' => 1,
      'roles' => ['blog_editor'],
    ]);

    $user->save();

    \Drupal::messenger()->addMessage($this->t('The blog editor user %name has been created.', ['%name' => $user->getAccountName()]));
    $form_state->setRedirect('blog_manager.list_editors');
  }

}
