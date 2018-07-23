<?php
/* Welcome to Bones :)

Developed by: Efrén Dgz

	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions

*/

/*********************
Activate or Disable
Custom Functions
*********************/

// Disable the Admin Bar
add_filter( 'show_admin_bar', '__return_false' );




// Get page ID from slug
function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}



function my_acf_admin_enqueue_scripts() {
	
	wp_deregister_style( 'acf-input' );
	wp_register_style( 'aio-acf-input', get_stylesheet_directory_uri() . '/library/css/acf-input.css', false, '1.0.0' );
	wp_enqueue_style( 'aio-acf-input' );
	
}
if(!is_admin()) {
	add_action( 'acf/input/admin_enqueue_scripts', 'my_acf_admin_enqueue_scripts' );
}



function hide_personal_options() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#your-profile .form-table:first, #your-profile h3:first").remove();
		});
	</script>
	<?php
}
if(!is_admin()) {
	add_action('admin_head','hide_personal_options');
}







/*********************
Custom Functions
*********************/

// Redirect URL Login
function admin_default_page() {
	return home_url('/ofi');
}






// Auto-Redirect when WordPress Search Query Only Returns One Match
//add_action('template_redirect', 'one_match_redirect');
function one_match_redirect() {
	if (is_search()) {
		global $wp_query;
		if ($wp_query->post_count == 1) {
			wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
		}
	}
}

// Collapse Admin Menu by default
function custom_admin_js() {
	echo "
	<script type='text/javascript' >
		document.body.className+=' folded';
	</script>";
}
//add_action('admin_footer', 'custom_admin_js');


// Disable Emoji Support for Comments
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


// Contact Form 7
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );


// Custom Admin CSS
function load_custom_wp_admin_style() {
		wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/library/css/admin.css', false, '1.0.0' );
		wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );



function wpa82795_archives_orderby( $query ) {
	if ( $query->is_archive('especialistas') && $query->is_main_query() ) {
		$query->set( 'orderby', 'rand' );
	}
}



// Allow SVG Upload
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');





function templateUrl() {
	$templateUrl = get_template_directory_uri();
	return $templateUrl;
}
function libraryUrl() {
	$libraryUrl = get_template_directory_uri().'/library';
	return $libraryUrl;
}





function terms_taxonomy($taxy) {
	global $post;
	$terms = get_the_terms( $post->ID, $taxy );
	if ( $terms && ! is_wp_error( $terms ) ) :
		$objects = array();
		foreach ( $terms as $term ) {
			$objects[] = '<a href="'.get_term_link($term).'">'.$term->name.'</a>';
		}
		$list = join( ", ", $objects );

		echo $list;
	endif;
}




function wpfstop_change_default_title( $title ) {
	$screen = get_current_screen();
	if ( 'especialistas' == $screen->post_type ) {
		$title = 'Nombre Completo del Dr.';
	} elseif ( 'consejo' == $screen->post_type ) {
		$title = 'Cargo o Función en la Mesa';
	}
	return $title;
}
//add_filter( 'enter_title_here', 'wpfstop_change_default_title' );




function list_child_pages() { 
	global $post; 

	if ( is_page() && $post->post_parent ) {
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of='.$post->post_parent.'&echo=0' );
		$ancestor = wp_list_pages( 'title_li=&include='.$post->post_parent.'&echo=0' );
	} else {		
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of='.$post->ID.'&echo=0' );
		$ancestor = wp_list_pages( 'title_li=&include='.$post->ID.'&echo=0' );
	}

	if ( $childpages ) {
		$string = '<ul class="child-pages table-of-contents cf">';
		$string .= $ancestor;
		$string .= $childpages;
		$string .= '</ul>';
	}

	return $string;
}



function social_links() {
	global $post;
	$facebook 	= get_field('facebook_lugar', $post->ID);
	$twitter 	= get_field('twitter_lugar', $post->ID);
	$google 	= get_field('googleplus_lugar', $post->ID);
	$instagram 	= get_field('instagram_lugar', $post->ID);
	$sitio_web 	= get_field('sitio_web_lugar', $post->ID);
	$email		= get_field('correo_electronico_lugar', $post->ID);
	$socialinks = $facebook.$twitter.$google.$instagram.$sitio_web.$email;

	if($socialinks) {
		echo '<ul class="social-links cf">';

			if($facebook) { echo '<li><a href="'.$facebook.'" class="tooltip" title="Facebook" target="_blank"><i class="icon-fb"></i></a></li>'; }
			if($twitter) { echo '<li><a href="'.$twitter.'" class="tooltip" title="Twitter" target="_blank"><i class="icon-twitter-lines"></i></a></li>'; }
			if($google) { echo '<li><a href="'.$google.'" class="tooltip" title="Google+" target="_blank"><i class="icon-google-lines"></i></a></li>'; }
			if($instagram) { echo '<li><a href="'.$instagram.'" class="tooltip" title="Instagram" target="_blank"><i class="icon-instagram-lines"></i></a></li>'; }
			if($sitio_web) { echo '<li><a href="'.$sitio_web.'" class="tooltip" title="Sitio Web" target="_blank"><i class="icon-website"></i></a></li>'; }
			if($email) { echo '<li><a href="mailto:'.$email.'" class="tooltip" title="Email" target="_blank"><i class="icon-email"></i></a></li>'; }

		echo '</ul>';
	}
}









function get_terms_dropdown($taxonomies, $args){

	$qobject = get_queried_object();
	$current = $qobject->slug;

	$myterms = get_terms($taxonomies, $args);
	$output = '<select name="especialidad">';
	$output .= '<option value="">Filtrar por Especialidad</option>';
	foreach($myterms as $term){
		$root_url = get_bloginfo('url');
		$term_taxonomy = $term->taxonomy;
		$term_slug = $term->slug;
		$term_name = $term->name;
		$link = $term_slug;
		$selected = ($term_slug == $current ? 'selected' : '');
		$output .= '<option value="'.$link.'" '.$selected.'>'.$term_name.'</option>';
	}
	$output .="</select>";
	return $output;
}






// https://stackoverflow.com/questions/5598480/php-parse-current-url
function curPageURL() {
	$pageURL = $_SERVER["HTTP_REFERER"];
	return $pageURL;
}







/**
 * Create a nav menu with very basic markup.
 * Based on Thomas Scholz http://toscho.de, T5_Nav_Menu_Walker_Simple
 *
 * @author César Hernández [cesarhdz.com]
 * @version 1.0
 */
class Mi_menu_walker extends Walker_Nav_Menu {
  /**
   * Start the element output.
   *
   * @param  string $output Passed by reference. Used to append additional content.
   * @param  object $item   Menu item data object.
   * @param  int $depth     Depth of menu item. May be used for padding.
   * @param  array $args    Additional strings.
   * @return void
   */
	public function start_el( &$output, $item, $depth, $args ) {

		$classes = empty( $item->classes ) ? array() : (array) $item->classes[0];
		$classes[] = sanitize_html_class(sanitize_title($item->title));
		$classes[] = ($item->current OR $item->current_item_ancestor OR $item->current_item_parent)
		? 'active' : '';

		$output     .= '<li class="' . trim(implode(' ', $classes)). '">';
		$attributes  = '';
		$description = ($item->description != '') ? "<p class=\"description\"><small>{$item->description}</small></p>" : '';

		$megamenu = ($item->description != '') ? "<div class=\"megamenu\">{$item->description}</div>" : '';

		! empty ( $item->attr_title )

		and $item->attr_title !== $item->title
		and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';

		! empty ( $item->url )
		and $attributes .= ' href="' . esc_attr( $item->url ) .'"';

		$attributes  = trim( $attributes );
		$title       = apply_filters( 'the_title', $item->title, $item->ID );
		$item_output = "{$args->before}<a {$attributes}>{$args->link_before}<span class='title'>{$title}</span></a>{$description}" . "$args->link_after$args->after";

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

  /**
   * @see Walker::start_lvl()
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @return void
   */
  public function start_lvl( &$output ) {
	$output .= '<ul class="dropdown">';
  }

  /**
   * @see Walker::end_lvl()
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @return void
   */
  public function end_lvl( &$output )
  {
	$output .= '</ul>';
  }

  /**
   * @see Walker::end_el()
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @return void
   */
  function end_el( &$output )
  {
	$output .= '</li>';
  }
} // Mi_Menu_Walker




//add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {
	if ($args->theme_location == 'app-nav') {
        ob_start();
        wp_loginout();
        $loginoutlink = ob_get_contents();
        ob_end_clean();

        $items .= '<li>'. $loginoutlink .'</li>';
    }
    return $items;
}



