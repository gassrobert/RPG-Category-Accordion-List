<?php

/**
 * Plugin Name: Category Accordion List
 * Plugin URI: http://robert-paul-gass-portfolio.co.nf/
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

		echo $before_widget;
		echo $before_title . esc_html($RPGCatAccordionHeading) . $after_title;
			?>
		<div class="rpgCatAccordion">
			<ul>
			<?php $parents = get_categories(array('parent' => 0, 'hide_empty' => 1));
			    if(!empty($parents)){
			    	$AccID = 0;
			        foreach($parents as $parent){
			        	$current_category = get_category($parent->term_id);

			?>
			        <li>
			            <h3 class="rpgAccordionHeading" id="<?php echo 'AccID' . $AccID; ?>"><a class="rpgAccordionHeadingLink" href="<?php echo get_category_link( $parent->term_id ); ?>"><?php echo esc_html($parent->name); ?><?php echo (!empty($RPGCatAccordionShowPostNum)) ? (" (" . $parent->count . ")" ) : ''; ?></a></h3>
			            <?php
			            	if (is_category()) {
			            		$term = get_queried_object();

			            		if (!$term->category_parent) {
			            			$category_slug = $term->slug;
			            			$current_slug_in_list = $parent->slug;
			            		} else {
									$category_parent_id = $term->category_parent;
									if ( $category_parent_id != 0 ) {
									    $category_parent = get_term( $category_parent_id, 'category' );
									    $css_slug = $category_parent->slug;
									} else {
									    $css_slug = $category[0]->slug;
									}
									$currently_selected_slug = $css_slug;
									$current_slug_in_list = $parent->slug;
			            		}
			            	}

			            ?>
			            <div class="rpgAccordionSubmenu" id="<?php echo 'subMenu' . $AccID; ?>" <?php if ((is_category() && $currently_selected_slug == $current_slug_in_list) || (is_category() && $category_slug == $current_slug_in_list)) { ?> style="display: block;" <?php } else { ?> style="display: none;" <?php } ?> >
				            <ul>
				            <?php 
				            	$parent_id = $parent->term_id;
								$args = array('child_of' => $parent_id);
								$sub_categories = get_categories( $args );
								foreach($sub_categories as $sub_category) { 
				            ?>
								<a href="<?php echo get_category_link( $sub_category->term_id ); ?>"><li class="rpgAccordion"><?php echo esc_html($sub_category->name); ?><?php echo (!empty($RPGCatAccordionShowPostNum)) ? (" (" . $sub_category->count . ")" ) : ''; ?></li></a>
							<?php
								}
							?>
				            </ul>
			            </div>
			        </li>
			<?php
					$AccID++;
			        }
			    } else { 
			?>
			    <li>No Categories</li>
			<?php } ?>
			</ul>
		</div>
			<?php
		echo $after_widget;
	}


}
add_action('widgets_init', 'rpg_register_category_accordion_list');

// Register the Widget class declared above
function rpg_register_category_accordion_list() {
	register_widget('RPG_Category_Accordion_List');
}