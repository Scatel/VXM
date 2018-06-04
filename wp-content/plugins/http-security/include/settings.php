<?php

if ( ! defined( 'ABSPATH' ) ) { 
    exit;
}

function http_security_network_options_page() {
	add_submenu_page( 'settings.php', __( 'HTTP Security Network Options', 'http-security' ), 'HTTP Security', 'manage_network_options', 'http-security', 'http_security_network_options_page_html');
}

function http_security_network_options_page_html() {
	echo '<div class="wrap">';
	echo '<h1>'. __( 'HTTP Security Network Options', 'http-security' ).'</h1>';
	echo '<p>'. __( 'The HTTP protocol provides various header instructions allowing simple improvement of your web site security. As usual, make sure to run full tests on your web site as some options may result in some features stop working.', 'http-security' ).'</p>';
	echo '<p>'. __( 'Values of the following options from the main site will be set as default for newly created sites.', 'http-security' ).'</p>';
	echo '<form method="post" action="options.php">';

	settings_fields( 'http-security' );
	if ( isSecure() ) {
		echo '<h3>'. __( 'HSTS', 'http-security' ).'</h3>';
		echo '<label for="http_security_sts_flag"><input name="http_security_sts_flag" type="checkbox" id="http_security_sts_flag" value="1" ' . checked( 1, get_option( 'http_security_sts_flag' ), false ) . ' />'. __( 'Force HTTPS protocol', 'http-security' ).'</label><br />';
		echo '<blockquote id="http_security_sts_options"><label for="http_security_sts_subdomains_flag"><input name="http_security_sts_subdomains_flag" type="checkbox" id="http_security_sts_subdomains_flag" value="1" ' . checked( 1, get_option( 'http_security_sts_subdomains_flag' ), false ) . ' />'. __( 'Include subdomains', 'http-security' ).'</label><br /><label for="http_security_sts_preload_flag"><input name="http_security_sts_preload_flag" type="checkbox" id="http_security_sts_preload_flag" value="1" ' . checked( 1, get_option( 'http_security_sts_preload_flag' ), false ) . ' />'. __( 'Preload', 'http-security' ).'</label> <a href="https://hstspreload.appspot.com/" target="_blank">'. __( 'Submit domain preload to browsers', 'http-security' ).'</a><br /><label for="http_security_sts_max_age">'. __('Max age:', 'http-security' ) .' <input name="http_security_sts_max_age" type="text" id="http_security_sts_max_age" value="'. get_option( 'http_security_sts_max_age' ) .'" size="10" /> '. __('seconds', 'http-security' ) .' (86400 = '. __('one day', 'http-security' ) .', 31536000 = '. __('one year', 'http-security' ) .', 2592000 ('. __('recommended', 'http-security' ) .')</label></blockquote>';
	}
	else {
		echo '<p class="http-security-warning"><span class="dashicons dashicons-warning"></span> <strong>'. __( 'You are not running HTTPS.', 'http-security' ).'</strong></p>';
	}

	echo '<label for="http_security_remove_php_version"><input name="http_security_remove_php_version" type="checkbox" id="http_security_remove_php_version" value="1" ' . checked( 1, get_option( 'http_security_remove_php_version' ), false ) . ' />'. __( 'Remove PHP version information from HTTP header', 'http-security' ).'</label><br />';

	echo '<label for="http_security_remove_wordpress_version"><input name="http_security_remove_wordpress_version" type="checkbox" id="http_security_remove_wordpress_version" value="1" ' . checked( 1, get_option( 'http_security_remove_wordpress_version' ), false ) . ' />'. __( 'Remove WordPress version information from header', 'http-security' ).'</label><br />';

	submit_button();
	echo '</form>';
	if ( username_exists( 'admin' ) ) {
		echo '<p class="http-security-warning"><span class="dashicons dashicons-warning"></span> '. __('You still have an administrator account with the user name security <strong>admin</strong>. This is a major security flaw, you should consider renaming this account.', 'http-security') .'</p>';
	}
	echo '</div>';
}

