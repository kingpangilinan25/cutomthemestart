<?php get_header(); ?>
<section class="main_cc">
	<section class="main_cc_text" role="main">
		<?php
        while ( have_posts() ) : the_post();

            get_template_part( 'template-parts/content', 'page' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
    </section> <!-- .main_cc_text -->
    <aside class="main_sb" role="complementary">
        <?php get_sidebar(); ?>
    </aside>
</section> <!-- .main_cc -->
<?php get_footer(); ?>