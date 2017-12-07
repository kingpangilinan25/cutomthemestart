	<?php 
		global $post;
		
		$s_link = (empty($s_link) || !isset($s_link)) ? get_permalink($post->ID) : network_site_url( '/' );
		$s_title = (empty($s_link) || !isset($s_link)) ? get_the_title($post->ID) : get_bloginfo( 'name' );
		$s_summary = (empty($s_link) || !isset($s_link)) ? get_the_excerpt() : get_bloginfo( 'description' );
		
        $fb_link = esc_url("https://www.facebook.com/sharer/sharer.php?u={$s_link}");
        $tweeter_link = esc_url("http://twitter.com/share?url={$s_link}&text={$s_title}");
        $gplus_link = esc_url("https://plus.google.com/share?url={$s_link}");
        $ln_link = esc_url("http://www.linkedin.com/shareArticle?mini=true&url={$s_link}&title={$s_title}&summary={$s_summary}&source={$s_link}");
    ?>    
    
    <div class="sm_wrap_post_meta">
        <span class="sm_title" href="#">Share Now</span>  
          <a target="_blank" class="sm_item fb" href="<?php echo $fb_link; ?>">Facebook</a>
        <a target="_blank" class="sm_item gplus" href="<?php echo $gplus_link; ?>">Google Plus</a>
        <a target="_blank" class="sm_item tweet" href="<?php echo $tweeter_link; ?>">Twitter</a>
        <a target="_blank" class="sm_item ln" href="<?php echo $ln_link; ?>">LinkedIn</a>
        <div class="clearfix"></div>
    </div>
    
    <?php # wp_reset_query(); ?> 
