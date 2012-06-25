<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package garethcooper
 * @since garethcooper 0.1
 */

get_header(); ?>

<div id="content" class="yui3-g central">

	<div class="yui3-u-1" style="text-align:center">
			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Well this is somewhat embarrassing, isn&rsquo;t it?', 'garethcooper' ); ?></h1>
				</header>

				<div class="entry-content">
					<p style="text-align:center"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'garethcooper' ); ?></p>

					<?php get_search_form(); ?>
			</div> <!-- .entry-content -->
	</div> <!-- .yui3-u-1 -->
	
	<div class="yui3-u-1-3">
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
	</div>
	
	<div class="yui3-u-1-3">
					<div class="widget">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'garethcooper' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div>
	</div> <!-- .yui3-u-1-3 -->
	
	<div class="yui3-u-1-3">
					<?php
					the_widget( 'WP_Widget_Archives', 'dropdown=1');
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		</div><!-- .yui3-u-1-3 -->
		
	</div><!-- #content -->

<?php get_footer(); ?>
