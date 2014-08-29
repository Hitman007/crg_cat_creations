<?php
/*
Plugin Name: Cat Creations cats_add_cat_receiver.php
Description: Part of CRG Cat Creations
*/

//This receiver handles the form submission from the 'add_cat' shortcode.
//This class is instantiated whenever isset($_POST['crg_cat_name'])

class add_cat_receiver{

	private $post_id;

	function __construct(){

		//this checks if the user is attempting to rename their post. If so, deletes the old post, and creates a new one.
		if (isset($_POST['crg_old_id_reference'])){
			$post_id = $_POST['crg_old_id_reference'];
			$cats_name = get_post_meta( $post_id, 'crg_cats_name', TRUE);
			if (!($cats_name == $_POST['crg_cats_name'])){
				unset ($_POST['crg_old_id_reference']);
				wp_delete_post($post_id);		
			}
		}

		if (!(isset($_POST['crg_old_id_reference']))){
			add_action('init',array($this,'create_record'));
		 }else{
			$this->post_id = $_POST['crg_old_id_reference'];
			add_action('init', array($this,'update_record'));	
		}

	}

	public function create_record(){
		global $user_ID;
			$cats_name = $_POST['crg_cats_name'];
			if ($cats_name == ""){$cats_name = "My Cat";}
			$product = $_POST['crg_product_radio'];
			$post_title = $cats_name . " subscribes to " . $product;
			$new_post = array(
				'post_title' => $post_title,
				'post_content' => 'Asia makes the best cat food around!',
				'post_status' => 'publish',
				'post_author' => $user_ID,
				'post_type' => 'subscription',
				'post_category' => array(0)
			);
		$post_id = wp_insert_post($new_post);
		$this->post_id = $post_id;
		$this->update_record();
	}

	public function update_record(){
		$post_id = $this->post_id;
		$meta_key = "crg_cats_name";
		$meta_value = $_POST['crg_cats_name'];
		if ($meta_value == ""){$meta_value = "My Cat";}
		update_post_meta($post_id,$meta_key,$meta_value);
		$meta_key = "crg_cat_sex";
		$meta_value = $_POST['crg_cat_sex'];
		update_post_meta($post_id,$meta_key,$meta_value);
		$meta_key = "crg_product";
		$meta_value = $_POST['crg_product_radio'];
		update_post_meta($post_id,$meta_key,$meta_value);
		$meta_key = "crg_add_treats";
		$meta_value = $_POST['crg_add_treats'];
		update_post_meta($post_id,$meta_key,$meta_value);

		if (isset($_POST['crg_add_cat_proceed'])){
			$url = get_site_url();
			$url = $url . "/payment/";
			wp_redirect($url, 302);
			exit;	
	
		}
		if (isset($_POST['crg_add_cat_another_cat'])){
			$url = get_site_url();
			$url = $url . "/add-cat/";
			wp_redirect($url, 302);
			exit;		
		}

		if (isset($_POST['crg_save_changes'])){
			$url = get_permalink($post_id);
			wp_redirect($url, 302);
			exit;	
		}
	}

}
?>
