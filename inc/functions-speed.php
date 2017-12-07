<?php

	// ========================================================================================================

	// Add Defer attribute for scripts
	function add_defer_attribute($tag, $handle) {
	   // add script handles to the array below
	   $scripts_to_defer = array('jquery', 'customgnik');
	   
	   foreach($scripts_to_defer as $defer_script) {
		  if ($defer_script === $handle) {
			 return str_replace(' src', ' defer="defer" src', $tag);
		  }
	   }
	   return $tag;
	}
	add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
	
	//Remove Query Strings from Static Resources =============================================================
	function _remove_script_version( $src ){
		$parts = explode( '?ver', $src );
		return $parts[0];
	}
	add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
	
	// ========================================================================================================
	define('AUTOSAVE_INTERVAL', 300); // seconds
	define('WP_POST_REVISIONS', 5); // Lemit revision change
	
	// ========================================================================================================
	/**
	 * Disable the emoji's
	 */
	function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );	
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	}
	add_action( 'init', 'disable_emojis' );
	
	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 * 
	 * @param    array  $plugins  
	 * @return   array             Difference betwen the two arrays
	 */
	function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}
	
	
	// Remove WP embed script ==============================================================================	
	function speed_stop_loading_wp_embed() {
		if (!is_admin()) {
			wp_deregister_script('wp-embed');
		}
	}
	add_action('init', 'speed_stop_loading_wp_embed');
	
	
	// Remove comment-reply.min.js from footer =============================================================
	function comments_clean_header_hook(){
		wp_deregister_script( 'comment-reply' );
	}
	add_action('init','comments_clean_header_hook');
	
?>