add_filter( 'wp_nav_menu_items', 'add_items_menu', 10, 2 );
function add_items_menu( $items, $args ) {
	if ($args->theme_location == 'app-nav') {
		if(is_user_logged_in()) {
			$user = wp_get_current_user();
			$logouturl = wp_nonce_url( site_url('/wp-login.php?action=logout&redirect_to='.get_home_url()) );
			$output = '<a class="dropdown-button" href="#" data-activates="dropdown1"><span class="ti-user"></span> <span class="hide-on-small-only">'.$user->user_login.'</span></a>';
			$output .= '<ul id="dropdown1" class="dropdown-content">';
			$allowed_roles = array('administrator', 'admin');
			if( array_intersect($allowed_roles, $user->roles ) ) { 
				$output .= '<li><a href="'.admin_url().'">Admin</a></li>';
			}
			$output .= '<li><a href="'.$logouturl.'">Salir</a></li>';
			$output .= '</ul>';
			$items .= '<li>'.$output.'</li>';
		} else {
			$output = '<a class="dropdown-button" href="'.wp_login_url(get_permalink()).'" data-activates="dropdown1"><span class="ti-user"></span> Iniciar Sesión</a>';
			$items .= '<li>'.$output.'</li>';
		}	
	} 
	return $items;
}






function aio_change_post_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Blog';
	$submenu['edit.php'][5][0] = 'Artículos';
	$submenu['edit.php'][10][0] = 'Añadir Artículo';
	echo '';
}

function aio_change_post_object() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Artículos';
	$labels->singular_name = 'Artículo';
	$labels->add_new = 'Añadir Artículo';
	$labels->add_new_item = 'Añadir Artículo';
	$labels->edit_item = 'Editar Artículo';
	$labels->new_item = 'Artículo';
	$labels->view_item = 'Ver Artículo';
	$labels->search_items = 'Buscar Artículo';
	$labels->not_found = 'No se encontráron Artículos';
	$labels->not_found_in_trash = 'No se encontráron Artículos en la papelera';
	$labels->all_items = 'Todos los Artículos';
	$labels->menu_name = 'Artículos';
	$labels->name_admin_bar = 'Artículos';
}

add_action( 'admin_menu', 'aio_change_post_label' );
add_action( 'init', 'aio_change_post_object' );










// Capture user login and add it as timestamp in user meta data
function user_last_login( $user_login, $user ) {
    update_user_meta( $user->ID, '_last_login', time() );
}
add_action( 'wp_login', 'user_last_login', 10, 2 );

function wpb_lastlogin() {
	$user = wp_get_current_user(); $user_id = $user->ID;
	$last_login = get_user_meta($user_id, '_last_login', true);
	$the_login_date = human_time_diff($last_login);
	return $the_login_date; 
} 

// Add Shortcode [lastlogin]
add_shortcode('lastlogin','wpb_lastlogin');








function getAddress() {
	$protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
	return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}







add_action('acf/save_post', 'save_post_alumnos');
function save_post_alumnos( $post_id ) {
	
	if( get_post_type($post_id) !== 'alumnos' ) {		
		return;		
	}    

	// unhook this function so it doesn't loop infinitely
	remove_action('acf/save_post', 'save_post_alumnos');

	// change title

	// vars	
	$post = get_post( $post_id );
	$nombres = get_field('OFI-1-ANombresDelAlumno', $post_id);
	$apellidos = get_field('OFI-1-AApellidosDelAlumno', $post_id);
	
	$alumno_title = $nombres.' '.$apellidos;
	$post_slug = sanitize_title_with_dashes ($alumno_title,'','save');
	$post_slugsan = sanitize_title($post_slug);

	// update the post, which calls save_post again
	wp_update_post(array(
		'ID' => $post_id, 
		'post_title' => $alumno_title,
		'post_name' => $post_slugsan
		)
	);

	add_action('acf/save_post', 'save_post_alumnos');
}





add_action('acf/save_post', 'save_post_aspirantes');
function save_post_aspirantes( $post_id ) {
	
	if( get_post_type($post_id) !== 'aspirantes' ) {
		return;		
	}    

	// unhook this function so it doesn't loop infinitely
	remove_action('acf/save_post', 'save_post_aspirantes');

	// change title

	// vars	
	$post = get_post( $post_id );
	$nombre_completo = get_field('ASP_nombre_completo', $post_id);
	
	$aspirante_title = $nombre_completo;
	$post_slug = sanitize_title_with_dashes($aspirante_title,'','save');
	$post_slugsan = sanitize_title($post_slug);

	// update the post, which calls save_post again
	wp_update_post(array(
		'ID' => $post_id, 
		'post_title' => $aspirante_title,
		'post_name' => $post_slugsan
		)
	);

	$tipo_de_aspirante = get_field('ASP_tipo_aspirante', $post_id);

	if(empty($tipo_de_aspirante)) {		
		if(is_page_template('page-ofc.php')) {
			$tipo_de_aspirante = 'instructor';
		} elseif(is_page_template('page-ofcs.php')) {
			$tipo_de_aspirante = 'certificador';
		} elseif(is_page_template('page-ofa.php')) {
			$tipo_de_aspirante = 'certificador_senior';
		}
	}

	update_field('ASP_tipo_aspirante', $tipo_de_aspirante, $post_id);

	add_action('acf/save_post', 'save_post_aspirantes');

	//vars
	$email = get_field('ASP_email', $post_id);



	if( null == email_exists( $email ) ) {

		// add state about first login password change
		add_post_meta( $post_id, 'pass_changed', 'not_changed');

		// $password = wp_generate_password( 12, false );
		$password = get_field('ASP_initial_pass', $post_id);
		// $password = 'jambon';
		$user_id = wp_create_user( $email, $password, $email );

		wp_update_user(
			array(
				'ID'          =>    $user_id,
				'nickname'    =>    $email
				)
			);

		$user = new WP_User( $user_id );
		$user->set_role( 'subscriber' );

		// wp_mail( $email, 'Welcome!', 'Your Password: ' . $password );

		// add user status
		/* 
		********************NNNNNNNNNNNNNNNNNNN 00000000000000000000000 NNNNNNNNNNNNNNNNN**************************/
		update_field('status', '00', 'user_'.$user_id);
		update_field('_status', '00', $post_id);

		
		// add status custom field for loop
		// update_post_meta( $post_id, '_status', '00' );
		// update_post_meta( $post_id, '__status', 'field_5a8bdc3f3e036' );




		// asign user id to meta field of the post
		add_post_meta( $post_id, '_userid', $user_id );
		update_user_meta( $user_id, 'status', '00' );

	}
}


// Update status on update user profile
add_action( 'profile_update', 'profile_update_example' );
function profile_update_example( $user_id ) {
	// send email when update profile
	$site_url = get_bloginfo( 'name' );
	$user_info = get_userdata( $user_id );
	$user_name = $user_info->display_name;
	$user_email = $user_info->user_email;
	$subject = "Profile updated";
	$message = "Hello $user_name,\n\nYour profile has been updated! Please contact us if you're not the one who changed your profile.\n\nThank you for visiting $site_name.";

	// update user status
	$newstatus = get_field('status', 'user_'.$user_id);

	$args = array(
		'post_type'		 => 	'aspirantes',
		'meta_query'	 => 	array(
			array(
				'key'         => '_userid',
				'value'	      => $user_id,
				'compare'     => '='
			)
		)
	);
	$cert = new WP_Query( $args );

	if( $cert->have_posts() ) {
		$cert->the_post();

		$certid = get_the_ID();
	}
	wp_reset_postdata();

	$_status = get_post_meta( $certid, '_status', true );

	if ( ! add_post_meta( $certid, '_status', $newstatus, true ) ) { 
		update_post_meta( $certid, '_status', $newstatus );
	}

}


// acf/update_value - filter for every field
add_filter('acf/update_value/name=_status', 'my_acf_update_value', 10, 3);
function my_acf_update_value( $value, $post_id, $field  ) {
	
	$userid = get_post_meta( $post_id, '_userid', true );

	update_field('status', $value, 'user_'.$userid);
	if ( ! add_post_meta( $post_id, '_status', $value, true ) ) { 
		update_post_meta( $post_id, '_status', $value );
	}

	$tipo_de_aspirante = str_replace('_', '-', get_field('ASP_tipo_aspirante', $post_id));

	switch ($value) {
		case '00': $role = 'subscriber'; break;
		case '05': $role = 'subscriber'; break;
		case '08': $role = $tipo_de_aspirante; break;
		case '10': $role = $tipo_de_aspirante; break;
		case '20': $role = 'subscriber'; break;
		case '30': $role = 'subscriber'; break;
		case '50': $role = 'subscriber'; break;
	}

	$usuario = new WP_User($userid);
	$usuario->set_role($role);

	// return
    return $value;
    
}










function aio_post_exists( $id ) {
	return is_string( get_post_status( $id ) );
}


add_filter('acf/validate_value/name=ASP_email', 'my_acf_validate_value', 10, 4);
function my_acf_validate_value( $valid, $value, $field, $input ){
	
	$post_id = $_POST['_acf_post_id'];

	// bail early if value is already invalid
	if( !$valid ) {
		return $valid;
	}

	$exists = email_exists($value);

	if ( !aio_post_exists($post_id) && $exists ) {
		$valid = "Este email ya está asignado al usuario No. ".$exists;
	}
	
	return $valid;
}







