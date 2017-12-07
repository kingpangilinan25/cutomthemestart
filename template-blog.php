<?php /*
    Template Name: Blog
*/ ?>
<?php get_header(); ?>
<main class="main_cc container-fluid">
    <h1 class="visible-xs text-center">Our Blog</h1>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
        <div class="container">
        <?php the_content(); ?>
        </div>
    <?php endwhile; endif; ?>
    <?php wp_reset_query(); ?>
	<div class="row">
        <div class="main_cc_text col-xs-12" role="main"> 
            <div class="blog-items-cont masonry-wrap">
				<?php query_posts( 'posts_per_page=-1' ); ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
                    <article class="blog-post-item col-sm-6 col-md-4 col-lg-3 masonry-item-wrap" id="post-<?php the_ID(); ?>">
                        <?php // include (TEMPLATEPATH . '/inc/meta.php' ); ?>
                        <div class="entry bpitem-inner">
                        	<?php //echo gnik_get_thumbnail('blog-thumbnail', 'large', false); ?>                             
                        	<?php //include (TEMPLATEPATH . '/inc/meta-category-blog.php' ); ?>
                            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                            <hr style="max-width: 30px;margin: 12px auto 15px;" />
                            <p class="excerpt-blog"><?php echo substr(get_the_excerpt(), 0, 135); ?>[...]</p>
                            <p class="rm-p"><a href="<?php the_permalink(); ?>"> Read More &rarr;</a></p>
                            <?php //include (TEMPLATEPATH . '/inc/meta-date-blog.php' ); ?>
                            <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
                        </div>
                        <?php //edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
                    </article>
                    <?php // comments_template(); ?>
                <?php endwhile; endif; ?>
                <?php wp_reset_query(); ?>
            </div> <!-- .blog-items-cont -->
            
        </div> <!-- .main_cc_text -->
        <?php /*
        <aside class="main_sb  col-sm-5 col-md-3" role="complementary">
            <?php get_sidebar(); ?>
        </aside>
		*/ ?>
    </div> <?php /* row*/ ?>
</main> <!-- .main_cc -->
<?php get_footer(); ?>