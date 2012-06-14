<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package garethcooper
 * @since garethcooper 0.1
 */
?>
<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
<div class="gridPadding" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</div>
<!-- .gridPadding -->
<?php endif; ?>
