<?php
/*
 * Plugin Name: Kint for WordPress and Timber
 * Description: Kint is magic. Let's use it in php and in (Timber) twig!
 * Version: 1.0.0
 * Author: Meg Claypool
 * Plugin URI:: https://github.com/megclaypool/timber-kint-debug
 * Based on the work of: Kaido Toomingas
 * Kaido's site: http://web3.ee
 * */
defined('ABSPATH') or die('Nope, not accessing this');

if (!class_exists('Kint')) {
  require 'kint.phar';
}

use Kint\Kint;

// Add an alias 'kint' for the dump function in php
if (!\function_exists('kint')) {
  /**
   * Alias of Kint::dump().
   *
   * @return int|string
   */

  function kint()
  {
    $args = \func_get_args();

    return \call_user_func_array(['Kint', 'dump'], $args);
  }

  Kint::$aliases[] = 'kint';
}

// Add a twig function so you can use kint in twig
if (class_exists('Timber')) {
  class Timber_Kint_Debug
  {
    function __construct()
    {
      add_filter('get_twig', [$this, 'add_to_twig']);
    }
    function add_to_twig($twig)
    {
      $twig->addExtension(new Twig_Extension_StringLoader());
      $twig->addFunction(
        new Twig_SimpleFunction(
          'kint',
          [$this, 'call_kint'],
          [
            'is_safe' => ['html'],
            'needs_context' => true,
            'needs_environment' => true,
          ]
        )
      );
      return $twig;
    }
    function call_kint($twig, $vars, $context = false)
    {
      // if ($twig->isDebug()) {
      if (!class_exists('Kint')) {
        return 'Kint class doesn\'t exist! You can download it from <a href="https://wordpress.org/plugins/kint-debugger/">https://wordpress.org/plugins/kint-debugger/</a>';
      }
      if ($context) {
        Kint::dump($context);
      } else {
        Kint::dump($vars);
      }
    }
    // }
  }
  new Timber_Kint_Debug();
}
