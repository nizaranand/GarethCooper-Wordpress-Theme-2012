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

<div id="content" class="central">

	<div id="imageRotator" class="yui3-u-1">
		<?php echo get_the_post_thumbnail($post->ID, 'gc-frontpage-featured'); ?>
	</div>

	<div id="frontpage-text">
			<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
			<?php the_content(); ?>
			<?php endwhile; ?>
	</div>

	<div id="frontpage-images">
			<h1>Latest Images</h1>
			
			<div class="xscroller">
			<?php
			$args = array( 'post_type' => 'post', 'numberposts' => 20 );
			$posts = get_posts( $args );

			if ($posts) :
			foreach ( $posts as $post ) :
			if (has_post_thumbnail( $post->ID )) :
			?>
			<a href="<?php echo get_permalink($post->ID); ?>"
				title="<?php echo get_the_title($post->ID); ?>"> <?php echo get_the_post_thumbnail($post->ID, 'gc-frontpage-thumb'); ?>
			</a>
			<?php
			endif;
			endforeach;
			endif;
			?>
			</div>
	</div>

</div>
<!-- #content -->

<?php get_footer(); ?>
