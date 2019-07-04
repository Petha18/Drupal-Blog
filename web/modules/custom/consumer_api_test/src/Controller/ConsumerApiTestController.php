<?php

/**
 * @file
 * UrbanDictionaryController
 */

namespace Drupal\consumer_api_test\Controller;

use Drupal\Core\Controller\ControllerBase;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class ConsumerApiTestController extends ControllerBase{

  /**
   * callback for GET API method
   */
  public function get_result(Request $request){
    $word = $request->query->get('word');
   
    $url="http://api.icndb.com/jokes/random?firstName={$word}";

    $response = file_get_contents($url);

    $content = json_decode($response, TRUE);
    $result = $content['value']['joke'];
    return[
      '#type' => 'markup',
      '#markup' => $this->t('
         <h1>'.$result.'</h1>
      '),
    ];
  }
}
