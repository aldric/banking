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
define('__ROOT__', realpath(dirname(__FILE__)));



include(__ROOT__.'/class/Bank_Repository.php');
include(__ROOT__.'/class/Helpers.php');
include(__ROOT__."/ViewRenderer.php");
include(__ROOT__. "/widgets/ranking.widget.php");
include(__ROOT__. "/widgets/bankbanner.widget.php");
include(__ROOT__. "/widgets/bankHierarchy.widget.php");
include(__ROOT__. "/shortcodes/bankranking.php");
include(__ROOT__. "/shortcodes/bankcarousel.php");
include(__ROOT__. "/shortcodes/proscons.php");
include(__ROOT__. "/shortcodes/bankbox.php");
include(__ROOT__."/class/BankReviewJson.php");


function banking_plugin_enqueue_styles()
{
    $template_directory = plugin_dir_url(__FILE__);
    wp_register_style('banking-css', $template_directory.'/banking.css', false, null, 'all');
    wp_enqueue_style('banking-css');
}

add_action('wp_enqueue_scripts', 'banking_plugin_enqueue_styles', 16);

add_filter('no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize', 10, 1);
function shortcodes_to_exempt_from_wptexturize($shortcodes)
{
    $shortcodes[] = 'bankcarousel';
    $shortcodes[] = 'bank-slide';
    $shortcodes[] = 'bankranking';
    $shortcodes[] = 'bank-box';
    $shortcodes[] = 'proscons';
    return $shortcodes;
}

function custom_wpautop($content)
{
    if (get_post_meta(get_the_ID(), 'wpautop', true) == 'false') {
        return $content;
    } else {
        return wpautop($content);
    }
}

remove_filter('the_content', 'wpautop');
add_filter('the_content', 'custom_wpautop', 12);

function add_scriptfilter($string)
{
    global $allowedtags;
    $allowedtags['script'] = array( 'src' => array() );
    return $string;
}
add_filter('pre_kses', 'add_scriptfilter');
