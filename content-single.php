<?php
/**
 * @package garethcooper
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
	
	<?php if ( has_post_thumbnail() ) :
		$full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		?>
		<a href="<?php echo $full_image_url[0]; ?>" rel="lightbox[<?php the_ID(); ?>]">
		<?php the_post_thumbnail('gc-full'); ?>
		</a>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'garethcooper' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

<div class="hr"></div>

<div class="entry-meta">
	<?php garethcooper_posted_on(); ?>
</div><!-- .entry-meta -->

<div class="hr"></div>
