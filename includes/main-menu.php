<?php

if ( ! function_exists( 'gradastudio_include_custom_walkers' ) ) {
	function gradastudio_include_custom_walkers() {

		/**
		 * Include custom walkers
		 */
		include_once get_template_directory . '/includes/main-menu-navigation-walker.php';

		do_action( 'grada_action_include_custom_walkers_nav' );
	}

	add_action( 'after_setup_theme', 'gradastudio_include_custom_walkers' );
}