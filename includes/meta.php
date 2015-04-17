<?php





/**
 * Adds a box to the main column on the Post and Page edit screens.
 */


function meme_register() {
 
        $labels = array(
                'name' => _x('Meme', 'post type general name'),
                'singular_name' => _x('Meme', 'post type singular name'),
                'add_new' => _x('Add Meme', 't-shirt'),
                'add_new_item' => __('Add Meme'),
                'edit_item' => __('Edit Meme'),
                'new_item' => __('New Meme'),
                'view_item' => __('View Meme'),
                'search_items' => __('Search Meme'),
                'not_found' =>  __('Nothing found'),
                'not_found_in_trash' => __('Nothing found in Trash'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => 'dashicons-nametag',
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title','thumbnail'),
				

          );
 
        register_post_type( 'meme' , $args );

}


add_action('init', 'meme_register');




function meme_cat_taxonomies() {
 
        register_taxonomy('meme_cat', 'meme', array(
                // Hierarchical taxonomy (like categories)
                'hierarchical' => true,
                'show_admin_column' => true,
                // This array of options controls the labels displayed in the WordPress Admin UI
                'labels' => array(
                        'name' => _x( 'Meme Categories', 'taxonomy general name' ),
                        'singular_name' => _x( 'Meme Categories', 'taxonomy singular name' ),
                        'search_items' =>  __( 'Search Meme Categories' ),
                        'all_items' => __( 'All Meme Categories' ),
                        'parent_item' => __( 'Parent Meme Categories' ),
                        'parent_item_colon' => __( 'Parent Meme Categories:' ),
                        'edit_item' => __( 'Edit Meme Categories' ),
                        'update_item' => __( 'Update Meme Categories' ),
                        'add_new_item' => __( 'Add Meme Categories' ),
                        'new_item_name' => __( 'New Meme Categories Name' ),
                        'menu_name' => __( 'Meme Categories' ),
						
                ),
                // Control the slugs used for this taxonomy
                'rewrite' => array(
                        'slug' => 'meme_cat', // This controls the base slug that will display before each term
                        'with_front' => false, // Don't display the category base before "/locations/"
                        'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
                ),
        ));
}
add_action( 'init', 'meme_cat_taxonomies', 0 );

















function meme_sticker_register() {
 
        $labels = array(
                'name' => _x('Meme Sticker', 'post type general name'),
                'singular_name' => _x('Sticker', 'post type singular name'),
                'add_new' => _x('Add Sticker', 't-shirt'),
                'add_new_item' => __('Add Sticker'),
                'edit_item' => __('Edit Sticker'),
                'new_item' => __('New Sticker'),
                'view_item' => __('View Sticker'),
                'search_items' => __('Search Sticker'),
                'not_found' =>  __('Nothing found'),
                'not_found_in_trash' => __('Nothing found in Trash'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => 'dashicons-nametag',
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title','thumbnail'),
				

          );
 
        register_post_type( 'meme_sticker' , $args );

}


add_action('init', 'meme_sticker_register');


// Custom Taxonomy
 
function meme_sticker_cat_taxonomies() {
 
        register_taxonomy('meme_sticker_cat', 'meme_sticker', array(
                // Hierarchical taxonomy (like categories)
                'hierarchical' => true,
                'show_admin_column' => true,
                // This array of options controls the labels displayed in the WordPress Admin UI
                'labels' => array(
                        'name' => _x( 'Sticker Categories', 'taxonomy general name' ),
                        'singular_name' => _x( 'Sticker Categories', 'taxonomy singular name' ),
                        'search_items' =>  __( 'Search Sticker Categories' ),
                        'all_items' => __( 'All Sticker Categories' ),
                        'parent_item' => __( 'Parent Sticker Categories' ),
                        'parent_item_colon' => __( 'Parent Sticker Categories:' ),
                        'edit_item' => __( 'Edit Sticker Categories' ),
                        'update_item' => __( 'Update Sticker Categories' ),
                        'add_new_item' => __( 'Add Sticker Categories' ),
                        'new_item_name' => __( 'New Sticker Categories Name' ),
                        'menu_name' => __( 'Sticker Categories' ),
						
                ),
                // Control the slugs used for this taxonomy
                'rewrite' => array(
                        'slug' => 'meme_sticker_cat', // This controls the base slug that will display before each term
                        'with_front' => false, // Don't display the category base before "/locations/"
                        'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
                ),
        ));
}
add_action( 'init', 'meme_sticker_cat_taxonomies', 0 );
