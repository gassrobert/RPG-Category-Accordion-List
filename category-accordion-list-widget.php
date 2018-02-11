<?php

/**
 * Plugin Name: Sidebar Tabs for Link Index
 * Plugin URI: http://robert-paul-gass-portfolio.co.nf/?p=194
 * Description: Displays Categories in n Accordion Format
 * Author: Robert Paul Gass
 * Author URI: http://robert-paul-gass-portfolio.co.nf/
 * Version: 1.0.0
 * License: GPLv2
 */

// Exit if accessed directly 
if ( ! defined('ABSPATH') ) {
	exit;
}

// Access the necessary scripts for the widget displayed in the sidebar
function load_rpg_category_accordion_list_styles_and_scripts() {

	wp_enqueue_script( 'rpgFrontCategoryAccordionListJs', plugins_url( 'js/rpg-category-accordion-list.js', __FILE__ ), array( 'jquery' ), '20180211', true );
	wp_enqueue_style( 'rpgFrontCategoryAccordionListCss', plugins_url( 'css/style.css', __FILE__ ));
}
add_action( 'wp_enqueue_scripts', 'load_rpg_category_accordion_list_styles_and_scripts' );


// The Widget Class
class RPG_Category_Accordion_List extends WP_Widget {

}
add_action('widgets_init', 'rpg_register_category_accordion_list');

// Register the Widget class declared above
function rpg_register_category_accordion_list() {
	register_widget('RPG_Category_Accordion_List');
}