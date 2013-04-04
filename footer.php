<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package garethcooper
 * @since garethcooper 0.1
 */
?>

<div id="footer">
	<div class="central">
		<div class="col3">
			<div class="col-1-3">
				<div class="gridPadding">
					<?php if ( is_active_sidebar( 'footer-1' ) ) :
					dynamic_sidebar( 'footer-1' );
					endif; ?>
				</div>
			</div>
			<div class="col-1-3">
				<div class="gridPadding">
					<?php if ( is_active_sidebar( 'footer-2' ) ) :
					dynamic_sidebar( 'footer-2' );
					endif; ?>
				</div>
			</div>
			<div class="col-1-3">
				<div class="gridPadding">
					<?php if ( is_active_sidebar( 'footer-3' ) ) :
					dynamic_sidebar( 'footer-3' );
					endif; ?>
				</div>
			</div>
		</div>
		<!-- .col3 -->
	</div>
	<!-- .central -->
</div>
<!-- #footer -->

<div id="copyright">
	Wordpress Theme design by <a
		href="http://garethcooper.com/2012/06/gareth-cooper-2012-13-wordpress-theme/">Gareth
		Cooper</a> 2009-2013
</div>

</div>
<!-- #everything (from header.php) -->

<?php wp_footer(); ?>
</body>
</html>
