<?php
$gnik_phone = get_option('phone');
$gnik_email = get_option('email');

function krgp_alpha_numeric($data) {	
	return preg_replace("/[^A-Za-z0-9]/", "", $data);
}

function krgp_template_part_func( $atts ){
	
    $atts = shortcode_atts( 
        array(
            'slug1' => "content",
            'slug2' => "page"	
        ), $atts, 'krgp_template_part' );
	
    ob_start();
    get_template_part("template-parts/". $atts['slug1'] , $atts['slug2']);
	$str = str_replace(array("\r","\n"),'',trim(ob_get_clean()));
    return $str;
}
add_shortcode( 'krgp_template_part', 'krgp_template_part_func' );

add_action('admin_init', 'gnik_general_section');  
function gnik_general_section() {  
    add_settings_section(  
        'gnik_settings_section', // Section ID 
        'Contact Details', // Section Title
        'gnik_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field( // Option 1
        'phone', // Option ID
        'Phone', // Label
        'gnik_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'gnik_settings_section', // Name of our section
        array( // The $args
            'phone' // Should match Option ID
        )  
    ); 
    register_setting('general','phone', 'esc_attr'); //echo get_option('phone');

    add_settings_field( // Option 1
        'email', // Option ID
        'Email', // Label
        'gnik_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'gnik_settings_section', // Name of our section
        array( // The $args
            'email' // Should match Option ID
        )  
    ); 
    register_setting('general','email', 'esc_attr'); //echo get_option('email');

    add_settings_field( // Option 1
        'address', // Option ID
        'Physical Address', // Label
        'gnik_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'gnik_settings_section', // Name of our section
        array( // The $args
            'address' // Should match Option ID
        )  
    ); 
    register_setting('general','address', 'esc_attr'); //echo get_option('address');

}

function gnik_section_options_callback() { // Section Callback
    echo '<p>Cotact Details for the website front end </p>';  
}

function gnik_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" class="regular-text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

/* Custom query for checked box from acf customfieds to show only desired item
  
	// args
	$args = custom_prep_query_by_custom_field('class','day','Thursday');
	// query
	$the_query = new WP_Query( $args );     
			
*/
function custom_prep_query_by_custom_field($post_type='post',$key, $key_val) {

	$args = array(
		'numberposts'	=> -1,
		'post_type'		=> $post_type,
		'meta_query'	=> array(
			'relation'		=> 'OR',
			array(
				'key'		=> $key,
				'value'		=> $key_val,
				'compare'	=> 'LIKE'
			)
		)
	);
	return $args;
}