<?php
/*
Plugin Name: Cat Creations subscription_view_author.php
Description: Part of CRG Cat Creations
*/

//A 'subscription' CPT has three views. 1 - author [customer] View, 2 - Promo view, 3 - Public view [the default view, with nothing done to it.] All are to be routed to the single.php theme template.

class subscription_view_author{

	private $post_id;

	function __construct($incoming_post_id){
		//This filter modifies the subscription post types when viewed by the author/customer:
		add_filter( 'the_content', array($this, 'modify_for_author') ); 
		add_action( 'wp_enqueue_scripts', array($this,'add_css') );
		$this->post_id = $incoming_post_id;
	}

	public function add_css(){
		$path = plugin_dir_url( __FILE__ ) . "add_cat_shortcode.css";
		wp_enqueue_style('crg_add_cat_shortcode', $path, false);
	}

	public function modify_for_author($content){
		$post_id = $this->post_id; 
		$l18n_30_days_of_food = __("[30 days of food]", "crg_cat_creations_text_domain");
		$l18n_add_another_cat = __("Add Another Cat", "crg_cat_creations_text_domain");
		$l18n_adult_cat_food = __("[Adult Cat Food]", "crg_cat_creations_text_domain");
		$l18n_boy = __("Boy:", "crg_cat_creations_text_domain");
		$l18n_cats_name = __("Cat's Name:", "crg_cat_creations_text_domain");
		$l18n_chickenpuddin = __("Chicken Puddin'", "crg_cat_creations_text_domain");
		$l18n_continue = __("Continue", "crg_cat_creations_text_domain");
		$l18n_enter_your_email_here = __("Enter your email here.", "crg_cat_creations_text_domain");
		$l18n_for_mature_cats = __("[For Mature Cats]", "crg_cat_creations_text_domain");
		$l18n_gender = __("Gender:", "crg_cat_creations_text_domain");
		$l18n_girl = __("Girl:", "crg_cat_creations_text_domain");
		$l18n_ie = __("i.e. 'Fluffy' or 'Spot'", "crg_cat_creations_text_domain");
		$l18n_kittenkaboodle = __("Kittenkaboodle", "crg_cat_creations_text_domain");
		$log_in_to_continue = __("Log in to continue:", "crg_cat_creations_text_domain");
		$l18n_proceed_to_payment = __("Proceed To Payment", "crg_cat_creations_text_domain");
		$l18n_save_changes = __("Save Changes", "crg_cat_creations_text_domain");
		$l18n_skinnycat = __("Skinny Cat", "crg_cat_creations_text_domain");
		$l18n_the_mountain = __("The Mountain", "crg_cat_creations_text_domain");
		$l18n_weight_loss_food = __("[Weight loss food]", "crg_cat_creations_text_domain");
		$l18n_upload_cats_image = __("Upload Cats's Image:", "crg_cat_creations_text_domain");
		$l18n_whats_your_cats_name = __("&nbsp;What's your cat's name???", "crg_cat_creations_text_domain");
		$image_path = plugin_dir_url( __FILE__ ) . "";

		$meta_cats_name = get_post_meta( $post_id, 'crg_cats_name', TRUE);
		$meta_sex = get_post_meta( $post_id, 'crg_cat_sex', TRUE);
		if ($meta_sex == "male"){$meta_male_checked = "CHECKED";}else{$meta_female_checked = "CHECKED";}
		$meta_product = get_post_meta( $post_id, 'crg_product', TRUE);
		if ($meta_product == "Kittenkaboodle"){$meta_kittenkaboodle_checked = "CHECKED";}
		if ($meta_product == "Chicken Puddin'"){$meta_chicken_puddin_checked = "CHECKED";}
		if ($meta_product == "Skinny Cat"){$meta_skinnycat_checked = "CHECKED";}
		if ($meta_product == "The Mountain"){$meta_themountain_checked = "CHECKED";}
		$add_treats_checked = get_post_meta($post_id, 'crg_add_treats', TRUE);
		if ($add_treats_checked == "on"){$add_treats_checked = "CHECKED";}else{$add_treats_checked = "";}

		$content =  
<<<FORM_START_STOP

<form method = "post" id = "crg_add_cat_form" action = "/continue" >

<div id = "crg_cats_name_label_div">
	<label for = "crg_cats_name_label">$l18n_cats_name</label>
</div>

<div id = "crg_cats_name_input_div">
	<input type = "text" name = "crg_cats_name" id = "crg_cats_name_input" placeholder = "$l18n_ie" value = "$meta_cats_name" class = "required" />
</div>

<div id = "boy_girl_area">
	<label for = "crg_sex_male_radio">
		<div id = "boy_girl_area_meta_label">$l18n_gender</div>
		$l18n_boy
		<input type = "radio" name = "crg_cat_sex" class = "crg_cat_sex_radio required" value = "male" $meta_male_checked/>	
	</label>
	<label for = "crg_sex_male_radio">
		$l18n_girl
	</label>
	<input type = "radio" name = "crg_cat_sex" class = "crg_cat_sex_radio" value = "female" $meta_female_checked/>
</div>
<div id = "crg_product_radio_area">
	<div id = "kittenkaboodle_click">	
		<input type = "radio" name = "crg_product_radio" value = "Kittenkaboodle" $meta_kittenkaboodle_checked/>$l18n_kittenkaboodle
		<span class = "crg_radio_additional_text">
			$l18n_30_days_of_food
		</span>
	</div>
	<div id = "chickenpuddin_click">	
		<input type = "radio" name = "crg_product_radio" value = "Chicken Puddin'" $meta_chicken_puddin_checked />$l18n_chickenpuddin
		<span class = "crg_radio_additional_text">
			$l18n_adult_cat_food
		</span>
	</div>
	<div id = "skinnycat_click">	
		<input type = "radio" name = "crg_product_radio" value = "Skinny Cat" $meta_skinnycat_checked />$l18n_skinnycat
		<span class = "crg_radio_additional_text">
			$l18n_weight_loss_food
		</span>
	</div>
	<div id = "themountain_click">	
		<input type = "radio" name = "crg_product_radio" value = "The Mountain" $meta_themountain_checked />$l18n_the_mountain
		<span class = "crg_radio_additional_text">
			$l18n_for_mature_cats
		</span>
	</div>

	<input type = "checkbox" id = "add_treats_checkbox" name = "crg_add_treats" $add_treats_checked /> 
	<span id = "add_treats_text">Add treats for $5</span>
</div>
<div id = "crg_add_cat_submit_buttons_area">
	<div class = "crg_add_cat_submit_buttons" id = "continue_button">
		<input type = "submit" name = "crg_continue" value = "$l18n_continue" />
	</div>
</div>
<input type = "hidden" name = "crg_old_id_reference" value = "$post_id" />
<div id = "crg_delete_cat_div">
<a href = "/add-cat?crg_delete=$post_id"/>Click here</a> to permanently delete this cat from the system.
</div>
</form>

<script type="text/javascript">
   jQuery(document).ready(function() {
   	jQuery("#crg_add_cat_form").validate();
   });

jQuery.extend(jQuery.validator.messages, {
    required: "$l18n_whats_your_cats_name"
});

</script>
FORM_START_STOP;

		$content = $content . subscription_roll();

		return $content;
	}	
}
?>
