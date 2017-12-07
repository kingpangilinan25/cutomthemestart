<?php

	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
	
	
/* =========================== Product item perpage loop Count =========================== */
	
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 9;
  return $cols;
}
	
/* =========================== Button Text =========================== */

/**
 * custom_woocommerce_template_loop_add_to_cart
*/
function custom_woocommerce_product_add_to_cart_text() {
	global $product;
	
	$product_type = $product->product_type;
	
	switch ( $product_type ) {
		case 'external':
			return __( 'Buy product', 'woocommerce' );
		break;
		case 'grouped':
			return __( 'View products', 'woocommerce' );
		break;
		case 'simple':
			return __( 'Add to cart', 'woocommerce' );
		break;
		case 'variable':
			return __( 'Select options', 'woocommerce' );
		break;
		default:
			return __( 'Read more', 'woocommerce' );
	}
	
}
	

/* =========================== Move Product description below product list @ product category view =========================== */
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
add_action( 'woocommerce_after_main_content', 'woocommerce_taxonomy_archive_description', 100 );

add_action( 'woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 100 );
function woocommerce_taxonomy_archive_description() {
	if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) {
		$description = wpautop( do_shortcode( term_description() ) );
		if ( $description ) {
			echo '<div class="term-description">' . $description . '</div>';
		}
	}
}
/* =========================== End Move Product description below product list @ product category view =========================== */
	
	
/* =========================== UPDATE category view title mockup even without using hook or filter =========================== */
if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
    function woocommerce_template_loop_product_title() {
        echo '<h2 class="ctitle-prod">' . get_the_title() . '</h2>';
    }
}
/* =========================== End UPDATE category view title mockup even without using hook or filter =========================== */


//Usage: if (function_exists(custom_pagination)) { custom_pagination($query_posts->max_num_pages,"",$paged); }
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    //'prev_text'       => __('&laquo;'),
    //'next_text'       => __('&raquo;'),
    'prev_text'       => '',
    'next_text'       => '',
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      //echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}




/**************************************** custom thumbnail gen for title and alt *****************************************/
function gnik_post_thumbnail($size,$class) {
	global $post;
	$thumbnail = get_post( get_post_thumbnail_id($post->ID) );
	//$thumbnail = get_post( get_post_thumbnail_id() );
	$pt_title = $thumbnail->post_title;
	$pt_alt = get_post_meta( $thumbnail->ID, '_wp_attachment_image_alt', true );
	$pt_title = (empty($pt_title) || !isset($pt_title) ) ? get_the_title($post) : $thumbnail->post_title;
	$pt_alt = (empty($pt_alt) || !isset($pt_alt) ) ? get_the_title($post) : get_post_meta( $thumbnail->ID, '_wp_attachment_image_alt', true );
	$img_attrb = array(
		'class' => $class ." thumbnail-def", 
		'title' => $pt_title,
		'alt' => $pt_alt
	); 
	$link_p = get_the_permalink();
	$img = get_the_post_thumbnail($post->ID, $size, $img_attrb);
	//return "<a href=\"{$link_p}\">{$img}</a>";
    //$img_cdn = str_replace("www.vrbeginnersguide.com", "cdn.vrbeginnersguide.com", $img);
	//return "{$img_cdn}";
    return $img;
	
}

function gnik_generate_thumbnail_holder($size, $class) {
		$size_pholder = "150x150";
		if(is_array($size)) {
			
			$all_numeric = true;
			foreach ($size as $key) { 
				if (!(is_numeric($key))) {
					$all_numeric = false;
					break;
				} 
			}
			if ($all_numeric) {
				$size_pholder = implode("x",$size);
			}
			
		}
		#$img_tag = "<img class=\"{$class} thumb-placeholder\" src=\"http://placehold.it/{$size_pholder}\" title=\"PlaceHolder\" alt=\"PlaceHolder\" />";
		$img_url = get_template_directory_uri() . "/images/NoImageAvailable.png";
		$img_tag = "<img class=\"{$class} thumb-placeholder\" src=\"{$img_url}\" title=\"PlaceHolder\" alt=\"PlaceHolder\" />";
		return $img_tag;
}