// numero intructor veo column
function manage_aspirantes_columns( $columns ) {
	return array_merge( $columns, 
        array( 
        	'no_i_veo' => __( 'VEO Instructor ID', 'bonestheme' ),
        	'_status' => __( 'Status', 'bonestheme' )
        	) 
    );
}
add_filter( 'manage_aspirantes_posts_columns', 'manage_aspirantes_columns' );

function manage_aspirantes_column_content( $column, $post_id ) {
	if ( $column == 'no_i_veo' ) {
		$statusvalue = get_field('numero_instructor_veo', $post_id);
		if ( $statusvalue ) {
			echo $statusvalue;
		}
	}
	if ( $column == '_status' ) {
		$statusvalue = get_post_meta($post_id, '_status', true);
		if ( $statusvalue ) {
			echo $statusvalue;
		}
	}
}
add_action( 'manage_aspirantes_posts_custom_column', 'manage_aspirantes_column_content', 10, 2 );

function manage_aspirantes_css() {
	echo '<style type="text/css">.column-no_i_veo { width: 80px; }</style>';
}
add_action( 'admin_footer-aspirantes.php', 'manage_aspirantes_css' );
















// user status column
function manage_users_columns( $defaults ) {
	$defaults['user_status'] = __( 'Status', 'bonestheme' );
	return $defaults;
}
add_filter( 'manage_users_columns', 'manage_users_columns' );

// Set content of disabled users column
function manage_users_column_content( $empty, $column_name, $user_ID ) {
	if ( $column_name == 'user_status' ) {
		$statusvalue = get_field('status', 'user_'.$user_ID);
		if ( $statusvalue ) {
			return $statusvalue;
		}
	}
}
add_action( 'manage_users_custom_column', 'manage_users_column_content', 10, 3 );

function manage_users_css() {
	echo '<style type="text/css">.column-user_status { width: 80px; }</style>';
}
add_action( 'admin_footer-users.php', 'manage_users_css' );


























// ACF Options Page
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Opciones Generales',
		'menu_title'	=> 'VXM',
		'menu_slug' 	=> 'site-customizer',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}


function flat_logo() {
	$logo = get_field( 'logotipo_menu', 'option' );
	$tagline = get_bloginfo( 'description' );
	$display_slogan = get_field( 'display_slogan' );

	echo '<h1 id="logo" class="site-title '.$header_class.'" itemscope itemtype="http://schema.org/Organization"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="nofollow">';
	if ( $header_class != 'display-title' ) {
		echo '<img alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" src="'.$logo.'" />';
	}
	echo '</a></h1>';
}


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
//add_action( 'wp_head', 'google_analytics' );


























/* 
Showing Users Posts Count by Custom Post Type in the Admin User List
https://wordpress.stackexchange.com/questions/3233/showing-users-post-counts-by-custom-post-type-in-the-admins-user-list
*/
add_action('manage_users_columns','yoursite_manage_users_columns');
function yoursite_manage_users_columns($column_headers) {
    unset($column_headers['posts']);
    $column_headers['custom_posts'] = 'Assets';
    return $column_headers;
}

add_action('manage_users_custom_column','yoursite_manage_users_custom_column',10,3);
function yoursite_manage_users_custom_column($custom_column,$column_name,$user_id) {
    if ($column_name=='custom_posts') {
        $counts = _yoursite_get_author_post_type_counts();
        $custom_column = array();
        if (isset($counts[$user_id]) && is_array($counts[$user_id]))
            foreach($counts[$user_id] as $count) {
                $link = admin_url() . "edit.php?post_type=" . $count['type']. "&author=".$user_id;
                // admin_url() . "edit.php?author=" . $user->ID;
                $custom_column[] = "\t<tr><th><a href={$link}>{$count['label']}</a></th><td>{$count['count']}</td></tr>";
            }
        $custom_column = implode("\n",$custom_column);
        if (empty($custom_column))
            $custom_column = "<th>&nbsp;</th>";
        $custom_column = "<table>\n{$custom_column}\n</table>";
    }
    return $custom_column;
}

function _yoursite_get_author_post_type_counts() {
    static $counts;
    if (!isset($counts)) {
        global $wpdb;
        global $wp_post_types;
        $sql = <<<SQL
        SELECT
        post_type,
        post_author,
        COUNT(*) AS post_count
        FROM
        {$wpdb->posts}
        WHERE 1=1
        AND post_type IN ('aspirantes', 'alumnos')
        AND post_status IN ('publish','pending', 'draft')
        GROUP BY
        post_type,
        post_author
SQL;
        $posts = $wpdb->get_results($sql);
        foreach($posts as $post) {
            $post_type_object = $wp_post_types[$post_type = $post->post_type];
            if (!empty($post_type_object->label))
                $label = $post_type_object->label;
            else if (!empty($post_type_object->labels->name))
                $label = $post_type_object->labels->name;
            else
                $label = ucfirst(str_replace(array('-','_'),' ',$post_type));
            if (!isset($counts[$post_author = $post->post_author]))
                $counts[$post_author] = array();
            $counts[$post_author][] = array(
                'label' => $label,
                'count' => $post->post_count,
                'type' => $post->post_type,
                );
        }
    }
    return $counts;
}






function cortarTexto($texto, $numMaxCaract){
	if (strlen($texto) <  $numMaxCaract){
		$textoCortado = $texto;
	}else{
		$textoCortado = substr($texto, 0, $numMaxCaract);
		$ultimoEspacio = strripos($textoCortado, " ");

		if ($ultimoEspacio !== false){
			$textoCortadoTmp = substr($textoCortado, 0, $ultimoEspacio);
			if (substr($textoCortado, $ultimoEspacio)){
				$textoCortadoTmp .= '...';
			}
			$textoCortado = $textoCortadoTmp;
		}elseif (substr($texto, $numMaxCaract)){
			$textoCortado .= '...';
		}
	}
	return $textoCortado;
}










function dequeue_buddypress() {
	if (is_front_page()) {
		wp_dequeue_style('bp-legacy-css');
		wp_deregister_script('bp-jquery-query');
		wp_deregister_script('bp-confirm');
	}
}
add_action('wp_enqueue_scripts', 'dequeue_buddypress');







// https://openwebinars.net/blog/acciones-en-lote-personalizadas-en-wordpress/
// https://gist.github.com/tristangemus/8ef8555d3350014a39ea44d0febd1b3d
/*
function wcs_register_bulk_grant_admin( $bulk_actions ) {
	$bulk_actions[ 'user_status' ] = __( 'Change User Status to Active', 'user_status');
	return $bulk_actions;
}
add_filter( 'bulk_actions-users', 'wcs_register_bulk_grant_admin' );

function wcs_bulk_grant_admin_callback( $redirect_to, $doaction, $user_ids ) {
	if ( $doaction !== 'user_status' ) {
		return $redirect_to;
	}
	$count = 0;
	foreach ( $user_ids as $user_id ) {
		$user = new WP_User( $user_id );

		update_field('status', '10', 'user_'.$user_id);
		$count++;

	}
	$redirect_to = add_query_arg( 'user_status', $count, $redirect_to );
	return $redirect_to;
}
add_filter( 'handle_bulk_actions-users', 'wcs_bulk_grant_admin_callback', 10, 3 );

function wcs_bulk_grant_admin_notice() {
	if ( isset( $_REQUEST[ 'user_status' ] ) ) {
		$count = intval( $_REQUEST[ 'user_status' ] );
		printf(
			'<div id="message" class="updated fade"><p>Successfully changed status to %s users</p></div>',
			$count
		);
	}
}
add_action( 'admin_notices', 'wcs_bulk_grant_admin_notice' );
*/






/* 
Bulk Edit Actions for Aspirantes Status ------------------------------------------------>
*/
// Status 00
function register_00_bulk_actions($bulk_actions) {
	$bulk_actions['user_status_00'] = __( 'Change User Status to 00', 'user_status');
	return $bulk_actions;
}
add_filter( 'bulk_actions-edit-aspirantes', 'register_00_bulk_actions' );

function status_00_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
	if ( $doaction !== 'user_status_00' ) {
		return $redirect_to;
	}

	foreach ( $post_ids as $post_id ) {
		update_post_meta( $post_id, '_status', '00' );

		$cfuserid = get_post_meta( $post_id, '_userid', true );
		update_field('status', '00', 'user_'.$cfuserid);

		$usuario = new WP_User($cfuserid);
		$usuario->set_role('subscriber');
	}

	return $redirect_to;
}
add_filter( 'handle_bulk_actions-edit-aspirantes', 'status_00_bulk_action_handler', 10, 3 );

// Status 05
function register_05_bulk_actions($bulk_actions) {
	$bulk_actions['user_status_05'] = __( 'Change User Status to 05', 'user_status');
	return $bulk_actions;
}
add_filter( 'bulk_actions-edit-aspirantes', 'register_05_bulk_actions' );

