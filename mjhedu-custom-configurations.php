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


//******************************************************************//
// REIGSTER CUSTOM POST TYPES ////////////////////////////////////////
function mjhedu_create_post_types() {
    // Register lesson plans
	$lesson_labels = array(
 		'name' => 'Lesson Plans',
    	'singular_name' => 'Lesson Plan',
    	'add_new' => 'Add Lesson Plan',
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
        'show_in_nav_menus' => true,
		'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail','page-attributes','excerpt' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'lessons' ),
		'menu_position' => 5,
        'taxonomies'  => array( 'category' )
		)
	);
    //End lesson plans

    // Register timeline content type
    $timeline_labels = array(
        'name' => 'Timeline',
        'singular_name' => 'Timeline',
        'add_new' => 'Add Timeline Item',
        'add_new_item' => 'Add New Timeline Item',
        'edit_item' => 'Edit Timeline Item',
        'new_item' => 'New Timeline Item',
        'all_items' => 'All Timeline Items',
        'view_item' => 'View Timeline Item',
        'search_items' => 'Search Timeline',
        'not_found' =>  'No Timeline Items Found',
        'not_found_in_trash' => 'No Timeline Items Found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Timeline',
    );
    register_post_type( 'timeline', array(
        'labels' => $timeline_labels,
        'menu_icon' => 'dashicons-randomize',
        'has_archive' => true,
        'public' => true,
        'supports' => array( 'title', 'editor', 'custom-fields', 'page-attributes' ),
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => 'timeline/%timeline_category%', 'with_front' => false ),
        'menu_position' => 6,
        'taxonomies'  => array( 'category' )
        )
    );
    //Create timline taxonomy
    register_timeline_category();
    //End timeline



    // Register Survivor Stories content type
    $survivor_story_labels = array(
        'name' => 'Survivor Stories',
        'singular_name' => 'Survivor Story',
        'add_new' => 'Add Survivor Story',
        'add_new_item' => 'Add New Survivor Story',
        'edit_item' => 'Edit Survivor Story',
        'new_item' => 'New Survivor Story',
        'all_items' => 'All Survivor Stories',
        'view_item' => 'View Survivor Story',
        'search_items' => 'Search Survivor Stories',
        'not_found' =>  'No Survivor Stories Found',
        'not_found_in_trash' => 'No Survivor Stories Found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Survivor Stories',
    );
    register_post_type( 'survivor_story', array(
        'labels' => $survivor_story_labels,
        'menu_icon' => 'dashicons-microphone',
        'has_archive' => 'survivor',
        'public' => true,
        'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes' ),
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => 'survivor-stories', 'with_front' => false ),
        'menu_position' => 7,
        'taxonomies'  => array( 'category' )
        )
    );
    //Create survivor stories taxonomy, survivor story taxonomy is a list of survivors
    register_survivor_name();
    //End survivor stories



    //Create Survivor Resources CPT
    $survivor_resources_labels = array(
        'name' => 'Survivor Resources',
        'singular_name' => 'Survivor Resources',
        'add_new' => 'Add Resources',
        'add_new_item' => 'Add New Survivor Resources',
        'edit_item' => 'Edit Survivor Resources',
        'new_item' => 'New Survivor Resources',
        'all_items' => 'All Resources',
        'view_item' => 'View Survivor Resources',
        'search_items' => 'Search Survivor Resources',
        'not_found' =>  'No Survivor Resources Found',
        'not_found_in_trash' => 'No Survivor Resources Found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Survivor Resources',
    );
    register_post_type( 'survivor_resources', array(
        'labels' => $survivor_resources_labels,
        'menu_icon' => 'dashicons-album',
        'has_archive' => true,
        'public' => true,
        'supports' => array( 'title', 'editor', 'custom-fields', 'page-attributes'),
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => 'survivor-resources/%survivors%', 'with_front' => false ),
        'menu_position' => 7,
        'taxonomies'  => array( 'category' )
        )
    );
    //Create survivor resources taxonomy
    register_resources_taxonomy();
    //End survivor resources CPT



    // Register Glossary CPT
    $glossary_labels = array(
        'name' => 'Glossary',
        'singular_name' => 'Glossary',
        'add_new' => 'Add Glossary Item',
        'add_new_item' => 'Add Glossary Item',
        'edit_item' => 'Edit Glossary Item',
        'new_item' => 'New Glossary Item',
        'all_items' => 'All Glossary Items',
        'view_item' => 'View Glossary Item',
        'search_items' => 'Search Glossary',
        'not_found' =>  'No Glossary Items Found',
        'not_found_in_trash' => 'No Glossary Items Found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Glossary',
    );
    register_post_type( 'glossary', array(
        'labels' => $glossary_labels,
        'menu_icon' => 'dashicons-book-alt',
        'has_archive' => false,
        'public' => true,
        'supports' => array( 'title', 'editor', 'custom-fields'),
        'exclude_from_search' => true,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => 'glossary' )
        )
    );
    //End glossary CPT


    // Register Media Resources (Book, Films, Websites) CPT
    $media_resources_labels = array(
        'name' => 'Media Resources',
        'singular_name' => 'Media Resource',
        'add_new' => 'Add Media Resource',
        'add_new_item' => 'Add Media Resource',
        'edit_item' => 'Edit Media Resource',
        'new_item' => 'New Media Resource',
        'all_items' => 'Media Resources',
        'view_item' => 'View Media Resource',
        'search_items' => 'Search Media Resources',
        'not_found' =>  'No Media Resources Found',
        'not_found_in_trash' => 'No Media Resources Found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Media Resources',
    );
    register_post_type( 'media_resources', array(
        'labels' => $media_resources_labels,
        'has_archive' => false,
        'public' => true,
        'supports' => array( 'title', 'custom-fields'),
        'exclude_from_search' => true,
        'capability_type' => 'post',
        'show_in_menu' => 'edit.php?post_type=survivor_resources',
        'rewrite' => array( 'slug' => 'media-resources' )
        )
    );
    register_media_resources_taxonomy();
    //End media resources

    //Register Artifacts CPT
    $artifacts_labels = array(
        'name' => 'Artifacts',
        'singular_name' => 'Artifact',
        'add_new' => 'Add Artifact',
        'add_new_item' => 'Add Artifact',
        'edit_item' => 'Edit Artifact',
        'new_item' => 'New Artifact',
        'all_items' => 'Artifacts',
        'view_item' => 'View Artifacts',
        'search_items' => 'Search Artifacts',
        'not_found' =>  'No Artifacts Found',
        'not_found_in_trash' => 'No Artifacts Found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Artifacts',
    );
    register_post_type( 'artifacts', array(
        'labels' => $artifacts_labels,
        'menu_icon' => 'dashicons-images-alt2',
        'has_archive' => true,
        'public' => true,
        'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail'),
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => 'artifacts' )
        )
    );


    // Register testimony post type
    $testimony_labels = array(
        'name' => 'Testimonies',
        'singular_name' => 'Testimony',
        'add_new' => 'Add New Testimony',
        'add_new_item' => 'Add New Testimony',
        'edit_item' => 'Edit Testimony',
        'new_item' => 'New Testimony',
        'all_items' => 'Testimonies',
        'view_item' => 'View Testimony',
        'search_items' => 'Search Testimonies',
        'not_found' =>  'No Testimonies Found',
        'not_found_in_trash' => 'No Testimonies Found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Testimonies',
    );
    register_post_type( 'testimony', array(
        'labels' => $testimony_labels,
        'menu_icon' => 'dashicons-video-alt',
        'has_archive' => true,
        'public' => true,
        'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail','page-attributes' ),
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => 'testimonies' ),
        )
    );


    // Register events
    $event_labels = array(
        'name' => 'Events',
        'singular_name' => 'Event',
        'add_new' => 'Add New Event',
        'add_new_item' => 'Add New Event',
        'edit_item' => 'Edit Event',
        'new_item' => 'New Event',
        'all_items' => 'All Events',
        'view_item' => 'View Event',
        'search_items' => 'Search Events',
        'not_found' =>  'No Events Found',
        'not_found_in_trash' => 'No Events Found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Events',
    );
    register_post_type( 'event', array(
        'labels' => $event_labels,
        'menu_icon' => 'dashicons-calendar-alt',
        'has_archive' => true,
        'public' => true,
        'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => 'events' ),
        )
    );
    register_event_category();

}
add_action( 'init', 'mjhedu_create_post_types' );
// END CUSTOM POST TYPES ////////////////////////////////////////
//******************************************************************//