function gnik_get_first_img($size='thumbnail', $class='post-cthumbnail', $placeHolder) {
    global $post;
	$title= get_the_title($post->ID);
    $images = get_posts(
        array(
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'numberposts' => -1,
            'post_status' => null,
            'order' => 'asc',
            #'orderby' => 'menu_order',
            'post_parent'    => $post->ID,
            'posts_per_page' => -1, /* Save memory, only need one */

        )
    );

    if ( $images ) {
        $img_cus_url = wp_get_attachment_image_src( $images[0]->ID, $size )[0];
        $img_tag = "<img class=\"{$class} thumb-placeholder\" src=\"{$img_cus_url}\" title=\"{$title}\" alt=\"{$title}\" />";
    } else {
        if( $placeHolder ) {
            $img_tag = gnik_generate_thumbnail_holder($size, $class);
        } else {
            $img_tag = false;
        }
    }
    /*
    if ($img = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches)) {
        $img = $matches[1][0];
        if (is_int($img)) {
            $img = wp_get_attachment_image_src($img, $size);
            $img = $img[0];
        }
        $img_tag = "<img class=\"{$class} thumb-placeholder\" src=\"{$img_cus_url}\" title=\"{$title}\" alt=\"{$title}\" />";
    } 
    */
    return $img_tag;
    
}

function gnik_get_thumbnail($size='thumbnail', $class='post-cthumbnail', $placeHolder=false) {
	global $post;
	$temp_dir = get_template_directory_uri();
	$title= get_the_title();
	$img_tag = "";
	if(has_post_thumbnail($post->ID)) {
		$img_tag = gnik_post_thumbnail($size,$class);
		
	} elseif(!has_post_thumbnail($post->ID)) {
		$img_tag = gnik_get_first_img($size, $class, $placeHolder);
	}    
	return $img_tag;
}

function wooproduct_func( $atts ) {
	$atts = shortcode_atts( array(
		'productperpage' => 3
	), $atts, 'gnik_wooproduct' );

	$html = "";
	global $woocommerce,$product;
	$c = 0;

	$args = array(
 		'post_type' => 'product',
		'posts_per_page' => 4,
 		'post_status' => 'publish'
 	);

	$loop = new WP_Query( $args );

	while ( $loop->have_posts() ) : $loop->the_post(); $c++;
		global $product;
		$prodtitle = get_the_title();
		$prodpermalink = get_the_permalink();
		$product_external_url = get_post_meta( $product->id, '_product_url', true  );
		$homeurl = get_option('home');
		$img_title = get_the_title();
		$price_html = $product->get_price_html();

		$html .= "<div class=\"col-sm-3 col-product-item\">";
		$html .= "<figure class=\"recommend-gear-item\">";
			$html .= "<figcaption class=\"fps-title\"><a target=\"_blank\" href=\"{$prodpermalink}\" title=\"{$prodtitle}\">{$prodtitle}</a></figcaption>";
			$html .= "<a target=\"_blank\" href=\"{$product_external_url}\">";
			$html .= gnik_get_thumbnail('homepage-sb-product-thumb', 'recommended-gear-thumb', true);
			$html .= "</a>";

			#$html .= $price_html;
			//if($c == 1) {
				$html .= "<div class=\"row gutter5\"><div class=\"col-md-6\"><a target=\"_blank\" class=\"cbtn-info btn cbtn-black btn-block\" href=\"{$prodpermalink}\" title=\"{$prodtitle} info\">More Info</a></div> <div class=\"col-md-6\"><a target=\"_blank\" class=\"cbtn-buy btn cbtn-orange btn-block\" href=\"{$product_external_url}\" title=\"Buy {$prodtitle}\">Buy Now</a></div></div>";
			//}
			$html .= "</figure>";
			
			$html .= "</div>";
			
	endwhile;
    wp_reset_query();
    wp_reset_postdata();

	$html .= "<p class=\"text-center\"><a class=\"cbtn-co-products btn\" href=\"http://www.vrbeginnersguide.com/shop/\" title=\"Other Products\">View More Products</a></p>";
	
	return $html;
}
add_shortcode('gnik_wooproduct', 'wooproduct_func');
	
	
?>