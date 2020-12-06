<?php
/**
 * @file
 * Contains \Drupal\romanlist\Controller\ReportController.
 */

namespace Drupal\romanlist\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;


/**
 * Controller for Book List Report
 */

class RomanListController extends ControllerBase {

  public function display() {
    $query = \Drupal::entityQuery('node')
      ->condition('type', 'roman')
      ->condition('status', 1)
      ->sort('title')
      ->execute();
    $nodes = Node::loadMultiple($query);

    $data = array();
    foreach($nodes as $node) {
      $data[] = [
        'title' => $node->get('title')->value,
        'price' => $node->get('field_price')->value,
        'isbn' => $node->get('field_isbn')->value,
        'comments' => $node->get('field_comments')->getValue(),
        'nid' => $node->get('nid')->value,
      ];
    }
    return [
        '#theme' => 'romanlist_template',
        '#myvariable' => $data,
      ];
  }
}
