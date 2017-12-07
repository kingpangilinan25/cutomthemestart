		<footer id="footer" role="contentinfo">
        	<section class="credit">
				&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?>
            </section>
		</footer>

	</div> <!-- .page-wrap -->

	<?php wp_footer(); ?>
	
	<!-- Don't forget analytics -->

    <?php #get_template_part("inc/ga","all"); ?>
	
</body>

</html>
