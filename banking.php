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
include(realpath(dirname(__FILE__)) . "/shortcodes/proscons.php");
include(realpath(dirname(__FILE__)) ."/class/BankReviewJson.php");

function banking_plugin_enqueue_styles()
{
    $template_directory = plugin_dir_url(__FILE__);
    wp_register_script('star-rating-js', $template_directory.'/star-rating/js/star-rating.min.js', array('jquery'), null, true);
    wp_register_style('star-rating-css', $template_directory.'/star-rating/css/star-rating.min.css', false, null, 'all');
    wp_enqueue_script('star-rating-js');
    wp_enqueue_style('star-rating-css');
}

add_action('wp_enqueue_scripts', 'banking_plugin_enqueue_styles', 15);