//******************************************************************//
// CREATE CUSTOM TAXONOMIES ////////////////////////////////////////

/*function register_lesson_category(){
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
}*/
function register_timeline_category(){
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Timeline Categories', 'taxonomy general name', 'sage' ),
        'singular_name'     => _x( 'Timeline Category', 'taxonomy singular name', 'sage' ),
        'search_items'      => __( 'Search Timeline Categories', 'sage' ),
        'all_items'         => __( 'All Timeline Categories', 'sage' ),
        'parent_item'       => __( 'Parent Timeline Category', 'sage' ),
        'parent_item_colon' => __( 'Parent Timeline Category:', 'sage' ),
        'edit_item'         => __( 'Edit Timeline Category', 'sage' ),
        'update_item'       => __( 'Update Timeline Category', 'sage' ),
        'add_new_item'      => __( 'Add New Timeline Category', 'sage' ),
        'new_item_name'     => __( 'New Timeline Category Name', 'sage' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'timeline-category' ),
    );

    register_taxonomy( 'timeline_category', array( 'timeline' ), $args );
}

//SURVIVORS TAXONOMY
function register_survivor_name(){
    // Add new taxonomy, make it non-hierarchical
    $labels = array(
        'name'              => _x( 'Survivors', 'taxonomy general name', 'sage' ),
        'singular_name'     => _x( 'Survivor Name', 'taxonomy singular name', 'sage' ),
        'search_items'      => __( 'Search Survivors', 'sage' ),
        'all_items'         => __( 'All Survivors', 'sage' ),
        'edit_item'         => __( 'Edit Survivor Name', 'sage' ),
        'update_item'       => __( 'Update Survivor Name', 'sage' ),
        'add_new_item'      => __( 'Add Survivor', 'sage' ),
        'new_item_name'     => __( 'New Survivor Name', 'sage' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'survivor' ),
    );

    register_taxonomy( 'survivors', array( 'survivor_story','timeline','survivor_resources' ), $args );
}

