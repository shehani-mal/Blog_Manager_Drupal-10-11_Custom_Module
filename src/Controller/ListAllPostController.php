<?php

namespace Drupal\blog_manager\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\views\Views;

/**
 * Class ListAllPostController.
 *
 * @package Drupal\blog_manager\Controller
 */
class ListAllPostController extends ControllerBase {

  /**
   * Renders the all blog posts view with contextual filters and adds action buttons.
   *
   * @return array
   *   A render array.
   */
  public function listall() {
    // Load the view.
    $view = Views::getView('all_blog_posts');
    if (!$view) {
      throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }

    // Set the display to 'all_blog_posts_'.
    $view->setDisplay('all_blog_posts_');
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
