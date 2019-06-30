<?php

namespace Drupal\lorem_ipsum_test\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a Lorem ipsum block with which you can generate dummy text anywhere.
 *
 * @Block(
 *   id = "lorem_ipsum_test_block",
 *   admin_label = @Translation("Lorem ipsum TEST block"),
 * )
 */
class LoremIpsumTestBlock extends BlockBase {
  // Needs to implement build(), blockAccess(), blockForm(), and blockSubmit()

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Return the form @ Form/LoremIpsumTestBlockForm.php.
    return \Drupal::formBuilder()->getForm('Drupal\lorem_ipsum_test\Form\LoremIpsumTestBlockForm');
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    // Deal with access
    return AccessResult::allowedIfHasPermission($account, 'generate lorem ipsum test');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('lorem_ipsum_test_block_settings', $form_state->getValue('lorem_ipsum_test_block_settings'));
  }
}

