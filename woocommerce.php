<?php get_header(); ?>
<section class="main_cc container">
	<section class="main_cc_text pull-left" role="main">
		<?php woocommerce_content(); ?>
    </section> <!-- .main_cc_text -->
    <aside class="main_sb pull-right" role="complementary">
        <?php get_sidebar(); ?>
    </aside>
</section> <!-- .main_cc -->
<?php get_footer(); ?>