//SURVIVORS TAXONOMY
function register_resources_taxonomy(){
    // Add new taxonomy, make it non-hierarchical
    $labels = array(
        'name'              => _x( 'Resource Categories', 'taxonomy general name', 'sage' ),
        'singular_name'     => _x( 'Resource Category', 'taxonomy singular name', 'sage' ),
        'search_items'      => __( 'Search Resource Categories', 'sage' ),
        'all_items'         => __( 'All Resource Categories', 'sage' ),
        'edit_item'         => __( 'Edit Resource Category', 'sage' ),
        'update_item'       => __( 'Update Resource Category', 'sage' ),
        'add_new_item'      => __( 'Add Resource Category', 'sage' ),
        'new_item_name'     => __( 'New Resource Category', 'sage' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'resource-type' ),
    );

    register_taxonomy( 'resource_category', array( 'survivor_resources' ), $args );
}

//Media resources taxonomy
function register_media_resources_taxonomy(){
    // Add new taxonomy, make it non-hierarchical
    $labels = array(
        'name'              => _x( 'Media Categories', 'taxonomy general name', 'sage' ),
        'singular_name'     => _x( 'Media Category', 'taxonomy singular name', 'sage' ),
        'search_items'      => __( 'Search Media Categories', 'sage' ),
        'all_items'         => __( 'All Media Categories', 'sage' ),
        'edit_item'         => __( 'Edit Media Category', 'sage' ),
        'update_item'       => __( 'Update Media Category', 'sage' ),
        'add_new_item'      => __( 'Add Media Category', 'sage' ),
        'new_item_name'     => __( 'New Media Category', 'sage' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'media-type' ),
    );

    register_taxonomy( 'media_resources_category', array( 'media_resources' ), $args );
}

