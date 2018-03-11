<?php

/**
 * Plugin Name: Category Accordion List
 * Plugin URI: http://robert-paul-gass-portfolio.co.nf/?p=194
 * Description: Displays Categories in an Accordion Format
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

	// Run the constructor  and set the values for the Available Widgets area
	function __construct()
	{
		$params = array(
			'description' => 'Displays Categories in an Accordion List Structure',
			'name' => 'Category Accordion List',
		);

		parent::__construct('CategoryAccordionList', '', $params);
	}

	// Initialize the form display in the admin widget area
	public function form($instance)
	{
		// Extract the instance for the form
		extract($instance);

		?>
		<p>
		<b>Instructions:</b> Enter the title and choose whether to display the number of posts for each category.
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('RPGCatAccordionHeading'); ?>">Title: </label>
			<input class="widefat" id="<?php echo $this->get_field_id('RPGCatAccordionHeading'); ?>" name="<?php echo $this->get_field_name('RPGCatAccordionHeading'); ?>" value="<?php if( isset($RPGCatAccordionHeading) ) echo esc_attr($RPGCatAccordionHeading); ?>" />
		</p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('RPGCatAccordionShowPostNum'); ?>" name="<?php echo $this->get_field_name('RPGCatAccordionShowPostNum'); ?>" <?php echo (!empty($RPGCatAccordionShowPostNum)) ? 'checked' : ''; ?> />
		<label for="<?php echo $this->get_field_id('RPGCatAccordionShowPostNum'); ?>">Show number of posts</label>
		</p>
		<?php  


	}

	// This is the Widget Form displayed in the sidebar to the user
	public function widget($args, $instance)
	{
			// extract the arguments and the instance
			extract($args);
			extract($instance);	

			$RPGCatAccordionHeading = apply_filters('cat-acc-widget-heading', $RPGCatAccordionHeading);
			$RPGCatAccordionShowPostNum = apply_filters('cat-acc-widget-show-posts', $RPGCatAccordionShowPostNum);


			if( empty($RPGCatAccordionHeading) ) $RPGCatAccordionHeading = 'Categories';
			if( empty($RPGCatAccordionShowPostNum) ) $RPGCatAccordionShowPostNum = 'Show No Posts';

		echo $before_widget;
			echo $before_title . $RPGCatAccordionHeading . $after_title;

			echo $RPGCatAccordionShowPostNum;

		echo $after_widget;
	}


}
add_action('widgets_init', 'rpg_register_category_accordion_list');

// Register the Widget class declared above
function rpg_register_category_accordion_list() {
	register_widget('RPG_Category_Accordion_List');
}