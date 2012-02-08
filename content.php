<?php
/**
 * @package garethcooper
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="meta">
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php garethcooper_posted_on(); ?>
		<?php endif; ?>
		
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'garethcooper' ) );
				if ( $categories_list && garethcooper_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( '%1$s<img src="wp-content/themes/garethcooper.com.1/img/category.png"/>', 'garethcooper' ), $categories_list ); ?>
			</span>
			<br/>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'garethcooper' ) );
				if ( $tags_list ) :
			?>
			<span class="tag-links">
				<?php printf( __( '%1$s<img src="wp-content/themes/garethcooper.com.1/img/tag.png"/>', 'garethcooper' ), $tags_list ); ?>
			</span>
			<br/>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'garethcooper' ), __( '1 Comment', 'garethcooper' ), __( '% Comments', 'garethcooper' ) ); ?><img src="wp-content/themes/garethcooper.com.1/img/comment.png"/></span>
		<br/>
		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'garethcooper' ), '<span class="edit-link">', '</span>' ); ?><img src="wp-content/themes/garethcooper.com.1/img/edit.png"/>
		</div>
		
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'garethcooper' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'garethcooper' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'garethcooper' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->