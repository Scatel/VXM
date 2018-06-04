<?php
/**
 * Extend Textarea Customize Control
 *
 * https://gist.github.com/Abban/2968549
 * http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
 *
 */
include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

/**
 * Register Customize
 */
function flat_customize_register( $wp_customize ) {

	//Logo & Slogan
	$wp_customize->add_setting('bones_theme_options[logo]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option',
		));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo', array(
		'label' => __('Site Logo', 'bonestheme'),
		'section' => 'title_tagline',
		'settings' => 'bones_theme_options[logo]',
		)));
	$wp_customize->add_setting('bones_theme_options[header_display]', array(
		'default'        => 'site_title',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		'sanitize_callback' => 'flat_sanitize_header_display',
		));
	$wp_customize->add_control( 'header_display', array(
		'settings' => 'bones_theme_options[header_display]',
		'label'   => __('Display as', 'bonestheme'),
		'section' => 'title_tagline',
		'type'    => 'select',
		'choices'    => array(
			'site_title' => __('Site Title', 'bonestheme'),
			'site_logo' => __('Site Logo', 'bonestheme'),
			'both_title_logo' => __('Logo & Title', 'bonestheme'),
			),
		));

	$wp_customize->add_setting('bones_theme_options[display_slogan]', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		));
	$wp_customize->add_control('display_slogan', array(
		'label'      => __('Show Site Description as Slogan', 'bonestheme'),
		'section'    => 'title_tagline',
		'settings'   => 'bones_theme_options[display_slogan]',
		'type'       => 'checkbox'
		));

	// Body Background Size
	$wp_customize->add_setting('bones_theme_options[background_size]', array(
		'default'        => 'cover',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		'sanitize_callback' => 'flat_sanitize_background_size',
		));
	$wp_customize->add_control( 'background_size', array(
		'settings' => 'bones_theme_options[background_size]',
		'label'   => 'Background size',
		'section' => 'background_image',
		'type'    => 'radio',
		'choices'    => array(
			'cover' => 'Cover',
			'contain' => 'Contain',
			'initial' => 'Initial',
			),
		));

	// Google Analytics Section
	$wp_customize->add_section('analytics', array(
		'title'    => __('Google Analytics', 'bonestheme'),
		'priority' => 1000,
		));
	$wp_customize->add_setting('bones_theme_options[ga_id]', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		));
	$wp_customize->add_control( 'ga_id', array(
		'settings' => 'bones_theme_options[ga_id]',
		'label' => __('Tracking Code ID (UA-000...)', 'bonestheme'),
		'section' => 'analytics',
		'type'    => 'text'
		));
	$wp_customize->add_setting('bones_theme_options[ga_display_features]', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		));
	$wp_customize->add_control('ga_display_features', array(
		'label'      => __('Display Network Features', 'bonestheme'),
		'section'    => 'analytics',
		'settings'   => 'bones_theme_options[ga_display_features]',
		'type'       => 'checkbox'
		));

	$wp_customize->add_setting('bones_theme_options[ga_extra_code]', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		));
	$wp_customize->add_control( 'ga_extra_code', array(
		'settings' => 'bones_theme_options[ga_extra_code]',
		'label' => __('Extra Code', 'bonestheme'),
		'section' => 'analytics',
		'type'    => 'text'
		));

	// Social & Contact Section
	$wp_customize->add_section('social', array(
		'title'    => __('Social & Contact', 'bonestheme'),
		'priority' => 2000,
		));

	$wp_customize->add_setting('bones_theme_options[header_phone]', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		));
	$wp_customize->add_control( 'header_phone', array(
		'settings' => 'bones_theme_options[header_phone]',
		'label' => __('Phone Number', 'bonestheme'),
		'section' => 'social',
		'type'    => 'text'
		));

	$wp_customize->add_setting('bones_theme_options[facebook]', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		));
	$wp_customize->add_control( 'facebook', array(
		'settings' => 'bones_theme_options[facebook]',
		'label' => __('Facebook', 'bonestheme'),
		'section' => 'social',
		'type'    => 'text'
		));

	$wp_customize->add_setting('bones_theme_options[twitter]', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		));
	$wp_customize->add_control( 'twitter', array(
		'settings' => 'bones_theme_options[twitter]',
		'label' => __('Twitter', 'bonestheme'),
		'section' => 'social',
		'type'    => 'text'
		));

	$wp_customize->add_setting('bones_theme_options[google]', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		));
	$wp_customize->add_control( 'google', array(
		'settings' => 'bones_theme_options[google]',
		'label' => __('Google +', 'bonestheme'),
		'section' => 'social',
		'type'    => 'text'
		));

	$wp_customize->add_setting('bones_theme_options[instagram]', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		));
	$wp_customize->add_control( 'instagram', array(
		'settings' => 'bones_theme_options[instagram]',
		'label' => __('Instagram', 'bonestheme'),
		'section' => 'social',
		'type'    => 'text'
		));

	$wp_customize->add_setting('bones_theme_options[spotify]', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		));
	$wp_customize->add_control( 'spotify', array(
		'settings' => 'bones_theme_options[spotify]',
		'label' => __('Spotify', 'bonestheme'),
		'section' => 'social',
		'type'    => 'text'
		));

	$wp_customize->add_setting('bones_theme_options[email]', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
		));
	$wp_customize->add_control( 'email', array(
		'settings' => 'bones_theme_options[email]',
		'label' => __('Email', 'bonestheme'),
		'section' => 'social',
		'type'    => 'text'
		));
}
add_action( 'customize_register', 'flat_customize_register' );

