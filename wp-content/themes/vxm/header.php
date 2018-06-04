<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="mobile-web-app-capable" content="yes" />

		<?php /*if(wp_is_mobile()) { ?>
		<script type='text/javascript' charset='utf-8'>			
			window.addEventListener('load', function(e) {
				setTimeout(function() { window.scrollTo(0, 1); }, 1);
			}, false);
		</script>
		<?php } */?>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
            <meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

		<script type="text/javascript">
			var templateUrl = '<?= get_bloginfo("template_url"); ?>';
		</script>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">



			<header class="header stuck" role="banner" itemscope itemtype="http://schema.org/WPHeader">



					<nav class="stuck_" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<div id="menuzord" class="menuzord-nav nav-wrapper menuzord container">
							
							<?php flat_logo(); ?>

							<?php if(is_page('app')) {
								wp_nav_menu(array(
									'container' => '',
									'menu' => __( 'The App Menu', 'bonestheme' ),
									'menu_class' => 'right nav top-nav hide-on-med-and-down cf',
									'theme_location' => 'app-nav',
									'depth' => 0,
									));
							} else {
								wp_nav_menu(array(
									'container' => '',
									'menu' => __( 'The Main Menu', 'bonestheme' ),
									'menu_class' => 'menuzord-menu right nav top-nav hide-on-med-and-down cf',
									'theme_location' => 'main-nav',
									'depth' => 0,
									'walker' => new Mi_menu_walker
									));
							} ?>
							

							<?php // SIDE NAV ?> <!-- not causing trouble -->

							<?php if(is_page('app')) {
								wp_nav_menu(array(
									'container' => '',
									'menu' => __( 'The App Menu', 'bonestheme' ),
									'menu_id' => 'nav-mobile',
									'menu_class' => 'side-nav',
									'theme_location' => 'app-nav',
									'depth' => 0,
									));
							} else {
								wp_nav_menu(array(
									'container' => '',
									'menu' => __( 'The Main Menu', 'bonestheme' ),
									'menu_id' => 'nav-mobile',
									'menu_class' => 'side-nav',
									'theme_location' => 'main-nav',
									'depth' => 1,
									'walker' => new Mi_menu_walker
									));
							} ?>

							<a href="#" data-activates="nav-mobile" class="button-collapse hide-on-print"><i class="material-icons">menu</i></a>
						</div>
					</nav>
					

				<div class="sections-menu stuck_">
					<div class="container">
						<div class="grid-noGutter">
							<div class="col-6_sm-0">
								<div id="menuzord-lng" class="menuzord-nav nav-wrapper menuzord container left fl">
									<?php wp_nav_menu(array(
									'container' => '',
									'menu' => __( 'The Language Menu', 'bonestheme' ),
									'menu_class' => 'menuzord-menu nav hide-on-med-and-down cf',
									'theme_location' => 'lng-nav',
									'depth' => 0,
									'walker' => new Mi_menu_walker
									)); ?>
								</div>
							</div>
							<div class="col-6_sm-12 text-right">
								<?php
								/*<ul>
									<li><a href="#up"><i class="ti-arrow-up"></i></a></li>
									<li><a href="<?php echo home_url(); ?>/ofi/">OFI</a></li>
									<li><a href="<?php echo home_url(); ?>/ofc/">OFC</a></li>
									<li><a href="<?php echo home_url(); ?>/ofcs/">OFCS</a></li>
									<li><a href="<?php echo home_url(); ?>/ofa/" class="active">OFA</a></li>
								</ul>*/
								?>

								<?php wp_nav_menu(array(
									'container' => '',
									'menu' => __( 'The App Menu', 'bonestheme' ),
									'menu_class' => '',
									'theme_location' => 'app-nav',
									'depth' => 0,
									));
								?>
							</div>
						</div>
					</div>
				</div>

			</header>