function status_05_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
	if ( $doaction !== 'user_status_05' ) {
		return $redirect_to;
	}

	foreach ( $post_ids as $post_id ) {
		update_post_meta( $post_id, '_status', '05' );

		$cfuserid = get_post_meta( $post_id, '_userid', true );
		update_field('status', '05', 'user_'.$cfuserid);

		$usuario = new WP_User($cfuserid);
		$usuario->set_role('subscriber');
	}

	return $redirect_to;
}
add_filter( 'handle_bulk_actions-edit-aspirantes', 'status_05_bulk_action_handler', 10, 3 );


// Status 08
function register_08_bulk_actions($bulk_actions) {
	$bulk_actions['user_status_08'] = __( 'Change User Status to 08', 'user_status');
	return $bulk_actions;
}
add_filter( 'bulk_actions-edit-aspirantes', 'register_08_bulk_actions' );

function status_08_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
	if ( $doaction !== 'user_status_08' ) {
		return $redirect_to;
	}

	foreach ( $post_ids as $post_id ) {
		update_post_meta( $post_id, '_status', '08' );

		$cfuserid = get_post_meta( $post_id, '_userid', true );
		update_field('status', '08', 'user_'.$cfuserid);

		$tipo_de_aspirante = str_replace('_', '-', get_field('ASP_tipo_aspirante', $post_id));

		$usuario = new WP_User($cfuserid);
		$usuario->set_role($tipo_de_aspirante);
	}

	return $redirect_to;
}
add_filter( 'handle_bulk_actions-edit-aspirantes', 'status_08_bulk_action_handler', 10, 3 );


// Status 10
function register_10_bulk_actions($bulk_actions) {
	$bulk_actions['user_status_10'] = __( 'Change User Status to 10', 'user_status');
	return $bulk_actions;
}
add_filter( 'bulk_actions-edit-aspirantes', 'register_10_bulk_actions' );

function status_10_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
	if ( $doaction !== 'user_status_10' ) {
		return $redirect_to;
	}

	foreach ( $post_ids as $post_id ) {
		update_post_meta( $post_id, '_status', '10' );

		$cfuserid = get_post_meta( $post_id, '_userid', true );
		update_field('status', '10', 'user_'.$cfuserid);

		$tipo_de_aspirante = str_replace('_', '-', get_field('ASP_tipo_aspirante', $post_id));

		$usuario = new WP_User($cfuserid);
		$usuario->set_role($tipo_de_aspirante);
	}

	return $redirect_to;
}
add_filter( 'handle_bulk_actions-edit-aspirantes', 'status_10_bulk_action_handler', 10, 3 );


// Status 20
function register_20_bulk_actions($bulk_actions) {
	$bulk_actions['user_status_20'] = __( 'Change User Status to 20', 'user_status');
	return $bulk_actions;
}
add_filter( 'bulk_actions-edit-aspirantes', 'register_20_bulk_actions' );

function status_20_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
	if ( $doaction !== 'user_status_20' ) {
		return $redirect_to;
	}

	foreach ( $post_ids as $post_id ) {
		update_post_meta( $post_id, '_status', '20' );

		$cfuserid = get_post_meta( $post_id, '_userid', true );
		update_field('status', '20', 'user_'.$cfuserid);

		$usuario = new WP_User($cfuserid);
		$usuario->set_role('subscriber');
	}

	return $redirect_to;
}
add_filter( 'handle_bulk_actions-edit-aspirantes', 'status_20_bulk_action_handler', 10, 3 );


// Status 30
function register_30_bulk_actions($bulk_actions) {
	$bulk_actions['user_status_30'] = __( 'Change User Status to 30', 'user_status');
	return $bulk_actions;
}
add_filter( 'bulk_actions-edit-aspirantes', 'register_30_bulk_actions' );

function status_30_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
	if ( $doaction !== 'user_status_30' ) {
		return $redirect_to;
	}

	foreach ( $post_ids as $post_id ) {
		update_post_meta( $post_id, '_status', '30' );

		$cfuserid = get_post_meta( $post_id, '_userid', true );
		update_field('status', '30', 'user_'.$cfuserid);

		$usuario = new WP_User($cfuserid);
		$usuario->set_role('subscriber');
	}

	return $redirect_to;
}
add_filter( 'handle_bulk_actions-edit-aspirantes', 'status_30_bulk_action_handler', 10, 3 );


// Status 50
function register_50_bulk_actions($bulk_actions) {
	$bulk_actions['user_status_50'] = __( 'Change User Status to 50', 'user_status');
	return $bulk_actions;
}
add_filter( 'bulk_actions-edit-aspirantes', 'register_50_bulk_actions' );

function status_50_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
	if ( $doaction !== 'user_status_50' ) {
		return $redirect_to;
	}

	foreach ( $post_ids as $post_id ) {
		update_post_meta( $post_id, '_status', '50' );

		$cfuserid = get_post_meta( $post_id, '_userid', true );
		update_field('status', '50', 'user_'.$cfuserid);

		$usuario = new WP_User($cfuserid);
		$usuario->set_role('subscriber');
	}

	return $redirect_to;
}
add_filter( 'handle_bulk_actions-edit-aspirantes', 'status_50_bulk_action_handler', 10, 3 );







function randstr($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}




function wpdev_156674_pre_get_posts( $query ) {
	if ($query->is_main_query() && $query->is_tax( 'dirigido-a' )) {
		
		// Manipulate $query here, for instance like so
		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'menu_order' );
	}
}
add_action( 'pre_get_posts', 'wpdev_156674_pre_get_posts' );




/*
function paises() {
	$ars = array(
			'post_type' => array('aspirantes'),
			'posts_per_page' => -1,
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => '_status',
					'value' => '10',
					'compare' => '='
				),
				array(
					'key' => '_status',
					'value' => '20',
					'compare' => '='
				),
				array(
					'key' => '_status',
					'value' => '30',
					'compare' => '='
				)
			),
		);
	
	$query = new WP_Query( $ars );
	$posts = $query->posts;
	$paisraw = array();
	foreach ($posts as $post) {
		//$paisraw[] = get_post_meta($post->ID, 'OFI-1-APais', true);
		$paisraw[] = get_field('OFI-1-APais', $post->ID);
	}
	wp_reset_postdata();

	$paises_arr = array();
	foreach ($paisraw as $key => $value) {
		$valuef = str_replace(array('_', '(', ')'), ' ', $value);
		$paises_arr[$value] = ucwords($valuef);
	}

	return $paises_arr;
}
*/



















// Template URL Javacript Variable
wp_register_script( 'aiowpscriptvars', null);
wp_localize_script('aiowpscriptvars', 'aiowp', array(
	'siteUrl' => get_option('siteurl'),
	'templateUrl' => get_bloginfo('template_directory') 
	));
wp_enqueue_script( 'aiowpscriptvars' );



wp_register_script( 'admin-ajax', null);
wp_localize_script( 'admin-ajax', 'AIO_Ajax', array(
	'ajaxurl' => admin_url( 'admin-ajax.php' )
	));
wp_enqueue_script( 'admin-ajax' );




















add_action('wp_ajax_nopriv_frontend_faqs_search', 'frontend_faqs_search');
add_action('wp_ajax_frontend_faqs_search', 'frontend_faqs_search');
function frontend_faqs_search(){

	$args = array(
		'post_type' => 'faq_category_input',
		'post_status'    => 'publish',
		'meta_key' => 'faq_category_input'
	);

	$query = new WP_Query( $args );

 	$choices = array(); 

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$choices[] = get_post_meta( get_the_ID(), 'faq_category_input', true);
			$IDs[] = get_the_id();
		}
	}
	wp_reset_postdata();
  
	ob_start();

  	if( is_array($choices) ) {

		for ($i = 0; $i < sizeof($choices); $i++) {
			echo '<h3 class="lps-faq-cat">'.$choices[$i].'<span>';
			wp_delete_faq_category_link('Eliminar Categoria', $IDs[$i]);
			echo '</span></h3>';
			wp_display_faqs($choices[$i]);
		} 

	}

	$content = ob_get_clean();
	echo $content;

	wp_die(); 

}

function wp_display_faqs($category = ''){

	$args = array(
		'post_type' => 'faqs',
		'post_status'    => 'publish',
		'meta_key' => 'faq_category'
	);

	if($category !== ''){
		$args['meta_value'] = $category;
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post = get_post_meta(get_the_id());
			echo '<p  class="lps-faq">'.$post['faq_question']['0'].'</span>';
			wp_edit_post_link('Editar');
			wp_delete_post_link('Eliminar');	
			echo '</span></p>';
			echo  '<p style="margin: 0">'.$post['faq_answer']['0'].'</p>';	
		}
	}
	echo '<br><br>';
}



