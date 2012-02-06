<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package garethcooper
 * @since garethcooper 0.1
 */
?>
<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
<div class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</div>
<!-- #tertiary .widget-area -->
<?php endif; ?>