<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title(); ?></title>

<!-- webfonts -->
<link
	href='http://fonts.googleapis.com/css?family=Open+Sans:600,300italic,300'
	rel='stylesheet' type='text/css'>
<link
	href='<?php bloginfo( 'stylesheet_directory' ); ?>/fonts/roboto.1/roboto-stylesheet.css'
	rel='stylesheet' type='text/css'>

<!-- CSS -->
<link rel="stylesheet" type="text/css" media="all"
	href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<link rel="profile" href="http://gmpg.org/xfn/11" />

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="everything" class="yui3-g">
		<div id="menubar" class="yui3-u-1">
			<div id="access" class="central">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</div>
		</div>
		<!-- #menubar -->