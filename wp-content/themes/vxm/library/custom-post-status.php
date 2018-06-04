<?php 
/*
CUSTOM POST STATUSES
*/


// PREVENTA
function preventa_custom_post_status(){
	register_post_status( 'preventa', array(
		'label'                     => _x( 'Preventa', 'cerradas' ),
		'public'                    => true,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Preventa <span class="count">(%s)</span>', 'Preventa <span class="count">(%s)</span>' )
		) );
}
add_action( 'init', 'preventa_custom_post_status' );

function preventa_append_post_status_list(){
	global $post;
	$complete = '';
	$label = '';
	if($post->post_type == 'cerradas'){
		if($post->post_status == 'preventa'){
			$complete = ' selected=\"selected\"';
			$label = '<span id=\"post-status-display\"> Preventa</span>';
		}
		echo '
		<script>
			jQuery(document).ready(function($){
				$("select#post_status").append("<option value=\"preventa\" '.$complete.'>Preventa</option>");
				$("select[name=\"_status\"]").append("<option value=\"preventa\" '.$complete.'>Preventa</option>");
				$(".misc-pub-section label").append("'.$label.'");
			});
		</script>
		';
	}
}
add_action('admin_footer-post.php', 'preventa_append_post_status_list');
add_action('admin_footer-edit.php','preventa_append_post_status_list');

function preventa_display_status_label( $statuses ) {
	global $post;
	if( get_query_var( 'post_status' ) != 'preventa' ){
		if( $post->post_status == 'preventa' ){
			return array('Preventa');
		}
	}
	return $statuses;
}
add_filter( 'display_post_states', 'preventa_display_status_label' );








// VENTA
function venta_custom_post_status(){
	register_post_status( 'venta', array(
		'label'                     => _x( 'Venta', 'cerradas' ),
		'public'                    => true,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Venta <span class="count">(%s)</span>', 'Venta <span class="count">(%s)</span>' )
		) );
}
add_action( 'init', 'venta_custom_post_status' );

function venta_append_post_status_list(){
	global $post;
	$complete = '';
	$label = '';
	if($post->post_type == 'cerradas'){
		if($post->post_status == 'venta'){
			$complete = ' selected=\"selected\"';
			$label = '<span id=\"post-status-display\"> Venta</span>';
		}
		echo '
		<script>
			jQuery(document).ready(function($){
				$("select#post_status").append("<option value=\"venta\" '.$complete.'>Venta</option>");
				$("select[name=\"_status\"]").append("<option value=\"venta\" '.$complete.'>Venta</option>");
				$(".misc-pub-section label").append("'.$label.'");
			});
		</script>
		';
	}
}
add_action('admin_footer-post.php', 'venta_append_post_status_list');
add_action('admin_footer-edit.php','venta_append_post_status_list');

function venta_display_status_label( $statuses ) {
	global $post;
	if( get_query_var( 'post_status' ) != 'venta' ){
		if( $post->post_status == 'venta' ){
			return array('Venta');
		}
	}
	return $statuses;
}
add_filter( 'display_post_states', 'venta_display_status_label' );













// ULTIMAS CASAS
function ultimas_custom_post_status(){
	register_post_status( 'ultimas', array(
		'label'                     => _x( 'Ultimas Casas', 'cerradas' ),
		'public'                    => true,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Ultimas Casas <span class="count">(%s)</span>', 'Ultimas Casas <span class="count">(%s)</span>' )
		) );
}
add_action( 'init', 'ultimas_custom_post_status' );

function ultimas_append_post_status_list(){
	global $post;
	$complete = '';
	$label = '';
	if($post->post_type == 'cerradas'){
		if($post->post_status == 'ultimas'){
			$complete = ' selected=\"selected\"';
			$label = '<span id=\"post-status-display\"> Ultimas Casas</span>';
		}
		echo '
		<script>
			jQuery(document).ready(function($){
				$("select#post_status").append("<option value=\"ultimas\" '.$complete.'>Ultimas Casas</option>");
				$("select[name=\"_status\"]").append("<option value=\"ultimas\" '.$complete.'>Ultimas Casas</option>");
				$(".misc-pub-section label").append("'.$label.'");
			});
		</script>
		';
	}
}
add_action('admin_footer-post.php', 'ultimas_append_post_status_list');
add_action('admin_footer-edit.php','ultimas_append_post_status_list');

function ultimas_display_status_label( $statuses ) {
	global $post;
	if( get_query_var( 'post_status' ) != 'ultimas' ){
		if( $post->post_status == 'ultimas' ){
			return array('Ultimas Casas');
		}
	}
	return $statuses;
}
add_filter( 'display_post_states', 'ultimas_display_status_label' );



















// VENDIDO
function vendido_custom_post_status(){
	register_post_status( 'vendido', array(
		'label'                     => _x( 'Vendido', 'cerradas' ),
		'public'                    => true,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Vendido <span class="count">(%s)</span>', 'Vendido <span class="count">(%s)</span>' )
		) );
}
add_action( 'init', 'vendido_custom_post_status' );

function vendido_append_post_status_list(){
	global $post;
	$complete = '';
	$label = '';
	if($post->post_type == 'cerradas'){
		if($post->post_status == 'vendido'){
			$complete = ' selected=\"selected\"';
			$label = '<span id=\"post-status-display\"> Vendido</span>';
		}
		echo '
		<script>
			jQuery(document).ready(function($){
				$("select#post_status").append("<option value=\"vendido\" '.$complete.'>Vendido</option>");
				$("select[name=\"_status\"]").append("<option value=\"vendido\" '.$complete.'>Vendido</option>");
				$(".misc-pub-section label").append("'.$label.'");
			});
		</script>
		';
	}
}
add_action('admin_footer-post.php', 'vendido_append_post_status_list');
add_action('admin_footer-edit.php','vendido_append_post_status_list');

function vendido_display_status_label( $statuses ) {
	global $post;
	if( get_query_var( 'post_status' ) != 'vendido' ){
		if( $post->post_status == 'vendido' ){
			return array('Vendido');
		}
	}
	return $statuses;
}
add_filter( 'display_post_states', 'vendido_display_status_label' );





























function custom_post_status_message() {
	global $post;
	if (get_post_status($post->ID) == 'preventa') {

		$output = '<div class="custom-post-status preventa">';
		$output .= '<span>Preventa</span>';
		$output .= '</div>';

		echo $output;

	} elseif (get_post_status($post->ID) == 'venta') {
		
		$output = '<div class="custom-post-status venta">';
		$output .= '<span>Venta</span>';
		$output .= '</div>';

		echo $output;

	} elseif (get_post_status($post->ID) == 'ultimas') {
		
		$output = '<div class="custom-post-status ultimas">';
		$output .= '<span>Últimas Casas</span>';
		$output .= '</div>';

		echo $output;

	} elseif (get_post_status($post->ID) == 'vendido') {
		
		$output = '<div class="custom-post-status vendido">';
		$output .= '<span>Vendido</span>';
		$output .= '</div>';

		echo $output;

	} else {
		//nothing
	}
}