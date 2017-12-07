<div class="meta-date-blog help-block">
	<div class="sm-share-icons-blog hide-elem">
    
    <?php 
		global $post;
		$s_link = network_site_url( '/' );
		$s_title = get_bloginfo( 'name' );
		$s_summary = get_bloginfo( 'description' );
	?>
    <?php //if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php $s_link = get_permalink($post->ID); ?>
        <?php $s_title = get_the_title($post->ID); ?>
        <?php $s_summary = get_the_excerpt(); ?>
    <?php //endwhile; endif; ?>    
	<?php 
        $fb_link = esc_url("https://www.facebook.com/sharer/sharer.php?u={$s_link}"); 
        $tweeter_link = esc_url("http://twitter.com/share?url={$s_link}&text={$s_title}"); 
        $gplus_link = esc_url("https://plus.google.com/share?url={$s_link}"); 
        $ln_link = esc_url("http://www.linkedin.com/shareArticle?mini=true&url={$s_link}&title={$s_title}&summary={$s_summary}&source={$s_link}"); 
    ?>    
    <?php //wp_reset_query(); ?> 

    

    <a href="<?php echo $fb_link; ?>" target="_blank" rel="nofollow">
        <img src="<?php echo get_template_directory_uri() ?>/images/sm-item-fb.png" title="Facebook" alt="Facebook" width="24" height="24">
    </a>
    <a href="<?php echo $tweeter_link; ?>" target="_blank" rel="nofollow">
        <img src="<?php echo get_template_directory_uri() ?>/images/sm-item-tweet.png" title="Twitter" alt="Twitter" width="24" height="24">
    </a>
    <a href="<?php echo $ln_link; ?>" target="_blank" rel="nofollow">
        <img src="<?php echo get_template_directory_uri() ?>/images/sm-item-ln.png" title="LinkedIn" alt="LinkedIn" width="24" height="24">
    </a>
    <a href="<?php echo $gplus_link; ?>" target="_blank" rel="nofollow">
        <img src="<?php echo get_template_directory_uri() ?>/images/sm-item-gplus.png" title="Google Plus" alt="Google Plus" width="24" height="24">
    </a>
    
    </div>
	<div class="sm-share-f-blog"><a class="sm-share-icons-blog-trigger" href="#Share" title="Share <?php the_title(); ?>"><span class="glyphicon glyphicon-share-alt"></span></a></div>
	<span class="glyphicon glyphicon-time"></span> <em><?php the_time('F jS, Y') ?></em>
	<?php //comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-link', ''); ?>
</div>