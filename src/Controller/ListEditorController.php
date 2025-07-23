<?php

namespace Drupal\blog_manager\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\views\Views;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ListEditorController.
 *
 * @package Drupal\blog_manager\Controller
 */
class ListEditorController extends ControllerBase {

  /**
   * Renders the blog editors view and adds action buttons.
   *
   * @return array
   *   A render array.
   */
  public function list() {
    // Load the view.
    $view = Views::getView('blog_editors');
    if (!$view) {
      throw new NotFoundHttpException();
    }

    // Set the display to 'page_1'.
    $view->setDisplay('page_1');
    $view->preExecute();
    $view->execute();

    // Render the view.
    $view_render_array = $view->render();


    // Generate the 'Create User' button link.
    $create_user_url = Url::fromUri('internal:/admin/blog_manager/create-blog-editor', ['attributes' => ['class' => ['button', 'button--secondary']]]);
    $create_user_button = Link::fromTextAndUrl($this->t('Create Blog Editor'), $create_user_url)->toRenderable();

    return [
      '#type' => 'container',
      '#attributes' => ['class' => ['container']],
      'actions' => [
        '#type' => 'container',
        '#attributes' => ['class' => ['button-container']],
        'create_user' => $create_user_button,
      ],
      'view' => $view_render_array,
    ];
  }
}
