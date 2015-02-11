<?php
/**
 * Plugin Name: Number Facts Plugin
 * Description: Simple facts about numbers. Simply delivered into a neat dashboard widget
 * Author: Nikhil Vimal
 * Author URI: http://nik.techvoltz.com
 * Version: 1.0
 * Plugin URI:
 * License: GNU GPLv2+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

Class Number_Facts_Dashboard_Widget {

	public function __construct() {
		add_action( 'wp_dashboard_setup', array( $this, 'number_facts_dashboard_widget' ));

	}

	/**
	 * Add a widget to the dashboard.
	 *
	 * This function is hooked into the 'wp_dashboard_setup' action below.
	 */
	public function number_facts_dashboard_widget() {

		wp_add_dashboard_widget(
			'number_facts_dashboard_widget',         // Widget slug.
			'Number Facts Dashboard Widget',         // Title.
			array( $this, 'number_facts_dashboard_widget_function' ) // Display function.
		);
	}


	public function number_facts_dashboard_widget_function() {
		
		$jsonurl = "http://numbersapi.com/random/year?json";
			$json  = wp_remote_get( $jsonurl );
			if ( is_wp_error( $json ) ) {
				return "No Number Facts :(. Please wait a bit.";
			}
			else {
				// If everything's okay, parse the body and json_decode it
				$json_output = json_decode( wp_remote_retrieve_body( $json ));
				$joke        = $json_output->text;
			
			}

		echo '<p><strong>Refresh Page for a new random year fact!</strong></p>';
	}
}
new Number_Facts_Dashboard_Widget();