add_action('wp_ajax_nopriv_frontend_faqs_instructores_search', 'frontend_faqs_instructores_search');
add_action('wp_ajax_frontend_faqs_instructores_search', 'frontend_faqs_instructores_search');
function frontend_faqs_instructores_search(){

	$args = array(
		'post_type' => 'faq_inst_cat_input',
		'post_status'    => 'publish',
		'meta_key' => 'faq_inst_cat_input'
	);

	$query = new WP_Query( $args );

 	$choices = array(); 

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$choices[] = get_post_meta( get_the_ID(), 'faq_inst_cat_input', true);
			$IDs[] = get_the_id();
		}
	}
	wp_reset_postdata();
  
	ob_start();

  	if( is_array($choices) ) {

		for ($i = 0; $i < sizeof($choices); $i++) {
			echo '<h3 class="lps-faq-cat">'.$choices[$i].'<span>';
			wp_delete_faq_category_link('Eliminar Categoria', $IDs[$i], 92);
			echo '</span></h3>';
			wp_display_faqs_instructores($choices[$i]);
		} 

	}

	$content = ob_get_clean();
	echo $content;

	wp_die(); 

}

function wp_display_faqs_instructores($category = ''){

	$args = array(
		'post_type' => 'faqs_instructores',
		'post_status'    => 'publish',
		'meta_key' => 'faq_inst_category'
	);

	if($category !== ''){
		$args['meta_value'] = $category;
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post = get_post_meta(get_the_id());
			echo '<p  class="lps-faq">'.$post['faq_inst_question']['0'].'</span>';
			wp_edit_post_link('Editar');
			wp_delete_post_link('Eliminar');
			echo '</span>
			</p>';
			echo  '<p style="margin: 0">'.$post['faq_inst_answer']['0'].'</p>';	
		}
	}

}

add_action('wp_ajax_nopriv_frontend_faqs_certificadores_search', 'frontend_faqs_certificadores_search');
add_action('wp_ajax_frontend_faqs_certificadores_search', 'frontend_faqs_certificadores_search');
function frontend_faqs_certificadores_search(){

	$args = array(
		'post_type' => 'faq_cert_cat_input',
		'post_status'    => 'publish',
		'meta_key' => 'faq_cert_cat_input'
	);

	$query = new WP_Query( $args );

 	$choices = array(); 



	 if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$choices[] = get_post_meta( get_the_ID(), 'faq_cert_cat_input', true);
			$IDs[] = get_the_id();
		}
	}
	wp_reset_postdata();
  
	ob_start();

  	if( is_array($choices) ) {

		for ($i = 0; $i < sizeof($choices); $i++) {
			echo '<h3 class="lps-faq-cat">'.$choices[$i].'<span>';
			wp_delete_faq_category_link('Eliminar Categoria', $IDs[$i], 125);
			echo '</span></h3>';
			wp_display_faqs_certificadores($choices[$i]);
		} 

	}

	$content = ob_get_clean();
	echo $content;

	wp_die(); 
}

function wp_display_faqs_certificadores($category = ''){

	$args = array(
		'post_type' => 'faqs_certificadores',
		'post_status'    => 'publish',
		'meta_key' => 'faq_cert_category'
	);

	if($category !== ''){
		$args['meta_value'] = $category;
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post = get_post_meta(get_the_id());
			echo '<p class="lps-faq">'.$post['faq_cert_question']['0'].'
				<span>';
				wp_edit_post_link('Editar');
				wp_delete_post_link('Eliminar');
			echo '</span>
			</p>';
			echo  '<p style="margin: 0">'.$post['faq_cert_answer']['0'].'</p>';	
		}
	}
}

add_action('wp_ajax_nopriv_frontend_manual_instructores_search', 'frontend_manual_instructores_search');
add_action('wp_ajax_frontend_manual_instructores_search', 'frontend_manual_instructores_search');
function frontend_manual_instructores_search(){

	$args = array(
		'post_type' => 'entry_inst_cat_input',
		'post_status'    => 'publish',
		'meta_key' => 'entry_inst_cat_input'
	);

	$query = new WP_Query( $args );

 	$choices = array(); 

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$choices[] = get_post_meta( get_the_ID(), 'entry_inst_cat_input', true);
			$IDs[] = get_the_id();
		}
	}
	wp_reset_postdata();
  
	ob_start();

  	if( is_array($choices) ) {

		for ($i = 0; $i < sizeof($choices); $i++) {
			echo '<h3 class="lps-faq-cat">'.$choices[$i].'<span>';
			wp_delete_faq_category_link('Eliminar Categoria', $IDs[$i], 92);
			echo '</span></h3>';
			wp_display_manual_instructores($choices[$i]);
		} 

	}

	$content = ob_get_clean();
	echo $content;

	wp_die(); 


}

function wp_display_manual_instructores($category = ''){

	$args = array(
		'post_type' => 'manual_instructores',
		'post_status'    => 'publish',
		'meta_key' => 'entry_inst_category'
	);

	if($category !== ''){
		$args['meta_value'] = $category;
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			// $query->the_post();
			$query->the_post();
			$post = get_post_meta(get_the_id());
			echo '<p style="font-weight: 600;margin-bottom: 0">'.$post['entry_inst_title']['0'].'
				<span>';
				wp_edit_post_link('Editar');
				wp_delete_post_link('Eliminar');
			echo '</span>
			</p>';
			echo  '<p style="margin: 0">'.$post['entry_inst_content']['0'].'</p>';	
		}
	}

}



add_action('wp_ajax_nopriv_frontend_manual_certificadores_search', 'frontend_manual_certificadores_search');
add_action('wp_ajax_frontend_manual_certificadores_search', 'frontend_manual_certificadores_search');
function frontend_manual_certificadores_search(){

	$args = array(
		'post_type' => 'entry_cert_cat_input',
		'post_status'    => 'publish',
		'meta_key' => 'entry_cert_cat_input'
	);

	$query = new WP_Query( $args );

 	$choices = array(); 


	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$choices[] = get_post_meta( get_the_ID(), 'entry_cert_cat_input', true);
			$IDs[] = get_the_id();
		}
	}
	wp_reset_postdata();
  
	ob_start();

  	if( is_array($choices) ) {

		for ($i = 0; $i < sizeof($choices); $i++) {
			echo '<h3 class="lps-faq-cat">'.$choices[$i].'<span>';
			wp_delete_faq_category_link('Eliminar Categoria', $IDs[$i], 125);
			echo '</span></h3>';
			wp_display_manual_certificadores($choices[$i]);
		} 

	}

	$content = ob_get_clean();
	echo $content;

	wp_die(); 

}

function wp_display_manual_certificadores($category = ''){
	$args = array(
		'post_type' => 'manual_certifs',
		'post_status'    => 'publish',
		'meta_key' => 'entry_cert_category'
	);

	if($category !== ''){
		$args['meta_value'] = $category;
	}
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {

			$query->the_post();
			$post = get_post_meta(get_the_id());
			
			echo '<p style="font-weight: 600;margin-bottom: 0">'.$post['entry_cert_title']['0'].'
				<span>';
				wp_edit_post_link('Editar');
				wp_delete_post_link('Eliminar');
			echo '</span>
			</p>';
			echo  '<p style="margin: 0">'.$post['entry_cert_content']['0'].'</p>';	
		}
	}

}




























