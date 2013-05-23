<?php
/**
 * @package garethcooper
 */
?>

<article
	itemscope itemtype="http://schema.org/BlogPosting"
	id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title" itemprop="headline">
			<?php the_title(); ?>
		</h1>
	</header>
	<!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) :
	$full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	?>
	<div class="post-image">
		<a href="<?php echo $full_image_url[0]; ?>"
			rel="lightbox[<?php the_ID(); ?>]"> <?php the_post_thumbnail(); ?>
		</a>
	</div>
	<?php endif; ?>

	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'garethcooper' ), 'after' => '</div>',
		    'pagelink' => '<span class="page-number">%</span>' ) ); ?>
	</div>
	<!-- .entry-content -->

	<div class="hr"></div>
	
	<div class="entry-meta">
		<div class="social-links" style="margin-top:4px;"><?php if (function_exists( 'the_flattr_permalink' )) { the_flattr_permalink(); } ?></div>
		<div class="social-links"><!-- Hupso Share Buttons - http://www.hupso.com/share/ --><a class="hupso_toolbar" href="http://www.hupso.com/share/"><img src="http://static.hupso.com/share/buttons/dot.png" style="border:0px; padding-top:5px; float:left;" alt="Share Button"/></a><script type="text/javascript">var hupso_services_t=new Array("Twitter","Facebook","Google Plus","Pinterest");var hupso_toolbar_size_t="small";var hupso_twitter_via = "gaco79";</script><script type="text/javascript" src="http://static.hupso.com/share/js/share_toolbar.js"></script><!-- Hupso Share Buttons -->
		</div> 
		
		<?php garethcooper_posted_on(); ?>
	</div>
	
	<!-- .entry-meta -->
</article>
<!-- #post-<?php the_ID(); ?> -->

<div class="hr"></div>
