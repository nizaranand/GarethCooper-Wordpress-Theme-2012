<?php
/**
 * The template for displaying image attachments.
 *
 * @package garethcooper
 * @since garethcooper 0.1
 */

wp_enqueue_script('google_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA-lwHqjLTE1Y_Ju9H1JbvmCI99rEMfT6Q&sensor=false');

get_header(); ?>

<div id="content" class="yui3-g central">
	<div class="yui3-u-1">

		<?php while ( have_posts() ) : the_post(); ?>

		<article itemscope itemtype="http://schema.org/Photograph"
			id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title" itemprop="headline">
					<?php the_title(); ?>
				</h1>
			</header>
			<!-- .entry-header -->

			<div class="entry-content">

				<div class="entry-attachment">
					<?php
					/**
					 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
					 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
					 */
					$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
					foreach ( $attachments as $k => $attachment ) {
						if ( $attachment->ID == $post->ID )
							break;
					}
					$k++;
					// If there is more than 1 attachment in a gallery
					if ( count( $attachments ) > 1 ) {
										if ( isset( $attachments[ $k ] ) )
											// get the URL of the next image attachment
											$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
										else
											// or get the URL of the first image attachment
											$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
									} else {
										// or, if there's only 1 image, get the URL of the image
										$next_attachment_url = wp_get_attachment_url();
									}
									?>

					<?php
					$attachment_size = apply_filters( 'garethcooper_attachment_size', 1200 );
					echo wp_get_attachment_image( $post->ID, array( $attachment_size, $attachment_size ) ); // filterable image width with, essentially, no limit for image height.
					?>

					<?php if ( ! empty( $post->post_excerpt ) ) : ?>
					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div>
					<?php endif; ?>
				</div>
				<!-- .entry-attachment -->

				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'garethcooper' ), 'after' => '</div>' ) ); ?>


				<h2>Image Data</h2>
				<?php $metadata = wp_get_attachment_metadata(); ?>

				<div class="yui3-g">
					<?php if (!empty($metadata['image_meta']['latitude']) && !empty($metadata['image_meta']['longitude']) ) : ?>
					<div class="yui3-u-1-2">
						<div id="map_canvas"
							style="width: 100%; height: 16em; background: #eee;"></div>
						<?php wp_enqueue_script('google_maps_implementation', get_template_directory_uri().'/js/googlemaps.js.php?lat='.getGps($metadata['image_meta']['latitude'], $metadata['image_meta']['latitude_ref']).'&lon='.getGps($metadata['image_meta']['longitude'], $metadata['image_meta']['longitude_ref']).'&zm=13&title='.urlencode(get_the_title()), 'google_maps', null, true); ?>
					</div>
					<?php endif; ?>

					<div class="yui3-u-1-2">

						<table class="image-metadata">

							<?php if (get_the_date() != null) : ?>
							<tr>
								<td class="image-meta-title">Published on</td>
								<td><time itemprop="datePublished"
										datetime="<?php echo get_the_date( 'c' ); ?>">
										<?php echo get_the_date(); ?>
									</time> by <span itemprop="provider"><?php echo get_the_author(); ?>
								</span>
								</td>
							</tr>
							<?php endif; ?>

							<?php if ($metadata['image_meta']['created_timestamp'] != null ) : ?>
							<tr>
								<td class="image-meta-title">Taken At</td>
								<td><time itemprop="dateCreated"
										datetime="<?php echo date_i18n('c' , $metadata['image_meta']['created_timestamp']); ?>">
										<?php echo date_i18n(get_option('time_format') , $metadata['image_meta']['created_timestamp']) ; ?>
										on
										<?php echo date_i18n(get_option('date_format') , $metadata['image_meta']['created_timestamp']) ; ?>
									</time> <?php if($metadata['image_meta']['credit'] != null ) : ?>
									by <span itemprop="creator"><?php echo $metadata['image_meta']['credit']; ?>
								</span> <?php endif; ?>
								</td>
							</tr>
							<?php endif; ?>

							<?php if ($metadata['image_meta']['aperture'] != null) : ?>
							<tr>
								<td class="image-meta-title">Aperture</td>
								<td>f/<?php echo $metadata['image_meta']['aperture']; ?></td>
							</tr>
							<?php endif; ?>

							<?php if ($metadata['image_meta']['shutter_speed'] != null ) : ?>
							<tr>
								<td class="image-meta-title">Shutter speed</td>
								<td><?php
								if ($metadata['image_meta']['shutter_speed'] < 1) {
						echo '1/' . 1/$metadata['image_meta']['shutter_speed'];
					} else {
						echo $metadata['image_meta']['shutter_speed'];
					} ?>s</td>
							</tr>
							<?php endif; ?>

							<?php if ($metadata['image_meta']['focal_length'] != null) : ?>
							<tr>
								<td class="image-meta-title">Focal Length</td>
								<td><?php echo $metadata['image_meta']['focal_length']; ?>mm</td>
							</tr>
							<?php endif; ?>

							<?php if ($metadata['image_meta']['iso'] != null ) : ?>
							<tr>
								<td class="image-meta-title">ISO</td>
								<td><?php echo $metadata['image_meta']['iso']; ?></td>
							</tr>
							<?php endif; ?>

							<?php if ($metadata['image_meta']['camera'] != null ) : ?>
							<tr>
								<td class="image-meta-title">Camera</td>
								<td><?php echo $metadata['image_meta']['camera']; ?></td>
							</tr>
							<?php endif; ?>

							<?php if ( !empty($metadata['image_meta']['location']) ) : ?>
							<tr>
								<td class="image-meta-title">Location</td>
								<td itemprop="contentLocation" itemscope
									itemtype="http://schema.org/Place">
									<div itemprop="address" itemscope
										itemtype="http://schema.org/PostalAddress">
										<?php if ( !empty($metadata['image_meta']['location']['sublocation']) ) :?>
										<span itemprop="addressLocality"><?php echo $metadata['image_meta']['location']['sublocation']; ?>
										</span>,
										<?php endif; ?>
										<?php if ( !empty($metadata['image_meta']['location']['province']) ) :?>
										<span itemprop="addressRegion"><?php echo $metadata['image_meta']['location']['province']; ?>
										</span>,
										<?php endif; ?>
										<?php if ( !empty($metadata['image_meta']['location']['country_name']) ) :?>
										<span itemprop="addressCountry"><?php echo $metadata['image_meta']['location']['country_name']; ?>
										</span>
										<?php endif; ?>
									</div> <?php if ( !empty($metadata['image_meta']['latitude']) && !empty($metadata['image_meta']['longitude']) ) : ?>
									<div itemprop="geo" itemscope
										itemtype="http://schema.org/GeoCoordinates">
										(
										<?php echo getHumanGps($metadata['image_meta']['latitude'], $metadata['image_meta']['latitude_ref']); ?>
										,
										<?php echo getHumanGps($metadata['image_meta']['longitude'], $metadata['image_meta']['longitude_ref']); ?>
										)
										<meta itemprop="latitude"
											content="<?php echo getGps($metadata['image_meta']['latitude'], $metadata['image_meta']['latitude_ref']); ?>" />
										<meta itemprop="longitude"
											content="<?php echo getGps($metadata['image_meta']['longitude'], $metadata['image_meta']['longitude_ref']); ?>" />
									</div>
									<meta itemprop="map" content="https://maps.google.com/maps?q=loc:<?php echo getGps($metadata['image_meta']['latitude'], $metadata['image_meta']['latitude_ref']); ?>,<?php echo getGps($metadata['image_meta']['longitude'], $metadata['image_meta']['longitude_ref']); ?>&t=m&z=15" />
									<?php endif; ?>
								</td>
							</tr>
							<?php endif; ?>

						</table>
					</div>
				</div>

				<pre>
				<?php
				//print_r($metadata);
					
				$img_src = wp_get_attachment_image_src( $post->ID, 'full' );
					
				$size = getimagesize($img_src[0], $info);
				if(isset($info['APP13']))
				{
					$iptc = iptcparse($info['APP13']);

					//var_dump($iptc);
				}
					
				$exif = exif_read_data( $img_src[0] );
				//print_r($exif);
				?>
				</pre>
			</div>
			<!-- .entry-content -->

			<nav id="image-navigation">
				<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous' , 'garethcooper' ) ); ?>
				</span> <span class="next-image"><?php next_image_link( false, __( 'Next &rarr;' , 'garethcooper' ) ); ?>
				</span>
			</nav>
			<!-- #image-navigation -->

			<footer class="entry-meta">
				<?php if ( comments_open() && pings_open() ) : // Comments and trackbacks open ?>
				<?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'garethcooper' ), get_trackback_url() ); ?>
				<?php elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open ?>
				<?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'garethcooper' ), get_trackback_url() ); ?>
				<?php elseif ( comments_open() && ! pings_open() ) : // Only comments open ?>
				<?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'garethcooper' ); ?>
				<?php elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed ?>
				<?php _e( 'Both comments and trackbacks are currently closed.', 'garethcooper' ); ?>
				<?php endif; ?>
			</footer>
			<!-- .entry-meta -->
		</article>
		<!-- #post-<?php the_ID(); ?> -->

		<?php comments_template(); ?>

		<?php endwhile; // end of the loop. ?>

	</div>
	<!-- #content -->
</div>
<!-- #primary -->

<?php get_footer(); ?>