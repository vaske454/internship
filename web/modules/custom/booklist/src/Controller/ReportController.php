<?php
/**
 * @file
 * Contains \Drupal\booklist\Controller\ReportController.
 */

namespace Drupal\booklist\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;


/**
 * Controller for Book List Report
 */

class ReportController extends ControllerBase {

  public function display() {
    $query = \Drupal::entityQuery('node')
      ->condition('type', 'knjiga')
      ->condition('status', 1)
      ->sort('title')
      ->execute();
    $nodes = Node::loadMultiple($query);

    $data = array();
    foreach($nodes as $node) {
      $data[] = [
        'title' => $node->get('title')->value,
        'description' => $node->get('field_description')->value,
        'nid' => $node->get('nid')->value,
      ];
    }
    return [
        '#theme' => 'my_template',
        '#myvariable' => $data,
      ];
  }
}
