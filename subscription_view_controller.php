<?php
/*
Plugin Name: Cat Creations subscription_view_controller.php
Description: Part of CRG Cat Creations
*/

//A 'subscription' CPT has three views. 1 - author [customer] View, 2 - Promo view, 3 - Public view [the default view, with nothing done to it.] All are to be routed to the single.php theme template.

class subscription_view_controller{

	function __construct(){
		$x = $_SERVER['REQUEST_URI'];
		if (strpos($x, '/subscription/') !== false){
			add_action( 'the_post', array($this,'whois_looking_check') );
		}
		
	}

	//this method checks who is viewing the post, and launches the appropriate view:
	public function whois_looking_check(){
		global $post;
		$post_id = get_the_ID();
		$current_user_id = get_current_user_id();
		$author_user_id = $post->post_author;
		if ($current_user_id == $author_user_id){
			$include_file = plugin_dir_path( __FILE__ ) . "subscription_view_author.php";
			include_once($include_file);
			if (isset ($$subscription_view_author)){return;}
			$subscription_view_author = new subscription_view_author($post_id);
		}
	}
}
?>
