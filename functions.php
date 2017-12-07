<?php

//update_option('siteurl','http://localhost/blownsmokeshoplocal');
//update_option('home','http://localhost/blownsmokeshoplocal');

/*

function my_ads_shortcode( $attr ) {
    ob_start();
    get_template_part( 'ads' );
	$str = str_replace(array("\r","\n"),'',trim(ob_get_clean()));
    return ob_get_clean();
}
add_shortcode( 'ads', 'my_ads_shortcode' );

*/

//add_filter('acf/settings/show_admin', '__return_false');
add_filter('acf/settings/show_admin', 'my_acf_show_admin');
function my_acf_show_admin( $show ) {
    $is_show = false;
    if(is_user_logged_in()) {
        $user = wp_get_current_user();
        if( $user->user_email == "king_pangilinan@rocketmail.com" 
           || $user->user_email == "king.pangilinan25@gmail.com"
           //|| $user->user_email *= "@epidemic-marketing.com"
          ) {
            $is_show = true;
        }
    }
    return $is_show;
}


// add custom post content
function add_post_content($content) {
	if(!is_feed() && !is_home() && !is_front_page()) {
		$content .= '<p><a href="tel:#" class="btn btn-success">Call now for Service</a></p>';
	}
	return $content;
}
#add_filter('the_content', 'add_post_content');

	
	
	// Load jQuery
	if ( !is_admin() ) {
		function wpgnik_register_scripts() {
			
			//wp_register_style( 'customreset', get_template_directory_uri() . '/css/reset.css', false, '1' );
			//wp_enqueue_style( 'customreset' );
			
			wp_register_style( 'bootstrapcss', get_template_directory_uri() . '/css/bootstrap.min.css', false, '1' );
			//wp_enqueue_style( 'bootstrapcss' ); 
			
			wp_register_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', array(), '1' );
			wp_enqueue_style( 'font-awesome' );
			
			/*
			wp_register_style( 'bootstrapthemecss', get_template_directory_uri().'/css/bootstrap-theme.min.css', array('bootstrapcss'), '1' );
			wp_enqueue_style( 'bootstrapthemecss' );
			*/
			
			wp_register_style( 'litycss', get_template_directory_uri() . '/css/lity.css', false, false );
			wp_enqueue_style('litycss'); 
			
			
			wp_register_style( 'custom_style', get_bloginfo('stylesheet_url'), array('bootstrapcss'), null );
			wp_enqueue_style( 'custom_style' );
			
			/*
			wp_register_script(
				'jquery', 
				( get_stylesheet_directory_uri(). "/js/jquery/jquery.min.js" ), 
				false,
				'1',
				false
			); //jquery-1.11.2
			wp_enqueue_script('jquery'); 
			*/
			
			#wp_deregister_script('jquery');
			#wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
			#wp_enqueue_script('jquery');
			
			//wp_deregister_script('respond');
			wp_register_script(
				'respond',
				get_stylesheet_directory_uri(). "/js/respond.js",
				false,
				'1',
				false
			);
			wp_enqueue_script('respond');  
			
			wp_deregister_script('bootstrap');
			wp_register_script(
				'bootstrap', 
				( get_stylesheet_directory_uri(). "/js/bootstrap.min.js" ), 
				array( 'jquery' ),
				'1',
				true
			);
			wp_enqueue_script('bootstrap');
			
			/*
			*/
			wp_register_script(
				'lity', 
				( get_stylesheet_directory_uri(). "/js/jquery/lity.min.js" ), 
				array( 'jquery' ),
				'1',
				true
			);
			wp_enqueue_script('lity'); 
			wp_register_script(
				'jquery.samesizr', 
				( get_stylesheet_directory_uri(). "/js/jquery/jquery.samesizr.js" ), 
				array( 'jquery' ),
				'1',
				true
			);
			wp_enqueue_script('jquery.samesizr'); 
			 
			//wp_register_script( 'krgp-lightbox', get_template_directory_uri() . '/js/krgp-lightbox.js', false, false );
			
			wp_register_script('customgnik', ( get_stylesheet_directory_uri(). "/js/customgnik.js" ), array( 'jquery' ), '1', true);
			wp_enqueue_script('customgnik');   
		}
		add_action( 'wp_enqueue_scripts', 'wpgnik_register_scripts' );	   	   
	}
	
	
/**
 * Automatically move JavaScript code to page footer, speeding up page loading time.
 * Solve's javascript render block issue on google 
remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);
 */
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
	// Declare sidebar widget zone
    if (function_exists('register_sidebar')) {

    }
	
	function wpgnik_widgets_init() {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		//'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>'
    	));
	}
	add_action( 'widgets_init', 'wpgnik_widgets_init' );
	
	//reg nav
  	//if (function_exists('register_nav_menus')) {
	//	register_nav_menus(array('main_nav' => 'Main Navigation' ));	
	//}
	
	// Register custom navigation walker
    require_once('wp_bootstrap_navwalker.php');
	
	add_action( 'after_setup_theme', 'wpgnik_setup' );
	if ( ! function_exists( 'wpgnik_setup' ) ):
		function wpgnik_setup() { 
		

			// Add RSS links to <head> section
			add_theme_support( 'automatic-feed-links' );
		
			//add_theme_support
			if ( function_exists( 'add_theme_support' ) ) {
				add_theme_support( 'title-tag' );
				add_theme_support( 'post-thumbnails' );
				#add_theme_support( 'post-thumbnails', array( 'post' ) );          // Posts only
			}
			
			 //add_image_size
			if ( function_exists( 'add_image_size' ) ) { 
				//add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
				#add_image_size( 'homepage-thumb', 164, 114, true ); //(cropped)
			}
		
			//Register Navigation
			register_nav_menu( 'main_nav', __( 'Main Navigation', 'wpgnik' ) );
		} 
	endif;
	
	function main_navigation_menu() {
		if( has_nav_menu( 'main_nav' ) ) {
			wp_nav_menu( 
				array(
					'menu' => 'main_nav',
					//'depth' => -1,
					'container' => false,
					'menu_class' => 'nav navbar-nav navbar-right',
					//Process nav menu using our custom nav walker
					'walker' => new wp_bootstrap_navwalker()
				)
			);
		}
	}
	
	// Display Spam & Delete links when logged in
	function spam_delete_links($id) {
		global $id;
		if (current_user_can('edit_post')) {
			echo ' | <a href="'.site_url().'/wp-admin/comment.php?action=cdc&c='.$id.'">Delete</a>';
			echo ' | <a href="'.site_url().'/wp-admin/comment.php?action=cdc&dt=spam&c='.$id.'">Spam</a>';
		}
	}
	

function replace_content($text) {
	$alt = get_the_author_meta( 'display_name' );
	$text = str_replace('alt=\'\'', 'alt=\'Avatar for '.$alt.'\' title=\'Gravatar for '.$alt.'\'',$text);
	return $text;
}
add_filter('get_avatar','replace_content');



/*
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
*/

add_filter( 'show_admin_bar', '__return_false' );

add_filter('widget_text', 'do_shortcode');

#require_once('inc/functions-speed.php');
#require_once('inc/functions-woo.php');
#require_once('inc/functions-custom-king.php');
	
?>
<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	//add_action( 'wp_head', 'theme_slug_render_title' );
	add_action( 'wp_head', 'theme_slug_render_title' );
	
}
?>