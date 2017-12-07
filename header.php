<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon.png">
    <?php /*
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="dns-prefetch" href="//ajax.googleapis.com">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
    */ ?>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php if ( is_singular()&& comments_open() && get_option('thread_comments') ) wp_enqueue_script('comment-reply'); ?>
	<script>
    "'article aside footer header nav section time'".replace(/\w+/g,function(n){document.createElement(n)})
  	</script>
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<div id="page-wrap" class="container">

		<header id="header" role="banner">
			<a id="logo-link" href="<?php echo home_url(); ?>/">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" title="<?php bloginfo('name'); ?> <?php bloginfo('description'); ?>" alt="<?php bloginfo('name'); ?> <?php bloginfo('description'); ?>" width="" height="" />
            </a>
		</header>
        
        <nav id="nav" class="navbar navbar-inverse" role="navigation">
        	<div class="container"><div class="row"><div class="col-md-12">
            	<div class="form_nav_wrap pull-right">
                	<?php //echo get_search_form('bs'); ?>
                    <?php require(TEMPLATEPATH . '/bs-searchform.php'); ?>
                </div>
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                	Navigation <span class="glyphicon glyphicon-menu-hamburger"> </span>
                  <?php /*
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
				  */ ?>
                </button>
                <a class="navbar-brand visible-xs" href="#">Menu</a>
              </div>    
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<?php /* Primary navigation */
						main_navigation_menu();
						/*
						wp_nav_menu( array(
						'menu' => 'main_nav',
						//'depth' => -1,
						'container' => false,
						'menu_class' => 'nav navbar-nav navbar-right',
						//Process nav menu using our custom nav walker
						'walker' => new wp_bootstrap_navwalker())
						);
						*/
					?>
				</div>           
            </div></div></div> <!-- container row col-md-12 -->
         </nav>