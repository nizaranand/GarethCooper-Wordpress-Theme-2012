<?php
/**
 * garethcooper functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package garethcooper
 * @since garethcooper 0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 780; /* pixels */

if ( ! function_exists( 'garethcooper_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which runs
* before the init hook. The init hook is too late for some features, such as indicating
* support post thumbnails.
*
* To override garethcooper_setup() in a child theme, add your own garethcooper_setup to your child theme's
* functions.php file.
*/
function garethcooper_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on garethcooper, use a find and replace
	 * to change 'garethcooper' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'garethcooper', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'theme-options' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'garethcooper' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'status') );

	//Theme support for thumbnails (posts & pages only)
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

	//Full theme width image
	add_image_size( 'gc-full', 974, 9999 ); //Full theme width (and unlimited height)
	add_image_size( 'gc-frontpage-featured', 974, 400, true ); //Frontpage featured image, cropped
	add_image_size( 'gc-frontpage-thumb', 84, 84, true ); //Frontpage thumbnail, cropped

	//Editor stylesheet
	add_editor_style();

	// Load up our theme options page
	//require( get_template_directory() . '/inc/theme-options.php' );
}
endif; // garethcooper_setup

/**
 * Tell WordPress to run garethcooper_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'garethcooper_setup' );

/**
 * Set a default theme color array for WP.com.
*/
$themecolors = array(
		'bg' => 'ffffff',
		'border' => 'eeeeee',
		'text' => '444444',
);

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
*/
function garethcooper_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'garethcooper_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
*/
function garethcooper_widgets_init() {
	register_sidebar( array(
	'name' => __( 'Home Page Main Block', 'garethcooper' ),
	'id' => 'home-main'
			) );

	register_sidebar( array(
	'name' => __( 'Sidebar', 'garethcooper' ),
	'id' => 'sidebar'
			) );

	register_sidebar( array(
	'name' => __( 'Footer Column 1', 'garethcooper' ),
	'id' => 'footer-1',
	'before_title' => '<h1 class="widget-title">',
	'after_title' => '</h1>',
	) );

	register_sidebar( array(
	'name' => __( 'Footer Column 2', 'garethcooper' ),
	'id' => 'footer-2',
	'before_title' => '<h1 class="widget-title">',
	'after_title' => '</h1>',
	) );

	register_sidebar( array(
	'name' => __( 'Footer Column 3', 'garethcooper' ),
	'id' => 'footer-3',
	'before_title' => '<h1 class="widget-title">',
	'after_title' => '</h1>',
	) );
}
add_action( 'init', 'garethcooper_widgets_init' );

if ( ! function_exists( 'garethcooper_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
*
* @since garethcooper 1.2
*/
function garethcooper_content_nav( $nav_id ) {
	global $wp_query;

	?>
<nav id="<?php echo $nav_id; ?>">

	<?php if ( is_single() ) : // navigation links for single posts ?>

	<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'garethcooper' ) . '</span>' ); ?>
	<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'garethcooper' ) . '</span> %title' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

	<?php if ( get_next_posts_link() ) : ?>
	<div class="nav-previous">
		<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'garethcooper' ) ); ?>
	</div>
	<?php endif; ?>

	<?php if ( get_previous_posts_link() ) : ?>
	<div class="nav-next">
		<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'garethcooper' ) ); ?>
	</div>
	<?php endif; ?>

	<?php endif; ?>

</nav>
<!-- #<?php echo $nav_id; ?> -->
<?php
}
endif; // garethcooper_content_nav


if ( ! function_exists( 'garethcooper_comment' ) ) :
/**
 * Template for comments and pingbacks.
*
* To override this walker in a child theme without modifying the comments template
* simply create your own garethcooper_comment(), and that function will be used instead.
*
* Used as a callback by wp_list_comments() for displaying the comments.
*
* @since garethcooper 0.4
*/
function garethcooper_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
		?>
