<?php //header( 'Location: /' ) ; ?>
<?php get_header(); ?>
<section class="main_cc">
	<section class="main_cc_text" role="main">
        <h1>Page Not Found: Error 404</h1>
        <p>The file may ave been removed or renamed. Be sure to check your spelling. if all else fails, you can return to the <a href="<?php echo home_url(); ?>/">homepage</a> or use the links on this page to find the information you need.</p>        
        <ul>
            <?php wp_list_pages('title_li='); ?>
        </ul>
    </section> <!-- .main_cc_text -->
    <aside class="main_sb" role="complementary">
        <?php get_sidebar(); ?>
    </aside>
</section> <!-- .main_cc -->
<?php get_footer(); ?>