<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package garethcooper
 * @since garethcooper 0.1
 */

get_header(); ?>

<div id="content" class="yui3-g central">

	<?php while ( have_posts() ) : the_post(); ?>

	<div class="yui3-u-1">

		<?php get_template_part( 'content', 'page' ); ?>

		<?php comments_template( '', true ); ?>

	</div>

	<?php endwhile; // end of the loop. ?>

</div> <!-- #content -->

<?php get_footer(); ?>