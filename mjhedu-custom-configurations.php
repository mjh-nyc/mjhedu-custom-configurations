<?php 
/*
Plugin Name: Musuem of Jewish Heritage Education Custom Configurations
Description: This plugin registers Musuem of Jewish Heritage Education custom configurations.
Version: 1.0.0
License: GPLv2
*/
// set acf pro save json directory
add_filter('acf/settings/save_json', function($path) {
    return WPMU_PLUGIN_DIR . '/mjhedu-custom-configurations/acf-json';
});
// set acf pro load json directory
add_filter('acf/settings/load_json', function($paths) {
    unset($paths[0]);
    $paths[] = WPMU_PLUGIN_DIR . '/mjhedu-custom-configurations/acf-json';
    return $paths;
});


//************************************//
// Change label of Post to Survivor Stories

/*function mjhedu_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Survivor Stories';
    $submenu['edit.php'][5][0] = 'Stories';
    $submenu['edit.php'][10][0] = 'Add Story';
    $submenu['edit.php'][16][0] = 'Story Tags';
}
add_action( 'admin_menu', 'mjhedu_change_post_label' );
function mjhedu_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Survivor Stories';
    $labels->singular_name = 'Survivor Story';
    $labels->add_new = 'Add Survivor Story';
    $labels->add_new_item = 'Add Survivor Story';
    $labels->edit_item = 'Edit Survivor Story';
    $labels->new_item = 'Survivor Story';
    $labels->view_item = 'View Survivor Story';
    $labels->search_items = 'Search Survivor Stories';
    $labels->not_found = 'No Stories Found';
    $labels->not_found_in_trash = 'No Stories Found in Trash';
    $labels->all_items = 'All Survivor Stories';
    $labels->menu_name = 'Survivor Stories';
    $labels->name_admin_bar = 'Survivor Stories';
}
add_action( 'init', 'mjhedu_change_post_object' );
*/
//**********  //END LABEL CHANGE  **************************//


// Register custom post types
function mjhedu_create_post_types() {
    // Register lesson plans
	$lesson_labels = array(
 		'name' => 'Lesson Plans',
    	'singular_name' => 'Lesson Plan',
    	'add_new' => 'Add New Lesson Plan',
    	'add_new_item' => 'Add New Lesson Plan',
    	'edit_item' => 'Edit Lesson Plan',
    	'new_item' => 'New Lesson Plan',
    	'all_items' => 'All Lesson Plans',
    	'view_item' => 'View Lesson Plan',
    	'search_items' => 'Search Lesson Plans',
    	'not_found' =>  'No Lesson Plans Found',
    	'not_found_in_trash' => 'No Lesson Plans Found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Lesson Plans',
    );
	register_post_type( 'lessons', array(
		'labels' => $lesson_labels,
        'menu_icon' => 'dashicons-clipboard',
		'has_archive' => true,
 		'public' => true,
		'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail','page-attributes' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'lessons' ),
		'menu_position' => 5
		)
	);
	register_lesson_category();
}
add_action( 'init', 'mjhedu_create_post_types' );
function register_lesson_category(){
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Lesson Plan Categories', 'taxonomy general name', 'sage' ),
		'singular_name'     => _x( 'Lesson Plan Category', 'taxonomy singular name', 'sage' ),
		'search_items'      => __( 'Search Lesson Plan Categories', 'sage' ),
		'all_items'         => __( 'All Lesson Plan Categories', 'sage' ),
		'parent_item'       => __( 'Parent Lesson Plan Category', 'sage' ),
		'parent_item_colon' => __( 'Parent Lesson Plan Category:', 'sage' ),
		'edit_item'         => __( 'Edit Lesson Plan Category', 'sage' ),
		'update_item'       => __( 'Update Lesson Plan Category', 'sage' ),
		'add_new_item'      => __( 'Add New Lesson Plan Category', 'sage' ),
		'new_item_name'     => __( 'New Lesson Plan Category Name', 'sage' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'lesson-category' ),
	);

	register_taxonomy( 'lesson_category', array( 'lessons' ), $args );
}
?>