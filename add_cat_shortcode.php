<?php
/*
Plugin Name: Cat Creations cats_add_cat_shotcode.php
Description: Part of CRG Cat Creations
*/

class add_cat_shortcode{

	public $shortcode_output;

	function __construct(){
		//add_action('init', array($this,'calculate_shortcode_output'));
		add_shortcode('add-cat', array($this,'get_shortcode_output'));
		add_action( 'wp_enqueue_scripts', array($this,'add_css') );
		$x = $_SERVER['REQUEST_URI'];

		if (strpos($x, '/add-cat/') !== false){
			add_action('init', array($this,'calculate_shortcode_output'));
		}


	}

	public function add_css(){
		$path = plugin_dir_url( __FILE__ ) . "add_cat_shortcode.css";
		wp_enqueue_style('crg_add_cat_shortcode', $path, false);
	}

	public function get_shortcode_output(){
		//$this->shortcode_output = $this->shortcode_output . (add_cat_roll());
		return $this->shortcode_output;
	}

	public function calculate_shortcode_output(){
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
		$l18n_skinnycat = __("Skinny Cat", "crg_cat_creations_text_domain");
		$l18n_the_mountain = __("The Mountain", "crg_cat_creations_text_domain");
		$l18n_weight_loss_food = __("[Weight loss food]", "crg_cat_creations_text_domain");
		$l18n_upload_cats_image = __("Upload Cats's Image:", "crg_cat_creations_text_domain");
		$l18n_whats_your_cats_name = __("&nbsp;What's your cat's name???", "crg_cat_creations_text_domain");
		
		$image_path = plugin_dir_url( __FILE__ ) . "";
		$this->shortcode_output =
<<<FORM_START_STOP

<form method = "post" id = "crg_add_cat_form" action = "/continue">

<div id = "crg_cats_name_label_div">
	<label for = "crg_cats_name_label">$l18n_cats_name</label>
</div>

<div id = "crg_cats_name_input_div">
	<input type = "text" name = "crg_cats_name" id = "crg_cats_name_input" placeholder = "$l18n_ie" class = "required" />
</div>

<div id = "boy_girl_area">
	<label for = "crg_sex_male_radio">
		<div id = "boy_girl_area_meta_label">$l18n_gender</div>
		$l18n_boy
		<input type = "radio" name = "crg_cat_sex" class = "crg_cat_sex_radio required" value = "male" />	
	</label>
	<label for = "crg_sex_male_radio">
		$l18n_girl
	</label>
	<input type = "radio" name = "crg_cat_sex" class = "crg_cat_sex_radio" value = "female" checked/>
</div>
<div id = "crg_product_radio_area">
	<div id = "kittenkaboodle_click">	
		<input type = "radio" name = "crg_product_radio" value = "Kittenkaboodle" />$l18n_kittenkaboodle
		<span class = "crg_radio_additional_text">
			$l18n_30_days_of_food
		</span>
	</div>
	<div id = "chickenpuddin_click">	
		<input type = "radio" name = "crg_product_radio" value = "Chicken Puddin'" checked />$l18n_chickenpuddin
		<span class = "crg_radio_additional_text">
			$l18n_adult_cat_food
		</span>
	</div>
	<div id = "skinnycat_click">	
		<input type = "radio" name = "crg_product_radio" value = "Skinny Cat" />$l18n_skinnycat
		<span class = "crg_radio_additional_text">
			$l18n_weight_loss_food
		</span>
	</div>
	<div id = "themountain_click">	
		<input type = "radio" name = "crg_product_radio" value = "The Mountain" />$l18n_the_mountain
		<span class = "crg_radio_additional_text">
			$l18n_for_mature_cats
		</span>
	</div>

</div>
<div id = "crg_add_treats_area">
	<input type = "checkbox" id = "add_treats_checkbox" name = "crg_add_treats" CHECKED/> 
	<span id = "add_treats_text">Add treats for $5</span>
</div>
<div id = "crg_add_cat_submit_buttons_area">
	<div class = "crg_add_cat_submit_buttons">
		<input type = "submit" name = "crg_add_cat_continue_button" value = "$l18n_continue" />
	</div>
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

			$this->shortcode_output = $this->shortcode_output . subscription_roll();

		if (!((is_user_logged_in()))){
			$this->shortcode_output = 

<<<OUTPUT_START_STOP
<div id = "add_cat_shortcode_not_logged_in">
	<form method = "post">
		<div id = "log_in_to_continue_text">
			$log_in_to_continue
		</div>
		<input type = "text" id = "crg_add_cat_email_text_input" name = "crg_login_email" placeholder = "$l18n_enter_your_email_here" />
		<input type = "submit" id = "crg_add_cat_email_submit_button" />
	</form>
</div>
OUTPUT_START_STOP;

		}
	}
}


?>
