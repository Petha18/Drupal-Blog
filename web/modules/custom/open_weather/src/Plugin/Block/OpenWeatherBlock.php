<?php

namespace Drupal\open_weather\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Component\Serialization\Json;


/**
 * Provides a Lorem ipsum block with which you can generate dummy text anywhere.
 *
 * @Block(
 *   id = "open_weather_block",
 *   admin_label = @Translation("Open Weather block"),
 * )
 */
class OpenWeatherBlock extends BlockBase{
  // Needs to implement build(), blockAccess(), blockForm(), and blockSubmit()


  /**
   * {@inheritdoc}
   */
  public function build() {
    // Return the form @ Form/LoremIpsumTestBlockForm.php.
    
    /*$client = \Drupal::httpClient();
    $request =$client->request('GET', 'https://www.metaweather.com/api/location/search/?query=london');
    $response = $request->getBody();
    $request= file_get_contents("https://www.metaweather.com/api/location/search/?query=london")
    $data = json_decode($request, TRUE);*/

    /** @var \GuzzleHttp\Client $client 
    $client = \Drupal::service('http_client_factory')->fromOptions([
      'base_uri' => 'https://www.metaweather.com/api/',
    ]);

    $config = $this->getConfiguration();
    $city= $config['source_text'];

    $response = $client->get('location/search/', [
      'query' => [
        'query' => 'london',
      ]
    ]);

    $r=$response->getBody();

    $data = Json::decode($r);
    $muestra= $data[0]['title'];


  
    return array(
      '#type' => 'markup',
      '#markup' => $this->t('
         <h1>'.$city.'</h1>
         '),
    );*/

    return array(
      '#markup' => $this->t('
         <form action="/openWeather" method="GET" style="">
           <input type="text" name="word" placeholder="Esparza, cr (works with only city too)">

           <input type="submit" value="Look up">
         </form>
      '),
    );
    
  }

}

