<?php

namespace Drupal\open_weather\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Lorem Ipsum test block form
 */
class OpenWeatherBlockForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'open_weather_block_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['open_weather_settings'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $this->t('London, uk'),
      '#description' => $this->t('City, country you want to display in format: "City, country", for example "London, uk"'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state){

    }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('open_weather.settings');
    $config->set('open_weather.source_text', $form_state->getValue('source_text'));
    return parent::submitForm($form, $form_state);
  }
}
