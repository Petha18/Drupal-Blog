<?php

namespace Drupal\consumer_api_test\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides to Consumer Api a block value
 *
 * @Block(
 *   id = "consumer_api_test",
 *   admin_label = @Translation("Consumer block"),
 *   category = @Translation("Consumer Api"),
 * )
 */

class ConsumerApiTest extends BlockBase{

  /**
   * {@inheritdoc}
   */

  public function build(){
    return array(
      '#markup' => $this->t('
         <form action="/consumerapi" method="GET" style="">
           <input type="text" name="word" placeholer="Write your name">

           <input type="submit" value="Look up">
         </form>
      '),
    );
  }
}