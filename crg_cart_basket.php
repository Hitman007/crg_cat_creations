<?php
/*
Plugin Name: crg_cart_basket.php
Description: Part of the CRG Shopping Cart 
*/

abstract class crg_basket_abstract_class{

	private $subscription_ids;
	private $number_of_subscriptions;

	private function populate_basket(){}

	public function remove_item(){}
	public function add_item(){}
	public function get_number_of_subscriptions(){}
}

class crg_cart_basket extends crg_basket_abstract_class{

	private $subscription_ids;
	private $number_of_subscriptions = 0;
	private $basket_array;


	public function __construct(){
		add_action('init', array($this,'populate_basket'));
	}

	public function populate_basket(){
		//If no user is logged in.
		if (!( is_user_logged_in()) ){
			//to do://populate_basket_with_session_items();
			return;
		 }else{
			//if payment page, populate basket with database items.
			if ($_SERVER["REQUEST_URI"] == "/payment/"){
				global $current_user;
				$user_id = get_current_user_id();
				$args = array(
					'post_type' => 'subscription',
					'author' => $user_id,
				);
				$your_cats_roll = new WP_Query( $args );
				if( $your_cats_roll->have_posts() ) {
					$x = 0;
					while($your_cats_roll->have_posts() ) {
						$your_cats_roll->the_post();
						$this->basket_array[$x][0] = get_the_title();
						$this->basket_array[$x][1] = $this->get_subscription_prices($x);
						$this->basket_array[$x][2] = get_the_permalink();
						$x++;
					}
				}
			}
		}
	}

	public function get_number_of_subscriptions(){
		$this->number_of_subscriptions = count($this->basket_array,0);		
		return ($this->number_of_subscriptions);
	}

	//note: item numbers start at zero
	public function get_item_description($item_number){
		return ($this->basket_array[$item_number][0]);
	}

	public function get_item_price($item_number){
		return ($this->basket_array[$item_number][1]);
	}

	public function get_item_permalink($item_number){
		return ($this->basket_array[$item_number][2]);
	}
	
	public function get_item_id(){}

	private function get_subscription_prices($subscription_number){
		if ($subscription_number == 0){return 59;}
		if ($subscription_number == 1){return 30;}
		return 30;	
	}

	public function remove_item(){
		//to do.
	}

	public function add_item(){
		//to do
	}

}

?>
