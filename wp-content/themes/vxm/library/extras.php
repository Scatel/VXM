<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Inkness
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function inkness_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
//add_filter( 'wp_page_menu_args', 'inkness_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function inkness_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'inkness_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function inkness_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
//add_filter( 'attachment_link', 'inkness_enhanced_image_navigation', 10, 2 );


/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function inkness_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'inkness' ), max( $paged, $page ) );

	return $title;
}
//add_filter( 'wp_title', 'inkness_wp_title', 10, 2 );


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function inkness_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on"><i class="fa fa-clock-o"> </i> %1$s</span> <span class="byline"> <i class="fa fa-user"> </i> %2$s</span>', 'inkness' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}




// Srtrip accets from string
function stripAccents($string) {

		$string = trim($string);

		$string = str_replace(
				array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
				array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
				$string
		);

		$string = str_replace(
				array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
				array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
				$string
		);

		$string = str_replace(
				array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
				array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
				$string
		);

		$string = str_replace(
				array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
				array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
				$string
		);

		$string = str_replace(
				array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
				array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
				$string
		);

		$string = str_replace(
				array('ñ', 'Ñ', 'ç', 'Ç'),
				array('n', 'N', 'c', 'C',),
				$string
		);

		//Esta parte se encarga de eliminar cualquier caracter extraño
		$string = str_replace(
				array("\\", "¨", "º", "-", "~",
						 "#", "@", "|", "!", "\"",
						 "·", "$", "%", "&", "/",
						 "(", ")", "?", "'", "¡",
						 "¿", "[", "^", "`", "]",
						 "+", "}", "{", "¨", "´",
						 ">", "< ", ";", ",", ":",
						 ".", " "),
				'',
				$string
		);

		return $string;
}




function plural( $amount, $singular = '', $plural = 's' ) {
    if ( $amount == 1 )
        return $singular;
    else
        return $plural;
}























function excerpt($limit) {

	$excerpt = explode(' ', get_the_excerpt(), $limit);

	if (count($excerpt)>=$limit) {

		array_pop($excerpt);

		$excerpt = implode(" ",$excerpt).'...';

	} else {

		$excerpt = implode(" ",$excerpt);

	}

	$excerpt = preg_replace('`[[^]]*]`','',$excerpt);

	return $excerpt;

}

function content($limit) {

	$content = explode(' ', get_the_content(), $limit);

	if (count($content)>=$limit) {

		array_pop($content);

		$content = implode(" ",$content).'...';

	} else {

		$content = implode(" ",$content);

	}

	$content = preg_replace('/[.+]/','', $content);

	$content = apply_filters('the_content', $content);

	$content = str_replace(']]>', ']]&gt;', $content);

	return $content;

}