<li class="post pingback">
	<p>
		<?php _e( 'Pingback:', 'garethcooper' ); ?>
		<?php comment_author_link(); ?>
		<?php edit_comment_link( __( '(Edit)', 'garethcooper' ), ' ' ); ?>
	</p> <?php
	break;
default :
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="comment">
		<footer>
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">says:</span>', 'garethcooper' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div>
			<!-- .comment-author .vcard -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'garethcooper' ); ?>
			</em> <br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata">
				<a
					href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time
						pubdate datetime="<?php comment_time( 'c' ); ?>">
						<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'garethcooper' ), get_comment_date(), get_comment_time() ); ?>
					</time>
				</a>
				<?php edit_comment_link( __( '(Edit)', 'garethcooper' ), ' ' );
				?>
			</div>
			<!-- .comment-meta .commentmetadata -->
		</footer>

		<div class="comment-content">
			<?php comment_text(); ?>
		</div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
		<!-- .reply -->
	</article>
	<!-- #comment-## --> <?php
	break;
	endswitch;
}
endif; // ends check for garethcooper_comment()

if ( ! function_exists( 'garethcooper_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
* Create your own garethcooper_posted_on to override in a child theme
*
* @since garethcooper 1.2
*/
function garethcooper_posted_on() {
	printf( __( '<div itemprop="author"><span class="author vcard" itemscope itemtype="http://schema.org/Person">By <a class="url fn n" href="%5$s" title="%6$s" rel="author" itemprop="name">%7$s</a></span></div>
 		<div><a href="%1$s" title="View all posts from %2$s" ><time class="entry-date" itemprop="datePublished" datetime="%3$s" pubdate>%4$s</time></a></div>', 'garethcooper' ),
 		//esc_url( get_permalink() ),
	esc_url( get_month_link(get_the_time('Y'), get_the_time('m') ) ),
	esc_attr( get_the_date( 'F Y') ),
	esc_attr( get_the_date( 'c' ) ),
	esc_html( get_the_date() ),
	esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	esc_attr( sprintf( __( 'View all posts by %s', 'garethcooper' ), get_the_author() ) ),
	esc_html( get_the_author() )	 
	);
	
	if (get_the_modified_date() != get_the_date() ) :
		printf('<div style="margin-right:1em">(Last modified <time itemprop="dateModified" datetime="%1$s">%2$s</time>)</div>',
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_attr( get_the_modified_date() )
		);
	endif;

	if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
	<?php
	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( __( ', ', 'garethcooper' ) );	
	if ( $categories_list && garethcooper_categorized_blog() ) :
	?>
	<div class="cat-links">
		<?php printf( __( '%1$s', 'garethcooper' ), $categories_list ); ?>
	</div> <?php endif; // End if categories ?> <?php
	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '', __( ', ', 'garethcooper' ) );
	if ( $tags_list ) :
	?>
	<div class="tag-links" itemprop="keywords">
		<?php printf( __( '%1$s', 'garethcooper' ), $tags_list ); ?>
	</div> <?php endif; // End if $tags_list ?> <?php endif; // End if 'post' == get_post_type() ?>

	<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
	<div class="comments-link">
		<?php printf( '<a href="%1$s" title="Comment on %2$s" itemprop="discussionUrl">Leave a comment</a>',
			esc_url( get_permalink() ) . '#respond',
			esc_html ( get_the_title() )
			);  ?>
	</div> <?php endif; ?> <?php
}
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @since garethcooper 1.2
 */
function garethcooper_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'garethcooper_body_classes' );

/**
 * Returns true if a blog has more than 1 category
 *
 * @since garethcooper 1.2
*/
function garethcooper_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so garethcooper_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so garethcooper_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in garethcooper_categorized_blog
 *
 * @since garethcooper 1.2
 */
function garethcooper_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'garethcooper_category_transient_flusher' );
add_action( 'save_post', 'garethcooper_category_transient_flusher' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
*/
function garethcooper_enhanced_image_navigation( $url ) {
	global $post, $wp_rewrite;

	$id = (int) $post->ID;
	$object = get_post( $id );
	if ( wp_attachment_is_image( $post->ID ) && ( $wp_rewrite->using_permalinks() && ( $object->post_parent > 0 ) && ( $object->post_parent != $id ) ) )
		$url = $url . '#main';

	return $url;
}
add_filter( 'attachment_link', 'garethcooper_enhanced_image_navigation' );

/**
 * Add custom contact fields
*/
function garethcooper_get_custom_user_fields() {
	$fields = array(
		'facebook' => 'Facebook URL',
		'googleplus' => 'Google+ URL',
		'twitter' => 'Twitter URL'
		);

	return $fields;
}
add_filter('user_contactmethods','garethcooper_get_custom_user_fields');

/**
 * Fetch Geo Data from the image EXIF & IPTC data when using the wp_get_attachment_metadata() function
 * EXIF reading credit: {@author http://www.kristarella.com/2009/04/add-image-exif-metadata-to-wordpress/}
 * IPTC reading by {@author Gareth Cooper http://garethcooper.com}
 * {@see http://phpgraphy.sourceforge.net/manual/latest/apas04.html} for IPTC keywords
*/
function add_geo_exif($meta,$file,$sourceImageType) {
	//Read EXIF data
	$exif = @exif_read_data( $file );
	if (!empty($exif['GPSLatitude']))
		$meta['latitude'] = $exif['GPSLatitude'] ;
	if (!empty($exif['GPSLatitudeRef']))
		$meta['latitude_ref'] = trim( $exif['GPSLatitudeRef'] );
	if (!empty($exif['GPSLongitude']))
		$meta['longitude'] = $exif['GPSLongitude'] ;
	if (!empty($exif['GPSLongitudeRef']))
		$meta['longitude_ref'] = trim( $exif['GPSLongitudeRef'] );
	
	//Read IPTC data
	getimagesize($file, $info);
	if(isset($info['APP13']))
	{
		$iptc = iptcparse($info['APP13']);
		
		//country name
		if (!empty($iptc['2#101'][0]))
			$meta['location']['country_name'] = trim($iptc['2#101'][0]);
		//country code
		if (!empty($iptc['2#100'][0]))
			$meta['location']['country_code'] = trim($iptc['2#101'][0]);
		//province or state
		if (!empty($iptc['2#095'][0]))
			$meta['location']['province'] = trim($iptc['2#095'][0]);
		//sublocation
		if (!empty($iptc['2#092'][0]))
			$meta['location']['sublocation'] = trim($iptc['2#092'][0]);
	}
	
	return $meta;
}
add_filter('wp_read_image_metadata', 'add_geo_exif','',3);

/**
 * Helper function to convert exif_read_data's deg min secs into decimal
 * Credit: http://stackoverflow.com/a/2572991
*/
function getGps($exifCoord, $hemi)
{
	$degrees = count($exifCoord) > 0 ? gps2Num($exifCoord[0]) : 0;
    $minutes = count($exifCoord) > 1 ? gps2Num($exifCoord[1]) : 0;
    $seconds = count($exifCoord) > 2 ? gps2Num($exifCoord[2]) : 0;

    $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;

    return $flip * ($degrees + $minutes / 60 + $seconds / 3600);
}

function getHumanGps($exifCoord, $hemi)
{
	$degrees = count($exifCoord) > 0 ? gps2Num($exifCoord[0]) : 0;
	$minutes = count($exifCoord) > 1 ? gps2Num($exifCoord[1]) : 0;
	$seconds = count($exifCoord) > 2 ? gps2Num($exifCoord[2]) : 0;

	return round($degrees + $minutes / 60 + $seconds / 3600, 3) . ' ' . $hemi;
}

function gps2Num($coordPart)
{
	$parts = explode('/', $coordPart);

	if(count($parts) <= 0)// jic
		return 0;
	if(count($parts) == 1)
		return $parts[0];

	return floatval($parts[0]) / floatval($parts[1]);
}

/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and Gareth Cooper.
 */
