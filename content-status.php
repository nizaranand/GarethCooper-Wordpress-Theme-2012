<?php
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 * We're assuming this'll link out to Twitter or FB etc, so no internal link required.
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package garethcooper
 * @since garethcooper 1.2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'garethcooper' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'garethcooper' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
