<?php

use Drupal\Component\Utility\Html;
use \Drupal\node\Entity\Node;

$nodes = Node::loadMultiple();
foreach($nodes as $node){
   $node->set('title', 'abc');
   $node->save();
}
