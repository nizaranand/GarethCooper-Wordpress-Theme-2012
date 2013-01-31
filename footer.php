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

	<div id="footer" class="yui3-u-1">
		<div class="yui3-g central">
			<div class="yui3-u-1-3">
				<div class="gridPadding">
					<?php if ( is_active_sidebar( 'footer-1' ) ) :
						dynamic_sidebar( 'footer-1' );
					endif; ?>
				</div>
			</div>
			<div class="yui3-u-1-3">
				<div class="gridPadding">
					<?php if ( is_active_sidebar( 'footer-2' ) ) :
						dynamic_sidebar( 'footer-2' );
					endif; ?>
				</div>
			</div>
			<div class="yui3-u-1-3">
				<div class="gridPadding">
					<?php if ( is_active_sidebar( 'footer-3' ) ) :
						dynamic_sidebar( 'footer-3' );
					endif; ?>
				</div>
			</div>
		</div>
	</div>	<!-- #footer -->
	
	<div id="copyright" class="yui3-u-1">© Gareth Cooper 2009-2012</div>

	</div><!-- yui3-g -->
	
	<?php wp_footer(); ?>
</body>
</html>