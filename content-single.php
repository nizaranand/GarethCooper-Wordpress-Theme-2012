<?php
/**
 * @package garethcooper
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="meta">
			<?php garethcooper_posted_on(); ?>
		</div><!-- .entry-meta -->
		
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'garethcooper' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
	</footer><!-- .entry-meta -->
	
	<div class="hr"></div>
</article><!-- #post-<?php the_ID(); ?> -->