function http_security_options_page() {
//	add_submenu_page( 'options-general.php', 'HTTP Security Options', 'HTTP Security', 'manage_options', 'http-security', 'http_security_options', '', '');
	$count = http_security_issues_count();
	if ( $count > 0 )
		$menu_entry = 'HTTP Security <span class="update-plugins count-1"><span class="update-count">'.$count.'</span></span>';
	else
		$menu_entry = 'HTTP Security';
	add_options_page( __( 'HTTP Security Options', 'http-security' ), $menu_entry, 'manage_options', 'http-security', 'http_security_options_page_html');
}

function http_security_options_page_html() {
	if ( !current_user_can( 'manage_options' ) )
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'http-security' ) );

	echo '<style>.http-security-warning {background-color:yellow;padding:5px;text-align:center;}</style>';
	echo '<div class="wrap">';
	echo '<h1>'. __( 'HTTP Security Options', 'http-security' ).'</h1>';
	$active_tab = 'general-options';
/*
	if(isset($_GET['tab'])) {
		if($_GET['tab'] == 'general-options')
			$active_tab = 'general-options';
		else
			$active_tab = 'csp-options';
	}
*/
	switch($_GET['tab']) {
		case 'general-options':
			$active_tab = 'general-options';
			break;
		case 'csp-options':
			$active_tab = 'csp-options';
			break;
		case 'htaccess':
			$active_tab = 'htaccess';
			break;
	}
	echo '<p>'. __( 'The HTTP protocol provides various header instructions allowing simple improvement of your web site security. As usual, make sure to run full tests on your web site as some options may result in some features stop working.', 'http-security' ).'</p>';
	if($active_tab == 'general-options') {
		echo '<h2 class="nav-tab-wrapper"><a href="?page=http-security&tab=general-options" class="nav-tab nav-tab-active">'. __('General options', 'http-security' ).'</a> <a href="?page=http-security&tab=csp-options" class="nav-tab">'. __('CSP options', 'http-security' ).'</a> <a href="?page=http-security&tab=htaccess" class="nav-tab">'. __('.htaccess (beta)', 'http-security' ).'</a></h2>';

		echo '<p>'. __( 'For more information about these security hacks, please make sure to read my article about <a href="https://www.carlconrad.net/en/2016/11/18/secure-website-http-headers-instructions/" target="_blank" rel="noopener">how to improve your website security with HTTP header instructions</a>.', 'http-security' ).'</p>';

		echo '<form method="post" action="options.php">';

		settings_fields( 'http-security' );

		if ( isSecure() ) {
			echo '<h3>'. __( 'HSTS', 'http-security' ).'</h3>';
			echo '<label for="http_security_sts_flag"><input name="http_security_sts_flag" type="checkbox" id="http_security_sts_flag" value="1" ' . checked( 1, get_option( 'http_security_sts_flag' ), false ) . ' />'. __( 'Force HTTPS protocol', 'http-security' ).'</label><br />';
			echo '<blockquote id="http_security_sts_options"><label for="http_security_sts_subdomains_flag"><input name="http_security_sts_subdomains_flag" type="checkbox" id="http_security_sts_subdomains_flag" value="1" ' . checked( 1, get_option( 'http_security_sts_subdomains_flag' ), false ) . ' />'. __( 'Include subdomains', 'http-security' ).'</label><br /><label for="http_security_sts_preload_flag"><input name="http_security_sts_preload_flag" type="checkbox" id="http_security_sts_preload_flag" value="1" ' . checked( 1, get_option( 'http_security_sts_preload_flag' ), false ) . ' />'. __( 'Preload', 'http-security' ).'</label> <a href="https://hstspreload.appspot.com/" target="_blank">'. __( 'Submit domain preload to browsers', 'http-security' ).'</a><br /><label for="http_security_sts_max_age">'. __('Max age:', 'http-security' ) .' <input name="http_security_sts_max_age" type="text" id="http_security_sts_max_age" value="'. get_option( 'http_security_sts_max_age' ) .'" size="10" /> '. __('seconds', 'http-security' ) .' (86400 = '. __('one day', 'http-security' ) .', 31536000 = '. __('one year', 'http-security' ) .', 2592000 ('. __('recommended', 'http-security' ) .')</label></blockquote>';
		}
		else {
			echo '<p class="http-security-warning"><span class="dashicons dashicons-warning"></span> <strong>'. __( 'You are not running HTTPS.', 'http-security' ).'</strong></p>';
		}
		echo '<h3>'. __( 'Expect-CT', 'http-security' ).'</h3>';
		echo '<label for="http_security_expect_ct_flag"><input name="http_security_expect_ct_flag" type="checkbox" id="http_security_expect_ct_flag" value="1" ' . checked( 1, get_option( 'http_security_expect_ct_flag' ), false ) . ' />'. __( 'Enable Expect-CT', 'http-security' ).'</label><br />';

		echo '<blockquote id="http_security_expect_ct_options"><label for="http_security_expect_ct_subdomains_flag"><input name="http_security_expect_ct_enforce_flag" type="checkbox" id="http_security_expect_ct_enforce_flag" value="1" ' . checked( 1, get_option( 'http_security_expect_ct_enforce_flag' ), false ) . ' />'. __( 'Enforce', 'http-security' ).'</label><br /><label for="http_security_expect_ct_max_age">'. __('Max age:', 'http-security' ) .' <input name="http_security_expect_ct_max_age" type="text" id="http_security_expect_ct_max_age" value="'. get_option( 'http_security_expect_ct_max_age' ) .'" size="10" /> '. __('seconds', 'http-security' ) .' (86400 = '. __('one day', 'http-security' ) .', 31536000 = '. __('one year', 'http-security' ) .', 2592000 ('. __('recommended', 'http-security' ) .')</label><br /><label for="http_security_expect_ct_report_uri">'. __( 'Report URI:', 'http-security' ).'<input name="http_security_expect_ct_report_uri" type="text" id="http_security_expect_ct_report_uri" value="'. get_option( 'http_security_expect_ct_report_uri' ) .'" size="40" /></label></blockquote>';

		echo '<h3>'. __( 'X-frame-options', 'http-security' ).'</h3>';
		echo '<label for="http_security_x_frame_flag"><input name="http_security_x_frame_flag" type="checkbox" id="http_security_x_frame_flag" value="1" ' . checked( 1, get_option( 'http_security_x_frame_flag' ), false ) . ' />'. __( 'Manage display in remote frames', 'http-security' ).'</label><br />';
		echo '<blockquote><table>';
		echo '<tr class="http_security_x_frame_options"><td></td><td><label for="http_security_x_frame_deny"><input name="http_security_x_frame_options" type="radio" id="http_security_x_frame_deny" value="1" ' . checked( 1, get_option( 'http_security_x_frame_options' ), false ) . ' />DENY</label></td></tr>';
		echo '<tr class="http_security_x_frame_options"><td></td><td><label for="http_security_x_frame_sameorigin"><input name="http_security_x_frame_options" type="radio" id="http_security_x_frame_sameorigin" value="2" ' . checked( 2, get_option( 'http_security_x_frame_options' ), false ) . '/>SAMEORIGIN</label></td></tr>';
		echo '<tr class="http_security_x_frame_options"><td></td><td><label for="http_security_x_frame_allow_from"><input name="http_security_x_frame_options" type="radio" id="http_security_x_frame_allow_from" value="3"  ' . checked( 3, get_option( 'http_security_x_frame_options' ), false ) . '/>ALLOW-FROM</label></td></tr>';
		echo '<tr class="http_security_x_frame_options"><td></td><td><label for="http_security_x_frame_origin">Allow from: <input name="http_security_x_frame_origin" type="text" id="http_security_x_frame_origin" value="'. get_option( 'http_security_x_frame_origin' ) .'" size="80" /></label></td></tr>';
		echo '</table></blockquote>';
		echo '<h3>'. __( 'Referrer policy', 'http-security' ).'</h3>';
		echo '<label for="http_security_referrer_policy">'. __( 'Referrer policy', 'http-security' ).': <select name="http_security_referrer_policy"><option value="" ' . selected( '', get_option( 'http_security_referrer_policy' ), false ) . '></option><option value="no-referrer" ' . selected( 'no-referrer', get_option( 'http_security_referrer_policy' ), false ) . '>no-referrer</option><option value="no-referrer-when-downgrade" ' . selected( 'no-referrer-when-downgrade', get_option( 'http_security_referrer_policy' ), false ) . '>no-referrer-when-downgrade</option><option value="same-origin" ' . selected( 'same-origin', get_option( 'http_security_referrer_policy' ), false ) . '>same-origin</option><option value="origin" ' . selected( 'origin', get_option( 'http_security_referrer_policy' ), false ) . '>origin</option><option value="strict-origin" ' . selected( 'strict-origin', get_option( 'http_security_referrer_policy' ), false ) . '>strict-origin</option><option value="origin-when-cross-origin" ' . selected( 'origin-when-cross-origin', get_option( 'http_security_referrer_policy' ), false ) . '>origin-when-cross-origin</option><option value="strict-origin-when-cross-origin" ' . selected( 'strict-origin-when-cross-origin', get_option( 'http_security_referrer_policy' ), false ) . '>strict-origin-when-cross-origin</option><option value="unsafe-url" ' . selected( 'unsafe-url', get_option( 'http_security_referrer_policy' ), false ) . '>unsafe-url</option></select></label><br />';
		
		echo '<h3>'. __( 'Other options', 'http-security' ).'</h3>';
		echo '<label for="http_security_x_xss_protection"><input name="http_security_x_xss_protection" type="checkbox" id="http_security_x_xss_protection" value="1" ' . checked( 1, get_option( 'http_security_x_xss_protection' ), false ) . ' />'. __( 'Force XSS protection', 'http-security' ).'</label><br />';

		echo '<label for="http_security_x_content_type_options"><input name="http_security_x_content_type_options" type="checkbox" id="http_security_x_content_type_options" value="1" ' . checked( 1, get_option( 'http_security_x_content_type_options' ), false ) . ' />'. __( 'Disable content sniffing', 'http-security' ).'</label><br />';

		echo '<label for="http_security_remove_php_version"><input name="http_security_remove_php_version" type="checkbox" id="http_security_remove_php_version" value="1" ' . checked( 1, get_option( 'http_security_remove_php_version' ), false ) . ' />'. __( 'Remove PHP version information from HTTP header', 'http-security' ).'</label><br />';

		echo '<label for="http_security_remove_wordpress_version"><input name="http_security_remove_wordpress_version" type="checkbox" id="http_security_remove_wordpress_version" value="1" ' . checked( 1, get_option( 'http_security_remove_wordpress_version' ), false ) . ' />'. __( 'Remove WordPress version information from header', 'http-security' ).'</label><br />';
	}
	if($active_tab == 'csp-options') {
		echo '<h2 class="nav-tab-wrapper"><a href="?page=http-security&tab=general-options" class="nav-tab">'. __('General options', 'http-security' ).'</a> <a href="?page=http-security&tab=csp-options" class="nav-tab nav-tab-active">'. __('CSP options', 'http-security' ).'</a> <a href="?page=http-security&tab=htaccess" class="nav-tab">'. __('.htaccess (beta)', 'http-security' ).'</a></h2>';
		echo '<p>'. __( 'For a complete description of these parameters, please refer to: <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy" rel="noopener">Content-Security-Policy</a> on the Mozilla Developer Network.', 'http-security' ).'</p>';
		echo '<form method="post" action="options.php">';
		settings_fields( 'http-security-csp' );

		echo '<style>.http_security_csp_options {} .http_security_x_frame_options {}</style>';
		echo '<label for="http_security_csp_flag"><input name="http_security_csp_flag" type="checkbox" id="http_security_csp_flag" value="1" ' . checked( 1, get_option( 'http_security_csp_flag' ), false ) . ' />'. __( 'Enable Content Security Policy', 'http-security' ).'</label> <label for="http_security_csp_reportonly_flag"><input name="http_security_csp_reportonly_flag" type="checkbox" id="http_security_csp_reportonly_flag" value="1" ' . checked( 1, get_option( 'http_security_csp_reportonly_flag' ), false ) . ' />'. __( 'Report only', 'http-security' ).'</label><br />';
		echo '<blockquote><table>';
		echo '<tr class="http_security_csp_options"><td colspan="2"><h3>'. __( 'Fetch directives', 'http-security' ).'</h3></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_child">child-src</td><td><input name="http_security_csp_child" type="text" id="http_security_csp_child" value="'. get_option( 'http_security_csp_child' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_connect">connect-src</td><td><input name="http_security_csp_connect" type="text" id="http_security_csp_connect" value="'. get_option( 'http_security_csp_connect' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_default">default-src</td><td><input name="http_security_csp_default" type="text" id="http_security_csp_default" value="'. get_option( 'http_security_csp_default' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_font">font-src</td><td><input name="http_security_csp_font" type="text" id="http_security_csp_font" value="'. get_option( 'http_security_csp_font' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_frame">frame-src</td><td><input name="http_security_csp_frame" type="text" id="http_security_csp_frame" value="'. get_option( 'http_security_csp_frame' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_img">img-src</td><td><input name="http_security_csp_img" type="text" id="http_security_csp_img" value="'. get_option( 'http_security_csp_img' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_manifest">manifest-src</td><td><input name="http_security_csp_manifest" type="text" id="http_security_csp_manifest" value="'. get_option( 'http_security_csp_manifest' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_media">media-src</td><td><input name="http_security_csp_media" type="text" id="http_security_csp_media" value="'. get_option( 'http_security_csp_media' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_object">object-src</td><td><input name="http_security_csp_object" type="text" id="http_security_csp_object" value="'. get_option( 'http_security_csp_object' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_script">script-src</td><td><input name="http_security_csp_script" type="text" id="http_security_csp_script" value="'. get_option( 'http_security_csp_script' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_style">style-src</td><td><input name="http_security_csp_style" type="text" id="http_security_csp_style" value="'. get_option( 'http_security_csp_style' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_worker">worker-src</td><td><input name="http_security_csp_worker" type="text" id="http_security_csp_worker" value="'. get_option( 'http_security_csp_worker' ) .'" size="80" /></label></td></tr>';

		echo '<tr class="http_security_csp_options"><td colspan="2"><h3>'. __( 'Document directives', 'http-security' ).'</h3></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_base_uri">base-uri</td><td><input name="http_security_csp_base_uri" type="text" id="http_security_csp_base_uri" value="'. get_option( 'http_security_csp_base_uri' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_plugin_types">plugin-types</td><td><input name="http_security_csp_plugin_types" type="text" id="http_security_csp_plugin_types" value="'. get_option( 'http_security_csp_plugin_types' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_sandbox">sandbox</td><td><input name="http_security_csp_sandbox" type="text" id="http_security_csp_sandbox" value="'. get_option( 'http_security_csp_sandbox' ) .'" size="80" /></label></td></tr>';

		echo '<tr class="http_security_csp_options"><td colspan="2"><h3>'. __( 'Navigation directives', 'http-security' ).'</h3></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_form_action">form-action</td><td><input name="http_security_csp_form_action" type="text" id="http_security_csp_form_action" value="'. get_option( 'http_security_csp_form_action' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_frame_ancestors">frame-ancestors</td><td><input name="http_security_csp_frame_ancestors" type="text" id="http_security_csp_frame_ancestors" value="'. get_option( 'http_security_csp_frame_ancestors' ) .'" size="80" /></label></td></tr>';

		echo '<tr class="http_security_csp_options"><td colspan="2"><h3>'. __( 'Other directives', 'http-security' ).'</h3></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_block_all_mixed_content">block-all-mixed-content</td><td><input name="http_security_csp_block_all_mixed_content" type="checkbox" id="http_security_csp_block_all_mixed_content" value="1" ' . checked( 1, get_option( 'http_security_csp_block_all_mixed_content' ), false ) . ' /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_require_sri_for">require-sri-for</td><td><input name="http_security_csp_require_sri_for" type="text" id="http_security_csp_require_sri_for" value="'. get_option( 'http_security_csp_require_sri_for' ) .'" size="80" /></label></td></tr>';
		echo '<tr class="http_security_csp_options"><td><label for="http_security_csp_upgrade_insecure_requests">upgrade-insecure-requests</td><td><input name="http_security_csp_upgrade_insecure_requests" type="checkbox" id="http_security_csp_upgrade_insecure_requests" value="1" ' . checked( 1, get_option( 'http_security_csp_upgrade_insecure_requests' ), false ) . ' /></label></td></tr>';
		echo '</table></blockquote>';
	}
	if($active_tab == 'htaccess') {
		echo '<h2 class="nav-tab-wrapper"><a href="?page=http-security&tab=general-options" class="nav-tab">'. __('General options', 'http-security' ).'</a> <a href="?page=http-security&tab=csp-options" class="nav-tab">'. __('CSP options', 'http-security' ).'</a> <a href="?page=http-security&tab=htaccess" class="nav-tab nav-tab-active">'. __('.htaccess (beta)', 'http-security' ).'</a></h2>';
		echo '<p>'. __( 'Some cache plug-ins rewrite the HTTP headers. In this case, you may need to have to insert the following content in your .htaccess file. If so, please disable the rewriting of the HTTP headers.', 'http-security' ).'</p>';
		echo '<p>'. __( 'Make sure to save the settings for the latest version.', 'http-security' ).'</p>';
		echo '<form method="post" action="options.php">';
		settings_fields( 'http-security-htaccess' );
		echo '<label for="http_security_htaccess_flag"><input name="http_security_htaccess_flag" type="checkbox" id="http_security_htaccess_flag" value="1" ' . checked( 1, get_option( 'http_security_htaccess_flag' ), false ) . ' />'. __( 'Disable header rewriting', 'http-security' ).'</label><br />';
		echo '<blockquote><textarea name="htaccess" rows="15" cols="80"># HTTP security settings start'."\n\n";
		if (get_option( 'http_security_sts_flag' )) {
			$header_string = 'Header set Strict-Transport-Security:';
			if ( get_option( 'http_security_sts_max_age' ) )
				$header_string .= ' max-age='. get_option( 'http_security_sts_max_age' ).';';
			if ( get_option( 'http_security_sts_subdomains_flag' ) )
				$header_string .= ' includeSubDomains;';
			if ( get_option( 'http_security_sts_preload_flag' ) )
				$header_string .= ' preload';
			echo($header_string."\n");
		}
		if ( get_option( 'http_security_expect_ct_flag' ) ) {
			$header_string = 'Header set Expect-CT:';
			if ( get_option( 'http_security_expect_ct_enforce_flag' ) )
				$header_string .= ' enforce;';
			$header_string .= ' max-age='. get_option( 'http_security_expect_ct_max_age' ).';';
			if ( get_option( 'http_security_expect_ct_report_uri' ) )
				$header_string .= 'report-uri="'. get_option( 'http_security_expect_ct_report_uri' ).'";';
			echo($header_string."\n");
		}
		if ( get_option( 'http_security_csp_flag' ) ) {
			$header_string = 'Header set Content-Security-Policy "';
			if ( get_option( 'http_security_csp_reportonly_flag' ) )
				$header_string .= '-Report-Only';
//			$header_string .= ':';
			if ( get_option( 'http_security_csp_child' ) )
				$header_string .= ' child-src '. get_option( 'http_security_csp_child' ).';';
			if ( get_option( 'http_security_csp_connect' ) )
				$header_string .= ' connect-src '. get_option( 'http_security_csp_connect' ).';';
			if ( get_option( 'http_security_csp_default' ) )
				$header_string .= ' default-src '. get_option( 'http_security_csp_default' ).';';
			if ( get_option( 'http_security_csp_font' ) )
				$header_string .= ' font-src '. get_option( 'http_security_csp_font' ).';';
			if ( get_option( 'http_security_csp_frame' ) )
				$header_string .= ' frame-src '. get_option( 'http_security_csp_frame' ).';';
			if ( get_option( 'http_security_csp_img' ) )
				$header_string .= ' img-src '. get_option( 'http_security_csp_img' ).';';
			if ( get_option( 'http_security_csp_manifest' ) )
				$header_string .= ' manifest-src '. get_option( 'http_security_csp_manifest' ).';';
			if ( get_option( 'http_security_csp_media' ) )
				$header_string .= ' media-src '. get_option( 'http_security_csp_media' ).';';
			if ( get_option( 'http_security_csp_object' ) )
				$header_string .= ' object-src '. get_option( 'http_security_csp_object' ).';';
			if ( get_option( 'http_security_csp_script' ) )
				$header_string .= ' script-src '. get_option( 'http_security_csp_script' ).';';
			if ( get_option( 'http_security_csp_style' ) )
				$header_string .= ' style-src '. get_option( 'http_security_csp_style' ).';';
			if ( get_option( 'http_security_csp_worker' ) )
				$header_string .= ' worker-src '. get_option( 'http_security_csp_worker' ).';';
			if ( get_option( 'http_security_csp_base_uri' ) )
				$header_string .= ' base-uri '. get_option( 'http_security_base_uri' ).';';
			if ( get_option( 'http_security_csp_plugin_types' ) )
				$header_string .= ' plugin-types '. get_option( 'http_security_plugin_types' ).';';
			if ( get_option( 'http_security_csp_sandbox' ) )
				$header_string .= ' sandbox '. get_option( 'http_security_csp_sandbox' ).';';
			if ( get_option( 'http_security_csp_form_action' ) )
				$header_string .= ' form-action '. get_option( 'http_security_csp_form_action' ).';';
			if ( get_option( 'http_security_csp_frame_ancestors' ) )
				$header_string .= ' frame-ancestors '. get_option( 'http_security_csp_frame_ancestors' ).';';
			if ( get_option( 'http_security_csp_block_all_mixed_content' ) )
				$header_string .= ' block-all-mixed-content;';
			if ( get_option( 'http_security_csp_require_sri_for' ) )
				$header_string .= ' require-sri-for '. get_option( 'http_security_csp_require_sri_for' ).';';
			if ( get_option( 'http_security_csp_upgrade_insecure_requests' ) )
				$header_string .= ' upgrade-insecure-requests;';
			if ( get_option( 'http_security_csp_reportonly_flag' ) )
				$header_string .= ' report-uri /_/csp-reports';
			echo($header_string.'"'."\n");
		}
		if ( get_option( 'http_security_x_frame_flag' ) ) {
			switch ( get_option( 'http_security_x_frame_options' ) ) {
			case 1:
				echo( 'Header set X-Frame-Options: DENY'  ."\n");
				break;
			case 2:
				echo( 'Header set X-Frame-Options: SAMEORIGIN'  ."\n");
				break;
			case 3:
				$path = get_option( 'http_security_x_frame_origin' );
				echo( 'Header set X-Frame-Options: ALLOW-FROM ' . $path  ."\n");
				break;
			}
		}
		if ( get_option( 'http_security_referrer_policy' ) )
			echo( 'Header set Referrer-Policy: '. get_option( 'http_security_referrer_policy' ) ."\n");
		if ( get_option( 'http_security_x_xss_protection' ) )
			echo( 'Header set X-XSS-Protection: "1; mode=block"' ."\n");
		if ( get_option( 'http_security_x_content_type_options' ) )
			echo( 'Header set X-Content-Type-Options: nosniff' ."\n");
		echo "\n".'# HTTP security settings end</textarea></blockquote>';
	}
	submit_button();
	echo '</form>';
	if ( username_exists( 'admin' ) ) {
		echo '<p class="http-security-warning"><span class="dashicons dashicons-warning"></span> '. __('You still have an administrator account with the user name <strong>admin</strong>. This is a major security flaw, you should consider renaming this account.', 'http-security') .'</p>';
	}
	echo '</div>';
	?>
	<script>
	jQuery(function() {
		jQuery("#http_security_sts_flag").change(function() {
			if( jQuery('input[name=http_security_sts_flag]').is(':checked') ){
				jQuery("#http_security_sts_options").show();
			} else {
				jQuery("#http_security_sts_options").hide();
			}
		})

		jQuery("#http_security_expect_ct_flag").change(function() {
			if( jQuery('input[name=http_security_expect_ct_flag]').is(':checked') ){
				jQuery("#http_security_expect_ct_options").show();
			} else {
				jQuery("#http_security_expect_ct_options").hide();
			}
		})

		jQuery("#http_security_csp_flag").change(function() {
			if( jQuery('input[name=http_security_csp_flag]').is(':checked') ){
				jQuery(".http_security_csp_options").show();
			} else {
				jQuery(".http_security_csp_options").hide();
			}
		})

		jQuery("#http_security_x_frame_flag").change(function() {
			if( jQuery('input[name=http_security_x_frame_flag]').is(':checked') ){
				jQuery(".http_security_x_frame_options").show();
			} else {
				jQuery(".http_security_x_frame_options").hide();
			}
		})
	});
	</script>
	<?php

}

function register_http_security_settings() {
	register_setting( 'http-security', 'http_security_remove_php_version' );
	register_setting( 'http-security', 'http_security_remove_wordpress_version' );
	register_setting( 'http-security', 'http_security_sts_flag' );
	register_setting( 'http-security', 'http_security_sts_subdomains_flag' );
	register_setting( 'http-security', 'http_security_sts_preload_flag' );
	register_setting( 'http-security', 'http_security_sts_max_age' );
	register_setting( 'http-security', 'http_security_expect_ct_flag' );
	register_setting( 'http-security', 'http_security_expect_ct_max_age' );
	register_setting( 'http-security', 'http_security_expect_ct_enforce_flag' );
	register_setting( 'http-security', 'http_security_expect_ct_report_uri' );
// 	register_setting( 'http-security', 'http_security_pkp_flag' );
// 	register_setting( 'http-security', 'http_security_pkp_keys' );
// 	register_setting( 'http-security', 'http_security_pkp_subdomains_flag' );
// 	register_setting( 'http-security', 'http_security_pkp_reportonly_flag' );
	register_setting( 'http-security', 'http_security_referrer_policy' );
	register_setting( 'http-security', 'http_security_x_frame_flag' );
	register_setting( 'http-security', 'http_security_x_frame_options' );
	register_setting( 'http-security', 'http_security_x_frame_origin' );
	register_setting( 'http-security', 'http_security_x_xss_protection' );
	register_setting( 'http-security', 'http_security_x_content_type_options' );
	register_setting( 'http-security-csp', 'http_security_csp_flag' );
	register_setting( 'http-security-csp', 'http_security_csp_reportonly_flag' );
	register_setting( 'http-security-csp', 'http_security_csp_child' );
	register_setting( 'http-security-csp', 'http_security_csp_connect' );
	register_setting( 'http-security-csp', 'http_security_csp_default' );
	register_setting( 'http-security-csp', 'http_security_csp_font' );
	register_setting( 'http-security-csp', 'http_security_csp_frame' );
	register_setting( 'http-security-csp', 'http_security_csp_img' );
	register_setting( 'http-security-csp', 'http_security_csp_manifest' );
	register_setting( 'http-security-csp', 'http_security_csp_media' );
	register_setting( 'http-security-csp', 'http_security_csp_object' );
	register_setting( 'http-security-csp', 'http_security_csp_script' );
	register_setting( 'http-security-csp', 'http_security_csp_style' );
	register_setting( 'http-security-csp', 'http_security_csp_worker' );
	register_setting( 'http-security-csp', 'http_security_csp_base_uri' );
	register_setting( 'http-security-csp', 'http_security_csp_plugin_types' );
	register_setting( 'http-security-csp', 'http_security_csp_sandbox' );
	register_setting( 'http-security-csp', 'http_security_csp_form_action' );
	register_setting( 'http-security-csp', 'http_security_csp_frame_ancestors' );
	register_setting( 'http-security-csp', 'http_security_csp_block_all_mixed_content' );
	register_setting( 'http-security-csp', 'http_security_csp_require_sri_for' );
	register_setting( 'http-security-csp', 'http_security_csp_upgrade_insecure_requests' );
	register_setting( 'http-security-htaccess', 'http_security_htaccess_flag' );
}

function http_security_copy_main_site_options( $blog_id, $user_id, $domain, $path, $site_id, $meta )
{
    $mainsite = get_option( 'pagenavi_options' );
    switch_to_blog( $blog_id );
    update_option( 'pagenavi_options', $mainsite );
    restore_current_blog();
}