add_action('wp_ajax_nopriv_frontend_instructores_search', 'frontend_instructores_search');
add_action('wp_ajax_frontend_instructores_search', 'frontend_instructores_search');
function frontend_instructores_search(){

	// POST VARS
	$search_query = $_POST['search_query'];
	$aspirante_paged = $_POST['page'];
	$order = $_POST['order'];
	$orderby = $_POST['orderby'];

	// ARGS
	$args = array (
		'post_type'   => array('aspirantes'),
		'post_status' => 'publish',
		'author'      => $userid,
		'meta_key'    => 'ASP_tipo_aspirante',
		'meta_value'  => 'instructor',
		'paged'       => $aspirante_paged,
		's'           => $search_query,
		'meta_query'  => array(
			'relation' => 'AND',
			array(
				'relation' => 'OR',
				array(
					'key' => '_status',
					'value' => '08',
					'compare' => '='
				),
				array(
					'key' => '_status',
					'value' => '10',
					'compare' => '='
				),
				array(
					'key' => '_status',
					'value' => '60',
					'compare' => '='
				)
			),
			array(
				'key' => 'ASP_instructor_lista_mostrar',
				'value' => '1',
				'compare' => '='
			)
		)
			
	);

	$aspirante_query = new WP_Query( $args ); ob_start();



	if ($aspirante_query->have_posts()) {

		echo '<ul class="lista-alumnos">';

		$counter = 0;

		while ($aspirante_query->have_posts()) {
			$aspirante_query->the_post();

			$counter++; 

			$post_type = get_post_type_object($post->post_type); 

			// vars 
			$numero = get_the_ID();
			$noiveo = get_field('ASP_numero_instructor_veo');
			$alta = get_the_date('Y-m-d');
			$sexo = get_field('ASP_sexo');
			$pais = strtoupper(get_field('ASP_pais'));
			$estado = get_field('ASP_estado');
			$municipio = get_field('ASP_municipio');
			$telefono1 = get_field('ASP_telefono1');
			$telefono2 = get_field('ASP_telefono2');
			$email = get_field('ASP_email'); 

			$pais_mostrar = get_field('ASP_pais_mostrar');
			$municipio_mostrar = get_field('ASP_municipio_mostrar');
			$estado_mostrar = get_field('ASP_estado_mostrar');
			$telefono1_mostrar = get_field('ASP_telefono1_mostrar');
			$telefono2_mostrar = get_field('ASP_telefono2_mostrar');
			$email_mostrar = get_field('ASP_email_mostrar'); 

			$cfuserid = get_post_meta( get_the_ID(), '_userid', true );

			$statusraw = get_field('status', 'user_'.$cfuserid);


			switch ($statusraw) {
				case '00': $status = 'Sin Certificar'; break;
				case '05': $status = 'Pendiente'; break;
				case '08': $status = 'Pre Certificado'; break;
				case '10': $status = 'Certificado'; break;
				case '20': $status = 'Suspendido'; break;
				case '30': $status = 'Sin movimiento en 12 meses'; break;
				case '50': $status = 'No Deseado'; break;
				case '60': $status = 'No Autorizado'; break;
			}
		?>

			<li 
				class="section wow fadeIn" 
				data-wow-delay="<?php echo $counter*2; ?>0ms">
				<h5 class="no-margin pdt"> <?php the_title(); ?> </h5>
				
				<?php $noiveo_or_id = !empty($noiveo) ? $noiveo : 'ID'.str_pad($cfuserid, 5, '0', STR_PAD_LEFT); ?>
				<small class="blue-grey-text">
					<?php echo $noiveo_or_id; ?> — 
					<span class="badge-status status-<?php echo $statusraw; ?>">
						<?php echo $status; ?>
					</span>
				</small>

				<a 
					href="javascript:void(0)" 
					class="personal-data-toggle">
					<i class="ti-id-badge"></i>
				</a>

				<div class="personal-data">
					<ul class="data-list">

						<li>
							<?php 


							// echo $pais;
							// if($estado_mostrar == 1){
							// 	echo ', '.$estado;
							// }
							// if($municipio_mostrar == 1){
							// 	echo ', '.$municipio;
							// }

							if($municipio_mostrar == 1){
								echo $municipio;
							}
							if($estado_mostrar == 1){
								echo ', '.$estado;
							}
							echo ', '.$pais;
						
							?>
						</li>

						<?php // phone number and email data

							$tel1 = !empty($telefono1) ? '<span class="tel1"><i class="ti-headphone-alt"></i> '.$telefono1.'</span>' : '';
							$tel2 = !empty($telefono2) ? '<span class="tel2"><i class="ti-headphone-alt"></i> '.$telefono2.'</span>' : '';
							$email_html = 
								'<a 
									href="mailto:'.antispambot($email).'">
									<span class="email">
										<i class="ti-email"></i>'.antispambot($email).
									'</span>
								</a>';

							$tel1 = $tel1<>'' ? '<a href="tel:'.$telefono1.'" class="instructor-tel">'.$tel1.'</a>':$tel1;
							$tel2 = $tel2<>'' ? '<a href="tel:'.$telefono2.'" class="instructor-tel">'.$tel2.'</a>':$tel2;

						?>
						<li>
							<?php 
								if($telefono1_mostrar == 1){
									echo $tel1; 
								}
								if($telefono1_mostrar == 1){
									echo $tel1; 
								}
								if($email_mostrar == 1){
									echo $email_html;
								}
							?>

						</li>
					</ul>
				</div>
			</li>

			<script>
				jQuery('.phone').text(function(i, text) {
					return text.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, '($1) $2-$3');
				});
			</script>



			<?php 

		} //end while

		echo '</ul>';
		echo '<script>onlyCallToCellphone()</script>';

		$max = $aspirante_query->max_num_pages;
		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		
		$nextPage = $aspirante_paged + 1;

		if($nextPage <= $max) {
			echo '<span id="load-more-aspirantes-wrap" class="load-more-wrap center wow fadeInUp cf"><a href="'.admin_url().'admin-ajax.php?paged='.$nextPage.'" id="load-more-aspirantes" class="btn load-more-btn">Cargar más</a></span>';
		}


	} else {
		echo '<li class="col-12">No se encontraron resultados</li>';
	}


	$content = ob_get_clean();
	echo $content;

	wp_die(); 
}











































add_action('wp_ajax_nopriv_frontend_certificadores_search', 'frontend_certificadores_search');
add_action('wp_ajax_frontend_certificadores_search', 'frontend_certificadores_search');
function frontend_certificadores_search() {

	// POST VARS
	$search_query = $_POST['search_query'];
	$aspirante_paged = $_POST['page'];
	$order = $_POST['order'];
	$orderby = $_POST['orderby'];

	// ARGS
	$args = array (
		'post_type'   => array('aspirantes'),
		'post_status' => 'publish',
		'author'      => $userid,
		'meta_key'    => 'ASP_tipo_aspirante',
		'meta_value'  => 'certificador',
		'paged'       => $aspirante_paged,
		's'           => $search_query,
		'meta_query'  => array(
			'relation' => 'AND',
			array(
				'relation' => 'OR',
				array(
					'key' => '_status',
					'value' => '08',
					'compare' => '='
				),
				array(
					'key' => '_status',
					'value' => '10',
					'compare' => '='
				),
				array(
					'key' => '_status',
					'value' => '60',
					'compare' => '='
				)
			),
			array(
				'key' => 'ASP_instructor_lista_mostrar',
				'value' => '1',
				'compare' => '='
			)
		)
	);

	$aspirante_query = new WP_Query( $args ); ob_start();

	if ($aspirante_query->have_posts()) {

		echo '<ul class="lista-alumnos">';$counter = 0;
		
		while ($aspirante_query->have_posts()) {
			$aspirante_query->the_post();

			$counter++; 

			$post_type = get_post_type_object($post->post_type); 

			// vars 
			$numero = get_the_ID();
			$noiveo = get_field('ASP_numero_instructor_veo');
			$alta = get_the_date('Y-m-d');
			$sexo = get_field('ASP_sexo');
			$pais = get_field('ASP_pais');
			$estado = get_field('ASP_estado');
			$municipio = get_field('ASP_municipio');
			$telefono1 = get_field('ASP_telefono1');
			$telefono2 = get_field('ASP_telefono2');
			$email = get_field('ASP_email'); 

			$pais_mostrar = get_field('ASP_pais_mostrar');
			$municipio_mostrar = get_field('ASP_municipio_mostrar');
			$estado_mostrar = get_field('ASP_estado_mostrar');
			$telefono1_mostrar = get_field('ASP_telefono1_mostrar');
			$telefono2_mostrar = get_field('ASP_telefono2_mostrar');
			$email_mostrar = get_field('ASP_email_mostrar'); 


			$cfuserid = get_post_meta( get_the_ID(), '_userid', true );

			$statusraw = get_field('status', 'user_'.$cfuserid);

			switch ($statusraw) {
				case '00': $status = 'Sin Certificar'; break;
				case '05': $status = 'Pendiente'; break;
				case '08': $status = 'Pre Certificado'; break;
				case '10': $status = 'Certificado'; break;
				case '20': $status = 'Suspendido'; break;
				case '30': $status = 'Sin movimiento en 12 meses'; break;
				case '50': $status = 'No Deseado'; break;
				case '60': $status = 'No Autorizado'; break;

			}

			?>


			<li class="section wow fadeIn" data-wow-delay="<?php echo $counter*2; ?>0ms">
				<h5 class="no-margin pdt">
					<?php the_title(); ?>
				</h5>
				
				<?php $noiveo_or_id = !empty($noiveo) ? $noiveo : 'ID'.str_pad($cfuserid, 5, '0', STR_PAD_LEFT); ?>
				<small 
					class="blue-grey-text">
					<?php echo $noiveo_or_id; ?> — 
					<span class="badge-status status-<?php echo $statusraw; ?>">
						<?php echo $status; ?>
					</span>
				</small>
				
				<a href="javascript:void(0)" class="personal-data-toggle"><i class="ti-id-badge"></i></a>
				<div class="personal-data">
					<ul class="data-list">
						<li>
						<?php 
						if($municipio_mostrar == 1){
							echo $municipio;
						}
						if($estado_mostrar == 1){
							echo ', '.$estado;
						}
						if($pais_mostrar == 1){
							echo ', '.$pais;
						}
						?>.

						</li>
						
						<?php // phone number and email data
						
						$tel1 = !empty($telefono1) ? '<span class="tel1"><i class="ti-headphone-alt"></i> '.$telefono1.'</span>' : '';
						$tel2 = !empty($telefono2) ? '<span class="tel2"><i class="ti-headphone-alt"></i> '.$telefono2.'</span>' : '';
						$email_html = 
							'<a 
								href="mailto:'.antispambot($email).'">
								<span class="email">
									<i class="ti-email"></i>'.antispambot($email).
								'</span>
							</a>';

						$tel1 = $tel1<>'' ? '<a href="tel:'.$telefono1.'" class="instructor-tel">'.$tel1.'</a>':$tel1;
						$tel2 = $tel2<>'' ? '<a href="tel:'.$telefono2.'" class="instructor-tel">'.$tel2.'</a>':$tel2;

						?>

						<li>
							<?php 
								if($telefono1_mostrar == 1){
									echo $tel1; 
								}
								if($telefono1_mostrar == 1){
									echo $tel1; 
								}
								if($email_mostrar == 1){
									echo $email_html;
								}
							?>

						</li>

					</ul>
				</div>
			<?php 
		} //end while

		echo '</ul>';

		$max = $aspirante_query->max_num_pages;
		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		
		$nextPage = $aspirante_paged + 1;


		if($nextPage <= $max) {
			echo '<span id="load-more-aspirantes-wrap" class="load-more-wrap center wow fadeInUp cf"><a href="'.admin_url().'admin-ajax.php?paged='.$nextPage.'" id="load-more-aspirantes" class="btn load-more-btn">Cargar más</a></span>';
		}

	} else {
		echo '<li class="col-12">No se encontraron resultados</li>';
	}


	$content = ob_get_clean();
	echo $content;

	wp_die(); 
}














































