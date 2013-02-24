<?php
/**
 * @package garethcooper
 */
?>

<article itemscope itemtype="http://schema.org/BlogPosting" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
	
	<?php if ( has_post_thumbnail() ) :
		$full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		?>
		<div class="post-image">
		<a href="<?php echo $full_image_url[0]; ?>" rel="lightbox[<?php the_ID(); ?>]">
		<?php the_post_thumbnail('gc-full'); ?>
		</a>
		</div>
	<?php endif; ?>

	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'garethcooper' ), 'after' => '</div>',
		    'pagelink' => '<span class="page-number">%</span>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

<div class="hr"></div>

<div class="entry-meta">
	<?php garethcooper_posted_on(); ?>
</div><!-- .entry-meta -->

<div class="hr"></div>
