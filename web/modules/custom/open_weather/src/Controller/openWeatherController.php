<?php

namespace Drupal\open_weather\Controller;


use Drupal\Core\Controller\ControllerBase;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Defines HelloController class.
 */
class openWeatherController extends ControllerBase {

  /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => 'Aqui va el api',
    ];
  }

/**
   * callback for GET API method
   */
  public function get_result(Request $request){
    $word = $request->query->get('word');
   
    //$url="https://www.metaweather.com/api/location/search/?query={$word}";
    $url="http://api.openweathermap.org/data/2.5/weather?q={$word}&APPID=eb9eaf97de113d820940948a3d8ee729";

    $response = file_get_contents($url);

    $content = json_decode($response, TRUE);
    $woeid = $content[0]['woeid'];
    $temp= $content['main']['temp'] - 273.15;
    return[
      '#type' => 'markup',
      '#markup' => $this->t('
        <div class="container-fluid openWeather order-sm-1 order-1">
        <div class="row ">
        <div class="col-md-3 minidisplay">
        <img alt="clear sky" src="//openweathermap.org/img/wn/'.$content['weather'][0]['icon'].'@2x.png" width="150" height="150">
         <div class="small_val" title="Temp">'.$temp.' °C</div>
         <div class="small_val" title="Wind">'.$content['wind']['speed'].' m/s</div>
         <div class="small_val" title="Pressure">'.$content['main']['pressure'].' hPa</div></div>

        <div class="col-md-9 openWeatherInfo">
         <div class="row">
         <div class="col-md-4"><p>City Name:</p></div>
         <div class="col-md-8"><p>'.$content['name'].'</p></div>
        </div>
        <div class="row">
         <div class="col-md-4"><p>Forecast:</p></div>
         <div class="col-md-8"><p>'.$content['weather'][0]['main'].'</p></div>
        </div>
        <div class="row">
         <div class="col-md-4"><p>Detail Forecast:</p></div>
         <div class="col-md-8"><p>'.$content['weather'][0]['description'].'</p></div>
        </div>
        </div>
        </div>
        </div>
        
      '),
    ];
  }

}
