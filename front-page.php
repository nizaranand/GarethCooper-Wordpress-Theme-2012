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
 * @package garethcooper
 * @since garethcooper 0.1
 */

get_header(); ?>

<div id="content" class="yui3-g central">

	<div id="imageRotator" class="yui3-u-1">
		<img
			src="http://bucket.garethcooper.com/wp-content/uploads/2012/02/fire.jpg"
			alt="Fire" width=958 />
	</div>

	<div class="yui3-u-1-3">
		<div class="gridPadding">
			<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
			<?php the_content(); ?>
			<?php endwhile; ?>
		</div>
	</div>
	<div class="yui3-u-1-3">
		<div class="gridPadding">
			<h1>Latest Images</h1>
			<?php if (class_exists('wp_media_tags_plugin')) { wp_media_tags_plugin::media_tags_query('frontpage', 'thumbnail'); }?>
		</div>
	</div>
	<div class="yui3-u-1-3">
		<div class="gridPadding">
			<h1>Latest Posts</h1>
			<ul>
				<?php wp_get_archives(array(
						'type' => 'postbypost',
								'limit'=> 5)); ?>
			</ul>

			<h1>Archives</h1>
			<ul>
				<?php wp_get_archives( array(
						'type'   => 'monthly',
						'limit'  => 5 ) ); ?>
			</ul>
		</div>
	</div>
</div>
<!-- #content -->

<?php get_footer(); ?>