add_action('wp_ajax_nopriv_frontend_alumnos_search', 'frontend_alumnos_search');
add_action('wp_ajax_frontend_alumnos_search', 'frontend_alumnos_search');
function frontend_alumnos_search(){

	// POST VARS
	$search_query = $_POST['search_query'];
	$alumno_paged = $_POST['page'];
	$order = $_POST['order'];
	$orderby = $_POST['orderby'];


	$current_user = wp_get_current_user();

	// ARGS
	$args = array (
		'post_type' => array('alumnos'),
		'post_status' => 'publish',
		'author' => $current_user->ID,
		'paged' => $alumno_paged,
		's' => $search_query,
	);

	$alumno_query = new WP_Query( $args ); ob_start();
	
	// verificar porque el quiery no esta encontrando los posts de alumnos
	if ($alumno_query->have_posts()) {

		echo '<ul class="lista-alumnos">';$counter = 0;
		
		//libreria de db te regresara un array de arrays sobre el que vas a hacer el loop
		while ($alumno_query->have_posts()) {
			$alumno_query->the_post();


			$counter++; 

			$post_type = get_post_type_object($post->post_type); 

			// vars 
			$numero = get_the_ID();
			$alta = get_the_date('Y-m-d');

			//estos valores se van a conseguir del array que lance la funcion para queries
			$sexo = get_field('OFI-1-ASexo');
			$pais = get_field('OFI-1-APais');
			$estado = get_field('OFI-1-AEstado');
			$municipio = get_field('OFI-1-AMunicipio');
			$telefono1 = get_field('OFI-1-ATelefono1');
			$telefono2 = get_field('OFI-1-ATelefono2');
			$mama = get_field('OFI-1-ANombreDeMama');
			$email = get_field('OFI-1-AEmail');


			
			?>


			<li class="section wow fadeIn" data-wow-delay="<?php echo $counter*2; ?>0ms">
				<h5 class="no-margin"><?php the_title(); ?></h5>
				<small class="blue-grey-text">Número de Alumno: <?php echo $numero; ?> — Fecha de Alta: <?php echo $alta; ?></small>
				<div class="">

				</div>
				<!-- 2250 -->
				<a 
					class="box-picture post-link" 
					href="<?php the_permalink(); echo '&'; ?>" 
					data-mfp-src="<?php the_permalink(); echo '&'; ?>" 
					rel="<?php the_ID(); ?>" 
					data-effect="mfp-modal">
					<small>Cambios al Alumno</small>
				</a>
				<a 
					class="box-picture post-link" 
					href="<?php the_permalink(1870); echo '&num_alumno='.get_the_ID().'&'; ?>" 
					data-mfp-src="<?php the_permalink(1870); echo '&num_alumno='.get_the_ID().'&'; ?>" 
					rel="<?php the_ID(); ?>" 
					data-effect="mfp-modal">
					<small>Registrar costo de clase</small>
				</a>
				<?php echo $post->ID; ?>
				<?php wp_delete_post_link('Eliminar'); ?>

				
			</li>



			<?php
			$curPage = curPageURL();

			$parsedcurPage = parse_url($curPage);
			$path = $parsedcurPage['path'];
			$sluge = explode('/', $path);
			// print_r($path);
			$slug = array_slice($sluge, -2, 1);

			?>  


			<script>
				jQuery('.phone').text(function(i, text) {
					return text.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, '($1) $2-$3');
				});
				jQuery(document).ready(function($) {
					$('.post-link').magnificPopup({
						type:'ajax',
						tLoading: '',
						midClick: true,
						removalDelay: 500,
						callbacks: {
							close: function() {
							},
						},
						ajax: {
							settings: {
								type: 'POST',
								data: {
									url: '<?php echo $slug['0']; ?>'
								}
							}
						}
					});
				});
			</script>

		<?php }

		echo '</ul>';

		$max = $alumno_query->max_num_pages;
		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		
		$nextPage = $alumno_paged + 1;

		//echo '<pre style="width:100%">'; print_r($tax_query); echo '</pre>';

		if($nextPage <= $max) {
			echo '<span id="load-more-alumnos-wrap" class="load-more-wrap center wow fadeInUp cf"><a href="'.admin_url().'admin-ajax.php?paged='.$nextPage.'" id="load-more-alumnos" class="btn load-more-btn">Cargar más</a></span>';
		}


	} else {
		echo '<li class="col-12">No se encontraron resultados</li>';
	}


	$content = ob_get_clean();
	echo $content;

	wp_die(); 
}































add_action('wp_ajax_nopriv_frontend_instructores_admin_search', 'frontend_instructores_admin_search');
add_action('wp_ajax_frontend_instructores_admin_search', 'frontend_instructores_admin_search');
function frontend_instructores_admin_search(){

	// POST VARS
	$search_query = $_POST['search_query'];
	$aspirante_paged = $_POST['page'];
	$order = $_POST['order'];
	$orderby = $_POST['orderby'];
	$pagetemplate = $_POST['pagetemplate'];

	if($pagetemplate == 'page-ofc.php') {
		$userid = get_current_user_id();
	} else if($pagetemplate == 'page-ofa.php') {
		$userid = '';
	}

	// ARGS
	$args = array (
		'post_type' => array('aspirantes'),
		'post_status' => 'publish',
		'author'     => $userid,
		'meta_key'   => 'ASP_tipo_aspirante',
		'meta_value' => 'instructor',
		'paged' => $aspirante_paged,
		's' => $search_query,
	);

	$aspirante_query = new WP_Query( $args ); 
	
	ob_start();

	if ($aspirante_query->have_posts()) {

		echo '<ul class="lista-alumnos">';
		$counter = 0;

		











		while ($aspirante_query->have_posts()) {
			$aspirante_query->the_post();

			$counter++; 
			$post_type = get_post_type_object($post->post_type); 

			// vars 
			$numero = get_the_ID();
			$noiveo = get_field('ASP_numero_instructor_veo');
			$alta = get_the_date('M j, Y');
			$sexo = get_field('ASP_sexo');
			$pais = get_field('ASP_pais');
			$estado = get_field('ASP_estado');
			$municipio = get_field('ASP_municipio');
			$telefono1 = get_field('ASP_telefono1');
			$telefono2 = get_field('ASP_telefono2');
			$email = get_field('ASP_email'); 

			$cfuserid = get_post_meta( get_the_ID(), '_userid', true );

			$statusraw = get_field('status', 'user_'.$cfuserid);

			switch ($statusraw) {
				case '00': $status = 'Sin Certificar'; break;
				case '05': $status = 'Pendiente'; break;
				case '08': $status = 'Pre Certificado'; break;
				case '10': $status = 'Certificado'; break;
				case '20': $status = 'Suspendido'; break;
				case '30': $status = 'Sin movimiento en 12 meses'; break;
				case '50': $status = 'No Deseado'; break;
				case '60': $status = 'No Autorizado'; break;
			} 

		?>

			<li class="section wow fadeIn" data-wow-delay="<?php echo $counter*2; ?>0ms">
				<h5 class="no-margin">
					<?php the_title(); ?>
					<span>
						<a 
							class="box-picture post-link" 
							href="<?php the_permalink(); ?>" 
							data-mfp-src="<?php the_permalink(); ?>" 
							rel="<?php the_ID(); ?>" 
							data-effect="mfp-modal">
						</a>
					</span>
				</h5>
				
				<?php $noiveo_or_id = !empty($noiveo) ? $noiveo : 'ID'.str_pad($cfuserid, 5, '0', STR_PAD_LEFT); ?>
				<small class="blue-grey-text">
					<?php echo $noiveo_or_id; ?> — <span class="badge-status status-<?php echo $statusraw; ?>"><?php echo $status; ?></span> — Fecha de alta: <?php echo $alta; ?>. 
				</small>

				<a 
					class="box-picture post-link" 
					href="<?php the_permalink(); echo '&'; ?>" 
					data-mfp-src="<?php the_permalink(); echo '&'; ?>" 
					rel="<?php get_the_ID(); ?>" 
					data-effect="mfp-modal">
					<small>
						Modificar Datos
					</small>
				</a>

				<?php 
				if($pagetemplate == 'page-ofc.php') {
					wp_delete_aspirante_link($cfuserid, '00', '125', 'Eliminar');
				} else if($pagetemplate == 'page-ofa.php') {
					wp_delete_aspirante_link($cfuserid, '', '156', 'Eliminar');
				}
				?>


				<div class="personal-data-admin">
					<ul class="data-list">
						<li><?php echo $municipio.', '.$estado.', '.$pais; ?>.</li>
						
						<?php // phone number and email data
						$tel2 = !empty($telefono2) ? '<span class="tel2"><i class="ti-headphone-alt"></i> '.$telefono2.'</span>' : '';
						echo sprintf('<li><span class="tel1"><i class="ti-headphone-alt"></i> <span class="phone">%s</span></span> %s <span class="email"><i class="ti-email"></i> <a href="mailto:%s">%s</a></span></li>', $telefono1, $tel2, antispambot($email), antispambot($email)); ?>
					</ul>
				</div>
			</li>


			<?php
			$curPage = curPageURL();
			$parsedcurPage = parse_url($curPage);
			$path = $parsedcurPage['path'];
			$sluge = explode('/', $path);
			$slug = array_slice($sluge, -2, 1);
			?>  

			<script>
				jQuery('.phone').text(function(i, text) {
					return text.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, '($1) $2-$3');
				});
				jQuery(document).ready(function($) {
					$('.post-link').magnificPopup({
						type:'ajax',
						tLoading: '',
						midClick: true,
						removalDelay: 500,
						callbacks: {
							beforeOpen: function() {
								this.st.mainClass = this.st.el.attr('data-effect');
							},
							close: function() {
							},
						},
						ajax: {
							settings: {
								type: 'POST',
								data: {
									url: '<?php echo $slug['0']; ?>'
								}
							}
						}
					});
				});
			</script>

		<?php } //end while


















		echo '</ul>';

		$max = $aspirante_query->max_num_pages;
		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		$nextPage = $aspirante_paged + 1;

		if($nextPage <= $max) {
			echo '<span id="load-more-aspirantes-admin-wrap" class="load-more-wrap center wow fadeInUp cf"><a href="'.admin_url().'admin-ajax.php?paged='.$nextPage.'" id="load-more-aspirantes-admin" class="btn load-more-btn">Cargar más</a></span>';
		}

	} else {
		echo '<li class="col-12">No se encontraron resultados</li>';
	}

	$content = ob_get_clean();
	echo $content;

	wp_die(); 
}


















