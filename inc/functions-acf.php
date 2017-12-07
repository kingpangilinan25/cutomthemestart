<?php
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	/*
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	*/
	
}


function the_site_address() {
    if(get_field('physical_address')) {
        
    }
    $directory = get_template_directory_uri();
    // Code
    return (get_field('physical_address','option'))?:"no physical addr setup";
}
add_shortcode( 'site_setting_physical_address', 'the_site_address' );

function the_site_phone() {
    return (get_field('phone','option'))?:"no phone setup";
}
add_shortcode( 'site_setting_phone', 'the_site_phone' );

function the_site_email() {
    return (get_field('email','option'))?:"no email setup";
}
add_shortcode( 'site_setting_email', 'the_site_email' );

