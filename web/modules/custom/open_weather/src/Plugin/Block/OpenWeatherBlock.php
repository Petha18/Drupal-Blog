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
    // Return the content of the block.

    return array(
      '#markup' => $this->t('
        <div class="order-sm-2 order-2">
         <form action="/openWeather" method="GET" style="">

           <input type="text" name="word" placeholder="Esparza, cr">

           <input type="submit" value="Look up">
         </form>
        </div>
      '),
    );
    
  }

}

