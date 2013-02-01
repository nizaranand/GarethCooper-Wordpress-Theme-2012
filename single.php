<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

<div id="content" class="yui3-g central">
	<div class="yui3-u-1">

	<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', 'single' ); ?>
	
	<?php garethcooper_content_nav( 'nav-below' ); ?>

	<?php
	// If comments are open or we have at least one comment, load up the comment template
	if ( comments_open() || '0' != get_comments_number() )
	comments_template( '', true );
	?>

	<?php endwhile; // end of the loop. ?>

	</div>
	<!-- .yui3-u-1 -->
</div>
<!-- #content -->

<?php get_footer(); ?>