add_action('wp_ajax_nopriv_frontend_certificadores_admin_search', 'frontend_certificadores_admin_search');
add_action('wp_ajax_frontend_certificadores_admin_search', 'frontend_certificadores_admin_search');
function frontend_certificadores_admin_search(){

	// POST VARS
	$search_query = $_POST['search_query'];
	$aspirante_paged = $_POST['page'];

	$order = $_POST['order'];
	$orderby = $_POST['orderby'];
	$pagetemplate = $_POST['pagetemplate'];

	if($pagetemplate == 'page-ofcs.php') {
		$userid = get_current_user_id();
	} else if($pagetemplate == 'page-ofa.php') {
		$userid = '';
	}

	// ARGS
	$args = array (
		'post_type' => array('aspirantes'),
		'post_status' => 'publish',
		'author'     => $userid,
		'meta_key'   => 'ASP_tipo_aspirante',
		'meta_value' => 'certificador',
		'paged' => $aspirante_paged,
		's' => $search_query
	);

	$aspirante_query = new WP_Query( $args ); ob_start();

	if ($aspirante_query->have_posts()) {

		echo '<ul class="lista-alumnos">';$counter = 0;

		while ($aspirante_query->have_posts()) {
			$aspirante_query->the_post();

			$counter++; //$ms = str_pad($counter, 2, '0', STR_PAD_LEFT);

			$post_type = get_post_type_object($post->post_type); 

			// vars 
			$numero = get_the_ID();
			$noiveo = get_field('ASP_numero_instructor_veo');
			$alta = get_the_date('M j, Y');
			$sexo = get_field('ASP_sexo');
			$pais = get_field('ASP_pais');
			$estado = get_field('ASP_estado');
			$municipio = get_field('ASP_municipio');
			$telefono1 = get_field('ASP_telefono1');
			$telefono2 = get_field('ASP_telefono2');
			$email = get_field('ASP_email'); 

			$cfuserid = get_post_meta( get_the_ID(), '_userid', true );

			$statusraw = get_field('status', 'user_'.$cfuserid);
			//$status = ( $statusraw == 10) ? 'Certificado' : 'Pre Certificado';

			switch ($statusraw) {
				case '00': $status = 'Sin Certificar'; break;
				case '05': $status = 'Pendiente'; break;
				case '08': $status = 'Pre Certificado'; break;
				case '10': $status = 'Certificado'; break;
				case '20': $status = 'Suspendido'; break;
				case '30': $status = 'Sin movimiento en 12 meses'; break;
				case '50': $status = 'No Deseado'; break;
			}

		?>

		<li class="section wow fadeIn" data-wow-delay="<?php echo $counter*2; ?>0ms">
			<h5 class="no-margin">
				<?php the_title(); ?>
			</h5>
			
			<?php $noiveo_or_id = !empty($noiveo) ? $noiveo : 'ID'.str_pad($cfuserid, 5, '0', STR_PAD_LEFT); ?>
			<small class="blue-grey-text">
				<?php echo $noiveo_or_id; ?> — <span class="badge-status status-<?php echo $statusraw; ?>"><?php echo $status; ?></span> — Fecha de alta: <?php echo $alta; ?>. 
			</small>

			<a 
				class="box-picture post-link" 
				href="<?php the_permalink(); echo '&'; ?>" 
				data-mfp-src="<?php the_permalink(); echo '&'; ?>" 
				rel="<?php the_ID(); ?>" 
				data-effect="mfp-modal">
				<small>Modificar Datos</small>	
				<?php wp_delete_aspirante_link($cfuserid, '', '156', 'Eliminar'); ?>
			</a>

			<a href="<?php the_permalink(); ?>" data-mfp-src="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>" data-effect="mfp-modal" class="personal-data-toggle-admin post-link"><i class="ti-pencil"></i></a>
			<div class="personal-data-admin">
				<ul class="data-list">
					<li><?php echo $municipio.', '.$estado.', '.$pais; ?>.</li>
					
					<?php // phone number and email data
					$tel2 = !empty($telefono2) ? '<span class="tel2"><i class="ti-headphone-alt"></i> '.$telefono2.'</span>' : '';
					echo sprintf('<li><span class="tel1"><i class="ti-headphone-alt"></i> <span class="phone">%s</span></span> %s <span class="email"><i class="ti-email"></i> <a href="mailto:%s">%s</a></span></li>', $telefono1, $tel2, antispambot($email), antispambot($email)); ?>
				</ul>
			</div>
		</li>

<?php
$curPage = curPageURL();
//echo '<pre style="background:#333;color:white;padding:1em;">';
//print_r(parse_url($curPage));
//echo parse_url($url, PHP_URL_PATH);
//print_r($wp_query);
//echo $_SERVER['HTTP_REFERER']
$parsedcurPage = parse_url($curPage);
$path = $parsedcurPage['path'];
$sluge = explode('/', $path);
$slug = array_slice($sluge, -2, 1);
//print_r($slug);
//echo '</pre>';
 ?>  

	<script>
		jQuery('.phone').text(function(i, text) {
			return text.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, '($1) $2-$3');
		});
		jQuery(document).ready(function($) {
			$('.post-link').magnificPopup({
				type:'ajax',
				tLoading: '',
				midClick: true,
				removalDelay: 500,
				callbacks: {
					beforeOpen: function() {
						this.st.mainClass = this.st.el.attr('data-effect');
					},
					close: function() {
					},
				},
				ajax: {
					settings: {
						type: 'POST',
						data: {
							url: '<?php echo $slug['0']; ?>'
						}
					}
				}
			});
		});
	</script>








		<?php }

		echo '</ul>';

		$max = $aspirante_query->max_num_pages;
		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		
		$nextPage = $aspirante_paged + 1;

		//echo '<pre style="width:100%">'; print_r($tax_query); echo '</pre>';

		if($nextPage <= $max) {
			echo '<span id="load-more-aspirantes-admin-wrap" class="load-more-wrap center wow fadeInUp cf"><a href="'.admin_url().'admin-ajax.php?paged='.$nextPage.'" id="load-more-aspirantes-admin" class="btn load-more-btn">Cargar más</a></span>';
		}


	} else {
		echo '<li class="col-12">No se encontraron resultados</li>';
	}


	$content = ob_get_clean();
	echo $content;

	wp_die(); 
}









?>