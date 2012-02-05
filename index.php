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

get_header(); ?>

<div id="content" class="yui3-g central">
			<div id="featureImages" class="yui3-u-1">
				<img src="img/feature-1.jpg" />
			</div>

			<div class="yui3-u-1-3">
				<div class="gridPadding">
					<h1>Latest Posts</h1>
					<p>
						<?php wp_get_archives(array(
								'type' => 'postbypost',
								'limit'=> 13)); ?>
					</p>
				</div>
			</div>
			<div class="yui3-u-1-3">
				<div class="gridPadding">
					<h1>Latest Images</h1>
					<p>Nam sollicitudin erat a velit vestibulum posuere in non
						quam. Sed sit amet dolor elementum ligula imperdiet imperdiet.
						Morbi accumsan convallis nisi, a viverra ipsum scelerisque vitae.
						Nullam id sem eu massa blandit ultricies. Curabitur venenatis
						bibendum dolor, ac accumsan odio auctor nec. Proin arcu arcu,
						cursus id pulvinar ac, scelerisque eu massa. Nullam tempor, sapien
						luctus interdum accumsan, nunc neque molestie sem, fermentum
						ultrices turpis magna vel ipsum. Phasellus felis nisi, dapibus a
						placerat a, molestie in nulla. Suspendisse potenti.</p>
				</div>
			</div>
			<div class="yui3-u-1-3">
				<div class="gridPadding">
					<h1>Archives</h1>
					<ul><?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 13 ) ); ?></ul>
				</div>
			</div>
		</div>
		<!-- #content -->

<?php get_footer(); ?>