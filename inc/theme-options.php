<?php 
/**
 * Register the form setting for our twentyeleven_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, twentyeleven_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * @since Twenty Eleven 1.0
 */
function garethcooper_theme_options_init() {

	register_setting(
			'garethcooper_options',       // Options group, see settings_fields() call in twentyeleven_theme_options_render_page()
			'garethcooper_theme_options', // Database option, see twentyeleven_get_theme_options()
			'garethcooper_theme_options_validate' // The sanitization callback, see twentyeleven_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
			'frontpage', // Unique identifier for the settings section
			'Frontpage', // Section title (we don't want one)
			'__return_false', // Section callback (we don't want anything)
			'theme_options' // Menu slug, used to uniquely identify the page; see garethcooper_theme_options_add_page()
	);		
	
	// Register our individual settings fields
	add_settings_field(
		'frontpage_headline',  // Unique identifier for the field for this section
		__( 'Headline', 'garethcooper' ), // Setting field label
		'garethcooper_settings_field_frontpage_headline', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see twentyeleven_theme_options_add_page()
		'frontpage' // Settings section. Same as the first argument in the add_settings_section() above
	);
	
}
add_action( 'admin_init', 'garethcooper_theme_options_init' );



/**
 * Add our theme options page to the admin menu, including some help documentation.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Twenty Eleven 1.0
 */
function garethcooper_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'garethcooper' ),   // Name of page
		__( 'Theme Options', 'garethcooper' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'garethcooper_theme_options_render_page' // Function that renders the options page
	);

	if ( ! $theme_page )
		return;

	add_action( "load-$theme_page", 'garethcooper_theme_options_help' );
}
add_action( 'admin_menu', 'garethcooper_theme_options_add_page' );

/**
 * Help screen
 */
function garethcooper_theme_options_help() {

	$help = '<p>' . __( 'Some themes provide customization options that are grouped together on a Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, Twenty Eleven, provides the following Theme Options:', 'twentyeleven' ) . '</p>' .
			'<ol>' .
			'<li>' . __( '<strong>Color Scheme</strong>: You can choose a color palette of "Light" (light background with dark text) or "Dark" (dark background with light text) for your site.', 'twentyeleven' ) . '</li>' .
			'<li>' . __( '<strong>Link Color</strong>: You can choose the color used for text links on your site. You can enter the HTML color or hex code, or you can choose visually by clicking the "Select a Color" button to pick from a color wheel.', 'twentyeleven' ) . '</li>' .
			'<li>' . __( '<strong>Default Layout</strong>: You can choose if you want your site&#8217;s default layout to have a sidebar on the left, the right, or not at all.', 'twentyeleven' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 'twentyeleven' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 'garethcooper' ) . '</strong></p>' .
			'<p>' . __( '<a href="http://garethcooper.com/wordpress/themes" target="_blank">Theme page for Gareth Cooper 2012</a>', 'garethcooper' ) . '</p>';

	$screen = get_current_screen();

	if ( method_exists( $screen, 'add_help_tab' ) ) {
		// WordPress 3.3
		$screen->add_help_tab( array(
				'title' => __( 'Overview', 'twentyeleven' ),
				'id' => 'theme-options-help',
				'content' => $help,
		)
		);

		$screen->set_help_sidebar( $sidebar );
	} else {
		// WordPress 3.2
		add_contextual_help( $screen, $help . $sidebar );
	}
}

function garethcooper_settings_field_frontpage_headline() {
	$options = garethcooper_get_theme_options();
?>

	<div class="">
		<label class="description">
			<input type="text" name="garethcooper_theme_options[frontpage_headline]" value="<?php echo $options['frontpage_headline']; ?>" />
		</label>
	</div>

<?php
}

function garethcooper_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'garethcooper' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'garethcooper_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

function garethcooper_get_theme_options() {
	return get_option( 'garethcooper_theme_options' );
}

function garethcooper_theme_options_validate( $input ) {
	return $input;
}

