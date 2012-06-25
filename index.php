<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

<div id="content" class="yui3-g central">

	<?php if ( have_posts() ) : ?>

	<?php /* Start the Loop */ ?>

	<div class="yui3-u-1">
		<?php while ( have_posts() ) : the_post(); ?>
		<?php
		/* Include the Post-Format-specific template for the content.
		 * If you want to overload this in a child theme then include a file
		* called content-___.php (where ___ is the Post Format name) and that will be used instead.
		*/
		get_template_part( 'content', get_post_format() );
		?>
		
		<?php endwhile; ?>
		
		<?php garethcooper_content_nav( 'nav-below' ); ?>

	<?php else : ?>

	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title">
				<?php _e( 'Nothing Found', 'toolbox' ); ?>
			</h1>
		</header>
		<!-- .entry-header -->

		<div class="entry-content">
			<p>
				<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'garethcooper' ); ?>
			</p>
			<?php get_search_form(); ?>
		</div>
		<!-- .entry-content -->
	</article>
	<!-- #post-0 -->

	<?php endif; ?>

</div> <!-- yui3-u-1 -->
</div> <!-- #content -->


<?php get_footer(); ?>
