<?php
/**
 * @package garethcooper
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'garethcooper' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		
	</header><!-- .entry-header -->
	
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="thumbnail">
		<a href="<?php the_permalink(); ?>" >
			<?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>
		</a>
	</div>
	<?php endif; ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'garethcooper' ) ); ?>
		<?php //wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'garethcooper' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