/**
 * Sanitize Settings
 */
function flat_sanitize_header_display( $header_display ) {
	if ( ! in_array( $header_display, array( 'site_title', 'site_logo', 'both_title_logo' ) ) ) {
		$header_display = 'site_title';
	}
	return $header_display;
}

function flat_sanitize_background_size( $background_size ) {
	if ( ! in_array( $background_size, array( 'cover', 'contain', 'initial' ) ) ) {
		$background_size = 'cover';
	}
	return $background_size;
}

/**
 * Get Theme Options
 */
function bones_get_theme_option( $option_name, $default = '' ) {
	$options = get_option( 'bones_theme_options' );
	if( isset($options[$option_name]) ) {
		return $options[$option_name];
	}
	return $default;
}

/**
 * Change Favicon
 */
function google_analytics() {
	$ga_id = bones_get_theme_option('ga_id');
	$ga_gdn = bones_get_theme_option('ga_display_features');
	if ( !empty($ga_gdn) ) {
		$ga_display_features = "ga('require', 'displayfeatures');";
	}
	$ga_extra_code = bones_get_theme_option('ga_extra_code');

	if( !empty($ga_id) ) {
		echo "
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', '".$ga_id."', 'auto');
ga('send', 'pageview');
".$ga_display_features."
".$ga_extra_code."
</script>
		";
	}
}
add_action( 'wp_head', 'google_analytics' );

/**
 * Custom CSS
 */
function flat_custom_css() {
	$custom_style = '<style type="text/css">';
	$background_size = bones_get_theme_option('background_size');
	if( !empty($background_size) ) {
		$custom_style.= 'body { background-size: '.$background_size.'; }';
	}
	$custom_style.= '</style>';
	echo $custom_style;
}
add_action( 'wp_head', 'flat_custom_css' );


/**
 * Display Logo
 */
function flat_logo() {
	$header_display = bones_get_theme_option( 'header_display', 'site_title' );

	if($header_display == 'both_title_logo') {
		$header_class = 'display-title-logo';
	} else if ($header_display == 'site_logo') {
		$header_class = 'display-logo';
	} else {
		$header_class = 'display-title';
	}

	$logo = esc_url(bones_get_theme_option( 'logo' ));
	$tagline = get_bloginfo( 'description' );
	$display_slogan = bones_get_theme_option( 'display_slogan' );

	echo '<h1 id="logo" class="site-title '.$header_class.'" itemscope itemtype="http://schema.org/Organization"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="nofollow">';
	if ( $header_class != 'display-title' ) {
		echo '<img alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" src="'.$logo.'" />';
	}
	if ( $header_class != 'display-logo' ) {
		echo get_bloginfo( 'name' );
	}
	if( !empty($tagline) && !empty($display_slogan) ) {
		echo '<span class="site-description">'.$tagline.'</span>';
	}
	echo '</a></h1>';

	/*if( !empty($tagline) && !empty($display_slogan) ) {
		echo '<h2 class="site-description hide-on-small-only">'.$tagline.'</h2>';
	}*/

}