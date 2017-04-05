<?php
/**
 * @package Topbanque_Banking
 * @version 0.1
 */
/*
Plugin Name: Topbanque Banking
Description: All we need to handle our site
Author: Aldric Gaudinot
Version: 1.6

*/

include(realpath(dirname(__FILE__)) . "/widgets/ranking.widget.php");
include(realpath(dirname(__FILE__)) . "/widgets/bankbanner.widget.php");
include(realpath(dirname(__FILE__)) . "/widgets/bankHierarchy.widget.php");
include(realpath(dirname(__FILE__)) . "/shortcodes/bankranking.php");
include(realpath(dirname(__FILE__)) . "/shortcodes/bankcarousel.php");
include(realpath(dirname(__FILE__)) . "/shortcodes/proscons.php");
include(realpath(dirname(__FILE__)) ."/class/BankReviewJson.php");

function banking_plugin_enqueue_styles()
{
     $template_directory = plugin_dir_url( __FILE__ );
     wp_register_style('banking-css', $template_directory.'/banking.css', false, null, 'all');
     wp_enqueue_style('banking-css');
}

add_action('wp_enqueue_scripts', 'banking_plugin_enqueue_styles', 15);

add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );
function shortcodes_to_exempt_from_wptexturize( $shortcodes ) {
  $shortcodes[] = 'bankcarousel';
  $shortcodes[] = 'bank-slide';
  $shortcodes[] = 'bankranking';
  $shortcodes[] = 'proscons';
return $shortcodes;
}
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);