//Register Event Categories Taxonomy
function register_event_category(){
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Event Categories', 'taxonomy general name', 'sage' ),
        'singular_name'     => _x( 'Event Category', 'taxonomy singular name', 'sage' ),
        'search_items'      => __( 'Search Event Categories', 'sage' ),
        'all_items'         => __( 'All Event Categories', 'sage' ),
        'parent_item'       => __( 'Parent Event Category', 'sage' ),
        'parent_item_colon' => __( 'Parent Event Category:', 'sage' ),
        'edit_item'         => __( 'Edit Event Category', 'sage' ),
        'update_item'       => __( 'Update Event Category', 'sage' ),
        'add_new_item'      => __( 'Add New Event Category', 'sage' ),
        'new_item_name'     => __( 'New Event Category Name', 'sage' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'event-category' ),
    );

    register_taxonomy( 'event_category', array( 'event' ), $args );
}

// END CUSTOM TAXONOMIES ////////////////////////////////////////
//******************************************************************//



//******************************************************************//
// REWRITE CUSTOM POST TYPES SLUGS ///////////////////////////////////
//SURVIVORS && //SURVIVOR RESOURCES
function wpa_survivors_permalinks( $post_link, $post ){
    if ( is_object( $post ) && ($post->post_type == 'survivor_story' || $post->post_type == 'survivor_resources')){
        $terms = wp_get_object_terms( $post->ID, 'survivors' );
        if( $terms ){
            return str_replace( '%survivors%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'wpa_survivors_permalinks', 1, 2 );

//TIMELINE
function wpa_timeline_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'timeline' ){
        $terms = wp_get_object_terms( $post->ID, 'timeline_category' );
        if( $terms ){
            return str_replace( '%timeline_category%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'wpa_timeline_permalinks', 1, 2 );


// END CUSTOM POST TYPES REWRITES ///////////////////////////////////
//******************************************************************//


//******************************************************************//
// ADD FILTER BY CUSTOM TAXONOMY ///////////////////////////////////
function add_filters_to_adminview( $post_type, $which ) {
    // Apply this only to specific post types
    if ( 'survivor_story' !== $post_type && 
         'timeline' !== $post_type &&
         'survivor_resources' !== $post_type && 
         'media_resources' !== $post_type)
        return;

    switch ($post_type) {
        case 'survivor_story':
            // A list of taxonomy slugs to filter by
            $taxonomies = array( 'survivors' );
            break;
        case 'timeline':
            // A list of taxonomy slugs to filter by
            $taxonomies = array( 'survivors','timeline_category' );
            break;
        case 'survivor_resources':
            // A list of taxonomy slugs to filter by
            $taxonomies = array( 'resource_category','survivors' );
            break;
        case 'media_resources':
            // A list of taxonomy slugs to filter by
            $taxonomies = array( 'media_resources_category' );
            break;
    }
    
    foreach ( $taxonomies as $taxonomy_slug ) {

        // Retrieve taxonomy data
        $taxonomy_obj = get_taxonomy( $taxonomy_slug );
        $taxonomy_name = $taxonomy_obj->labels->name;

        // Retrieve taxonomy terms
        $terms = get_terms( $taxonomy_slug );

        // Display filter HTML
        echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
        echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
        foreach ( $terms as $term ) {
            printf(
                '<option value="%1$s" %2$s>%3$s</option>', //(%4$s)
                $term->slug,
                ( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
                $term->name,
                $term->count
            );
        }
        echo '</select>';
    }

}
add_action( 'restrict_manage_posts', 'add_filters_to_adminview' , 10, 2);

// END FILTER BY CUSTOM TAXONOMY ///////////////////////////////////
/******************************************************************/




//**************************************************************//
// HIDE DEFAULT ADMIN LINKS ////////////////////////////////////////

//The Side Menu
add_action( 'admin_menu', 'remove_default_post_type' );

function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}
//The +New Post in Admin Bar
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}
//The Quick Draft Dashboard Widget
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );

function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}

//Remove comments
add_action( 'admin_menu', 'remove_comments' );

function remove_comments() {
    remove_menu_page( 'edit-comments.php' );
}
//**********  //END HIDE ADMIN LINKS **************************//


/**
 * Use radio inputs instead of checkboxes for term checklists in specified taxonomies.
 *
 * @param   array   $args
 * @return  array
 */
function wpse_139269_term_radio_checklist( $args ) {
    if ( (! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'survivors') ||
         (! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'timeline_category') ||
         (! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'resource_category') ||
         (! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'media_resources_category')) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                /**
                 * Custom walker for switching checkbox inputs to radio.
                 *
                 * @see Walker_Category_Checklist
                 */
                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, $args = array() ) {
                        $output = parent::walk( $elements, $max_depth, $args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );

                        return $output;
                    }
                }
            }

            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
        }
    }

    return $args;
}

