<?php
/*
Plugin Name: CRG Cat Creations
Plugin URI: http://asiascatcreations.com
Description: The plugin for Asia's Cat Creations!
Version: 1.0
Author: Custom Ray Guns
Author URI: http://customrayguns.com
*/

$crg_cat_creations_plugin = new crg_cat_creations_plugin;

class crg_cat_creations_plugin{

	function __construct(){

		//Creates the custom post type "subscription":
		$include_file = plugin_dir_path( __FILE__ ) . "subscription_post_type.php";
		include_once($include_file);
		add_action( 'init', 'create_subscription_post_type');

		//the shortcode [add-cat] outputs the form for creating a new 'subscription' post type
		$include_file = plugin_dir_path( __FILE__ ) . "add_cat_shortcode.php";
		include_once($include_file);
		$add_cat_shortcode = new add_cat_shortcode;

		if (isset($_GET['crg_delete'])){
			add_action('init','crg_delete_subscription');
		}

		//the receiver accepts the input from the [add-cat] form and the "author" subscription CPT view
		//the receiver starts up when crg_cats_name is submitted.
		if (isset($_POST['crg_cats_name']) ){
			$include_file = plugin_dir_path( __FILE__ ) . "add_cat_receiver.php";
			include_once($include_file);
			$add_cat_receiver = new add_cat_receiver;
		}

		//A 'subscription' CPT has two additional views. Author [customer] View, and Promo view
		$include_file = plugin_dir_path( __FILE__ ) . "subscription_view_controller.php";
		include_once($include_file);
		$feline_view_controller = new subscription_view_controller;

	}

}

function crg_delete_subscription(){
	wp_delete_post($_GET['crg_delete']);
	wp_redirect('/add-cat/');
	exit;
}

function subscription_roll(){
	global $current_user;
	$user_id = get_current_user_id();
	$args = array(
		'post_type' => 'subscription',
		'author' => $user_id,
	);
	$subscription_roll_output = "<div id = 'crg_subscription_roll_div'>";
	$your_cats_roll = new WP_Query( $args );
	if( $your_cats_roll->have_posts() ) {
		while($your_cats_roll->have_posts() ) {
			$your_cats_roll->the_post();
			$title = get_the_title();
			$permalink = get_the_permalink();
			$subscription_roll_output = $subscription_roll_output . ("<a href = '$permalink'>$title</a><br />");
		}
	}
	$subscription_roll_output = $subscription_roll_output . "</div>";
return $subscription_roll_output;
}

?>
