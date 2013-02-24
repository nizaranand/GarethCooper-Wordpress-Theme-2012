<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

<div id="content" class="yui3-g central">
	<div class="yui3-u-1">

			<?php if ( have_posts() ) : ?>

				<?php
					/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
					the_post();
				?>

				<header class="page-header">
					<h1 class="page-title author"><?php echo '<span class="vcard">' . get_the_author() . '</span>'; ?></h1>
				</header>
				
				<?php 
				the_author_meta('description');
				?>
		</div>
		<div class="yui3-u-1">
				
				<h6><?php the_author(); ?> on the Web</h6>
				
				<div class="entry-meta">
				<?php
				$fields = garethcooper_get_custom_user_fields();
				foreach($fields as $fieldKey => $fieldValue) {
					if (get_the_author_meta($fieldKey) == '')
						break;
						
					switch ($fieldKey) {
						case 'twitter':
							$desc = "Twitter";
							break;
						case 'googleplus':
							$desc = "Google+";
							break;
						case 'facebook':
							$desc = 'Facebook';
							break;
					}
					
					echo sprintf('<div class="author-link vcard"><a href="%1$s?rel=author" rel="me">%2$s</a></div>',
						get_the_author_meta($fieldKey),
						$desc
						);
				}
				?>
				</div>
				
		</div>
		<div class="yui3-u-1">
				
				<h6>Posts by <?php the_author(); ?></h6>
				
				<?php
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
				?>

				<?php /* Start the Loop */ ?>
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
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'toolbox' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'toolbox' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
