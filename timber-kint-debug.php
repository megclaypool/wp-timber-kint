<?php
/*
 * Plugin Name: Twig Kint debug
 * Description: Debug Twig templates with Kint
 * Version: 1.0.0
 * Author: Kaido Toomingas
 * Author URI: http://web3.ee
 * Depends: Timber, Kint Debugger
 * */
if (!defined(ABSPATH)) {
  exit;
}
class Timber_Kint_Debug {
  function __construct() {
    add_filter('get_twig', array($this,'add_to_twig'));
  }
  function add_to_twig($twig) {
    $twig->addExtension(new Twig_Extension_StringLoader());
    $twig->addFunction(new Twig_SimpleFunction('kint', array($this, 'call_kint'),  array('is_safe' => array('html'), 'needs_context' => true, 'needs_environment' => true) ));
    return $twig;
  }
  function call_kint($twig, $vars, $context = FALSE) {
    if ($twig->isDebug()) {
      if (!class_exists('Kint')) {
        return 'Kint class doesn\'t exist! You can download it from <a href="https://wordpress.org/plugins/kint-debugger/">https://wordpress.org/plugins/kint-debugger/</a>';
      }
      if ($context) {
        Kint::dump($context);
      } else {
        Kint::dump($vars);
      }
    }
  }
}
new Timber_Kint_Debug();
