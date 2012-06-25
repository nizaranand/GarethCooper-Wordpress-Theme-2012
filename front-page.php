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

get_header();
$options = get_option( 'garethcooper_theme_options' );
?>

<div id="content" class="yui3-g central">

	<div id="imageRotator" class="yui3-u-1">
		<?php echo get_the_post_thumbnail($post->ID, 'gc-frontpage-featured'); ?>
	</div>

	<div class="yui3-u-1-3" id="frontpage-text">
		<div class="gridPadding">
			<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
			<?php the_content(); ?>
			<?php endwhile; ?>
		</div>
	</div>
	
	<div class="yui3-u-1-3" id="frontpage-images">
		<div class="gridPadding">
			<h1>Latest Images</h1>
			
			<?php
			$args = array( 'post_type' => 'post', 'numberposts' => -1 ); 
			$posts = get_posts( $args );
			
			if ($posts) {
				foreach ( $posts as $post ) {
					if (has_post_thumbnail( $post->ID )) {
					?>
						<a href="<?php echo get_permalink($post->ID); ?>">
						<?php echo get_the_post_thumbnail($post->ID, 'gc-frontpage-thumb'); ?>
						</a>
					<?
					}
				}
			}
			?>
			
		</div>
	</div>
	
	<div class="yui3-u-1-3" id="frontpage-latest">
		<div class="gridPadding">
			<h1>Latest Posts</h1>
			<ul>
				<?php wp_get_archives(array(
						'type' => 'postbypost',
								'limit'=> 5)); ?>
			</ul>
		</div>
	</div>
	
</div> <!-- #content -->

<?php get_footer(); ?>