add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist' );

// END CHECKBOX TO RADIO BTN UPDATE ////////////////////////////////
//******************************************************************//



//******************************************************************//
// HIDE PUBLISH DATE FILTERS IN ADMIN ////////////////////////////////
add_action('admin_head', 'my_custom_admin_css');

function my_custom_admin_css() {
  echo '<style>
    .post-type-survivor_story #posts-filter .tablenav select#filter-by-date,
    .post-type-timeline #posts-filter .tablenav select#filter-by-date,

    .post-type-lessons #posts-filter .tablenav select#filter-by-date,
    .post-type-lessons #posts-filter .tablenav #post-query-submit,

    .post-type-survivor_resources #posts-filter .tablenav select#filter-by-date,

    .post-type-media_resources #posts-filter .tablenav select#filter-by-date
    {
        display:none;
    }

  </style>';
}
// END HIDE PUBLISH DATE FILTERS IN ADMIN ////////////////////////////////
//******************************************************************//


//******************************************************************//
// REMOVE DEFAULT DASHBOARD WIDGETS ////////////////////////////////
function remove_dashboard_meta() {
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
    
}
add_action( 'admin_init', 'remove_dashboard_meta' );
remove_action('welcome_panel', 'wp_welcome_panel');
//END REMOVE DASHBOARD WIDGETS
//***************************************************************//




//***************************************************************//
// ADD CUSTOM DASHBOARD WIDGETS ////////////////////////////////
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
  
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Welcome!', 'custom_dashboard_help');
}
 
function custom_dashboard_help() {
echo '<p>This custom theme and admin menu have been devloped by <a href="mailto:info@cloudred.com">Cloudred</a>. If you’re a developer, please see the mjhedu-custom-configurations.php file for all customization options.</p>';
}
//END ADD DASHBOARD WIDGETS
//***************************************************************//



//***************************************************************//
// RENAME CATEGROIES TO THEMES ////////////////////////////////
function change_cat_object() {
    global $wp_taxonomies;
    $labels = &$wp_taxonomies['category']->labels;
    $labels->name = 'Themes';
    $labels->singular_name = 'Theme';
    $labels->add_new = 'Add Theme';
    $labels->add_new_item = 'Add Theme';
    $labels->edit_item = 'Edit Theme';
    $labels->new_item = 'Theme';
    $labels->view_item = 'View Theme';
    $labels->search_items = 'Search Themes';
    $labels->not_found = 'No Themes found';
    $labels->not_found_in_trash = 'No Themes found in Trash';
    $labels->all_items = 'All Themes';
    $labels->menu_name = 'Themes';
    $labels->name_admin_bar = 'Themes';
}
add_action( 'init', 'change_cat_object' );
//END RENAME CATEGROIES TO THEMES
//***************************************************************//

//***************************************************************//
// ACF PRO REMOVE FRONT END CSS ////////////////////////////////
function mjh_dequeue_acf_pro_frontend_css() {
	wp_dequeue_style('acf-global');
	wp_deregister_style('acf-global');
	wp_dequeue_style('acf-input' );
	wp_deregister_style('acf-input' );
	wp_dequeue_style('acf-field-group');
	wp_deregister_style('acf-field-group');
}
 add_action('wp_enqueue_scripts','mjh_dequeue_acf_pro_frontend_css',100);
//END ACF PRO REMOVE FRONT END CSS
//***************************************************************//

//***************************************************************//
// CLEANUP EMAIL SENDER NAME ////////////////////////////////
// Function to change sender name
function mjh_sender_name( $original_email_from ) {
	return html_entity_decode($original_email_from,ENT_QUOTES);
}
add_filter( 'wp_mail_from_name', 'mjh_sender_name', 20 );
//END CLEANUP EMAIL SENDER NAME
//***************************************************************//
?>