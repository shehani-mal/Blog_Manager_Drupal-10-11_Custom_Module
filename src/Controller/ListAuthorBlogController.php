<?php

namespace Drupal\blog_manager\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\views\Views;

/**
 * Class ListAuthorBlogController.
 *
 * @package Drupal\blog_manager\Controller
 */
class ListAuthorBlogController extends ControllerBase {

  /**
   * Renders the blog editors view with contextual filters and adds action buttons.
   *
   * @return array
   *   A render array.
   */
  public function listauthor() {
    // Load the view.
    $view = Views::getView('blog_post_by_author');
    if (!$view) {
      throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }

    // Set the display to 'authorby_'.
    $view->setDisplay('authorby_');

    // Set the contextual filter for the current user.
    $current_user = \Drupal::currentUser()->id();
    $view->setArguments([$current_user]);

    $view->preExecute();
    $view->execute();

    // Render the view.
    $view_render_array = $view->render();

    // Generate the 'Add Blog' button link.
    $add_blog_url = Url::fromUri('internal:/node/add/blog', ['attributes' => ['class' => ['button', 'button--primary']]]);
    $add_blog_button = Link::fromTextAndUrl($this->t('Add Blog'), $add_blog_url)->toRenderable();

    return [
      '#type' => 'container',
      '#attributes' => ['class' => ['container']],
      'actions' => [
        '#type' => 'container',
        '#attributes' => ['class' => ['button-container']],
        'add_blog' => $add_blog_button,
      ],
      'view' => $view_render_array,
    ];
  }

}
