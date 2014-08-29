<?php
/*
Plugin Name: Cat Creations cats_crete_subscription_post_type.php
Description: Part of CRG Cat Creations
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
//function bones_flush_rewrite_rules() {flush_rewrite_rules();}

// let's create the function for the custom type
function create_subscription_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'subscription', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Subscriptions', 'crg_cat_creations_text_domain' ), /* This is the Title of the Group */
			'singular_name' => __( 'Subscription', 'crg_cat_creations_text_domain' ), /* This is the individual type */
			'all_items' => __( 'All Subscriptions', 'crg_cat_creations_text_domain' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'crg_cat_creations_text_domain' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Subscription', 'crg_cat_creations_text_domain' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'crg_cat_creations_text_domain' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Subscriptions', 'crg_cat_creations_text_domain' ), /* Edit Display Title */
			'new_item' => __( 'New Subscription', 'crg_cat_creations_text_domain' ), /* New Display Title */
			'view_item' => __( 'View Subscription', 'crg_cat_creations_text_domain' ), /* View Display Title */
			'search_items' => __( 'Search Subscription', 'crg_cat_creations_text_domain' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'crg_cat_creations_text_domain' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'crg_cat_creations_text_domain' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example Subscription', 'crg_cat_creations_text_domain' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => plugins_url() . '/crg_cat_creations/images/cat-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'subscription', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'subscription', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'subscription' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'subscription' );
	
}
?>
