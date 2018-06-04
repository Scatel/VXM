<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}















// Register Custom Post Type
function alumnos_post_type() {

	$labels = array(
		'name'                  => _x( 'Alumnos', 'Post Type General Name', 'bonestheme' ),
		'singular_name'         => _x( 'Alumno', 'Post Type Singular Name', 'bonestheme' ),
		'menu_name'             => __( 'Alumnos', 'bonestheme' ),
		'name_admin_bar'        => __( 'Alumnos', 'bonestheme' ),
		'archives'              => __( 'Item Archives', 'bonestheme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bonestheme' ),
		'all_items'             => __( 'Todos los Alumnos', 'bonestheme' ),
		'add_new_item'          => __( 'Añadir Nuevo Alumno', 'bonestheme' ),
		'add_new'               => __( 'Añadir Nuevo', 'bonestheme' ),
		'new_item'              => __( 'Nuevo Alumno', 'bonestheme' ),
		'edit_item'             => __( 'Editar Alumno', 'bonestheme' ),
		'update_item'           => __( 'Actualizar Alumno', 'bonestheme' ),
		'view_item'             => __( 'Ver Alumno', 'bonestheme' ),
		'search_items'          => __( 'Buscar Alumno', 'bonestheme' ),
		'not_found'             => __( 'No se encontró', 'bonestheme' ),
		'not_found_in_trash'    => __( 'No se encontró en la Papelera', 'bonestheme' ),
		'featured_image'        => __( 'Imágen de Perfil', 'bonestheme' ),
		'set_featured_image'    => __( 'Asignar imágen de perfil', 'bonestheme' ),
		'remove_featured_image' => __( 'Eliminar imágen de perfil', 'bonestheme' ),
		'use_featured_image'    => __( 'Usar como imágen de perfil', 'bonestheme' ),
		'insert_into_item'      => __( 'Insertar en el elemento', 'bonestheme' ),
		'uploaded_to_this_item' => __( 'Subido a este elemento', 'bonestheme' ),
		'items_list'            => __( 'Lista de elemnetos', 'bonestheme' ),
		'items_list_navigation' => __( 'Lista de elementos de navegación', 'bonestheme' ),
		'filter_items_list'     => __( 'Filtrar elementos', 'bonestheme' ),
	);
	$args = array(
		'label'                 => __( 'Alumno', 'bonestheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'revisions', 'author'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-universal-access',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'alumnos', $args );

}
add_action( 'init', 'alumnos_post_type', 0 );






















// Register Custom Post Type
function aspirantes_post_type() {

	$labels = array(
		'name'                  => _x( 'Aspirantes', 'Post Type General Name', 'bonestheme' ),
		'singular_name'         => _x( 'Aspirante', 'Post Type Singular Name', 'bonestheme' ),
		'menu_name'             => __( 'Aspirantes', 'bonestheme' ),
		'name_admin_bar'        => __( 'Aspirantes', 'bonestheme' ),
		'archives'              => __( 'Item Archives', 'bonestheme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bonestheme' ),
		'all_items'             => __( 'All Items', 'bonestheme' ),
		'add_new_item'          => __( 'Add New Item', 'bonestheme' ),
		'add_new'               => __( 'Add New', 'bonestheme' ),
		'new_item'              => __( 'New Item', 'bonestheme' ),
		'edit_item'             => __( 'Edit Item', 'bonestheme' ),
		'update_item'           => __( 'Update Item', 'bonestheme' ),
		'view_item'             => __( 'View Item', 'bonestheme' ),
		'search_items'          => __( 'Search Item', 'bonestheme' ),
		'not_found'             => __( 'Not found', 'bonestheme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bonestheme' ),
		'featured_image'        => __( 'Featured Image', 'bonestheme' ),
		'set_featured_image'    => __( 'Set featured image', 'bonestheme' ),
		'remove_featured_image' => __( 'Remove featured image', 'bonestheme' ),
		'use_featured_image'    => __( 'Use as featured image', 'bonestheme' ),
		'insert_into_item'      => __( 'Insert into item', 'bonestheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bonestheme' ),
		'items_list'            => __( 'Items list', 'bonestheme' ),
		'items_list_navigation' => __( 'Items list navigation', 'bonestheme' ),
		'filter_items_list'     => __( 'Filter items list', 'bonestheme' ),
	);
	$args = array(
		'label'                 => __( 'Aspirante', 'bonestheme' ),
		'description'           => __( 'Post Type Description', 'bonestheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'author'),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-money',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'aspirantes', $args );

}
add_action( 'init', 'aspirantes_post_type', 0 );








// Register Cursos Post Type
function cursos_post_type() {

	$labels = array(
		'name'                  => _x( 'Cursos', 'Post Type General Name', 'bonestheme' ),
		'singular_name'         => _x( 'Curso', 'Post Type Singular Name', 'bonestheme' ),
		'menu_name'             => __( 'Cursos', 'bonestheme' ),
		'name_admin_bar'        => __( 'Cursos', 'bonestheme' ),
		'archives'              => __( 'Item Archives', 'bonestheme' ),
		'attributes'            => __( 'Item Attributes', 'bonestheme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bonestheme' ),
		'all_items'             => __( 'All Items', 'bonestheme' ),
		'add_new_item'          => __( 'Add New Item', 'bonestheme' ),
		'add_new'               => __( 'Add New', 'bonestheme' ),
		'new_item'              => __( 'New Item', 'bonestheme' ),
		'edit_item'             => __( 'Edit Item', 'bonestheme' ),
		'update_item'           => __( 'Update Item', 'bonestheme' ),
		'view_item'             => __( 'View Item', 'bonestheme' ),
		'view_items'            => __( 'View Items', 'bonestheme' ),
		'search_items'          => __( 'Search Item', 'bonestheme' ),
		'not_found'             => __( 'Not found', 'bonestheme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bonestheme' ),
		'featured_image'        => __( 'Featured Image', 'bonestheme' ),
		'set_featured_image'    => __( 'Set featured image', 'bonestheme' ),
		'remove_featured_image' => __( 'Remove featured image', 'bonestheme' ),
		'use_featured_image'    => __( 'Use as featured image', 'bonestheme' ),
		'insert_into_item'      => __( 'Insert into item', 'bonestheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bonestheme' ),
		'items_list'            => __( 'Items list', 'bonestheme' ),
		'items_list_navigation' => __( 'Items list navigation', 'bonestheme' ),
		'filter_items_list'     => __( 'Filter items list', 'bonestheme' ),
	);
	$args = array(
		'label'                 => __( 'Curso', 'bonestheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-clipboard',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'cursos', $args );

}
add_action( 'init', 'cursos_post_type', 0 );


// Register Course Locations Taxonomy
function course_location_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Ubicaciones', 'Taxonomy General Name', 'bonestheme' ),
		'singular_name'              => _x( 'Ubicacion', 'Taxonomy Singular Name', 'bonestheme' ),
		'menu_name'                  => __( 'Locations', 'bonestheme' ),
		'all_items'                  => __( 'All Items', 'bonestheme' ),
		'parent_item'                => __( 'Parent Item', 'bonestheme' ),
		'parent_item_colon'          => __( 'Parent Item:', 'bonestheme' ),
		'new_item_name'              => __( 'New Item Name', 'bonestheme' ),
		'add_new_item'               => __( 'Add New Item', 'bonestheme' ),
		'edit_item'                  => __( 'Edit Item', 'bonestheme' ),
		'update_item'                => __( 'Update Item', 'bonestheme' ),
		'view_item'                  => __( 'View Item', 'bonestheme' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'bonestheme' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'bonestheme' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'bonestheme' ),
		'popular_items'              => __( 'Popular Items', 'bonestheme' ),
		'search_items'               => __( 'Search Items', 'bonestheme' ),
		'not_found'                  => __( 'Not Found', 'bonestheme' ),
		'no_terms'                   => __( 'No items', 'bonestheme' ),
		'items_list'                 => __( 'Items list', 'bonestheme' ),
		'items_list_navigation'      => __( 'Items list navigation', 'bonestheme' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'location', array( 'cursos' ), $args );

}
add_action( 'init', 'course_location_taxonomy', 0 );





// Register Tipos de Cursos Custom Taxonomy

function course_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Types', 'Taxonomy General Name', 'bonestheme' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'bonestheme' ),
		'menu_name'                  => __( 'Course Type', 'bonestheme' ),
		'all_items'                  => __( 'All Items', 'bonestheme' ),
		'parent_item'                => __( 'Parent Item', 'bonestheme' ),
		'parent_item_colon'          => __( 'Parent Item:', 'bonestheme' ),
		'new_item_name'              => __( 'New Item Name', 'bonestheme' ),
		'add_new_item'               => __( 'Add New Item', 'bonestheme' ),
		'edit_item'                  => __( 'Edit Item', 'bonestheme' ),
		'update_item'                => __( 'Update Item', 'bonestheme' ),
		'view_item'                  => __( 'View Item', 'bonestheme' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'bonestheme' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'bonestheme' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'bonestheme' ),
		'popular_items'              => __( 'Popular Items', 'bonestheme' ),
		'search_items'               => __( 'Search Items', 'bonestheme' ),
		'not_found'                  => __( 'Not Found', 'bonestheme' ),
		'no_terms'                   => __( 'No items', 'bonestheme' ),
		'items_list'                 => __( 'Items list', 'bonestheme' ),
		'items_list_navigation'      => __( 'Items list navigation', 'bonestheme' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'tipo_de_curso', array( 'cursos' ), $args );

}
add_action( 'init', 'course_custom_taxonomy', 0 );






// register Cursos Dirigido a Custom Taxonomy
function dirigido_a_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Intended for', 'Taxonomy General Name', 'bonestheme' ),
		'singular_name'              => _x( 'Intended for', 'Taxonomy Singular Name', 'bonestheme' ),
		'menu_name'                  => __( 'Intended for', 'bonestheme' ),
		'all_items'                  => __( 'All Items', 'bonestheme' ),
		'parent_item'                => __( 'Parent Item', 'bonestheme' ),
		'parent_item_colon'          => __( 'Parent Item:', 'bonestheme' ),
		'new_item_name'              => __( 'New Item Name', 'bonestheme' ),
		'add_new_item'               => __( 'Add New Item', 'bonestheme' ),
		'edit_item'                  => __( 'Edit Item', 'bonestheme' ),
		'update_item'                => __( 'Update Item', 'bonestheme' ),
		'view_item'                  => __( 'View Item', 'bonestheme' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'bonestheme' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'bonestheme' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'bonestheme' ),
		'popular_items'              => __( 'Popular Items', 'bonestheme' ),
		'search_items'               => __( 'Search Items', 'bonestheme' ),
		'not_found'                  => __( 'Not Found', 'bonestheme' ),
		'no_terms'                   => __( 'No items', 'bonestheme' ),
		'items_list'                 => __( 'Items list', 'bonestheme' ),
		'items_list_navigation'      => __( 'Items list navigation', 'bonestheme' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'dirigido-a', array( 'cursos' ), $args );

}
add_action( 'init', 'dirigido_a_custom_taxonomy', 0 );
































// Register Custom Post Type
function testimonios_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Testimonios', 'Post Type General Name', 'bonestheme' ),
		'singular_name'         => _x( 'Testimonio', 'Post Type Singular Name', 'bonestheme' ),
		'menu_name'             => __( 'Testimonios', 'bonestheme' ),
		'name_admin_bar'        => __( 'Testimonio', 'bonestheme' ),
		'archives'              => __( 'Item Archives', 'bonestheme' ),
		'attributes'            => __( 'Item Attributes', 'bonestheme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bonestheme' ),
		'all_items'             => __( 'All Items', 'bonestheme' ),
		'add_new_item'          => __( 'Add New Item', 'bonestheme' ),
		'add_new'               => __( 'Add New', 'bonestheme' ),
		'new_item'              => __( 'New Item', 'bonestheme' ),
		'edit_item'             => __( 'Edit Item', 'bonestheme' ),
		'update_item'           => __( 'Update Item', 'bonestheme' ),
		'view_item'             => __( 'View Item', 'bonestheme' ),
		'view_items'            => __( 'View Items', 'bonestheme' ),
		'search_items'          => __( 'Search Item', 'bonestheme' ),
		'not_found'             => __( 'Not found', 'bonestheme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bonestheme' ),
		'featured_image'        => __( 'Featured Image', 'bonestheme' ),
		'set_featured_image'    => __( 'Set featured image', 'bonestheme' ),
		'remove_featured_image' => __( 'Remove featured image', 'bonestheme' ),
		'use_featured_image'    => __( 'Use as featured image', 'bonestheme' ),
		'insert_into_item'      => __( 'Insert into item', 'bonestheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bonestheme' ),
		'items_list'            => __( 'Items list', 'bonestheme' ),
		'items_list_navigation' => __( 'Items list navigation', 'bonestheme' ),
		'filter_items_list'     => __( 'Filter items list', 'bonestheme' ),
	);
	$args = array(
		'label'                 => __( 'Testimonio', 'bonestheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'testimonios', $args );

}
add_action( 'init', 'testimonios_custom_post_type', 0 );






// Register Custom Post Type
function faqs_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'FAQs', 'Post Type General Name', 'bonestheme' ),
		'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'bonestheme' ),
		'menu_name'             => __( 'Preguntas Frecuentes', 'bonestheme' ),
		'name_admin_bar'        => __( 'Preguntas Frecuentes', 'bonestheme' ),
		'archives'              => __( 'Item Archives', 'bonestheme' ),
		'attributes'            => __( 'Item Attributes', 'bonestheme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bonestheme' ),
		'all_items'             => __( 'All Items', 'bonestheme' ),
		'add_new_item'          => __( 'Add New Item', 'bonestheme' ),
		'add_new'               => __( 'Add New', 'bonestheme' ),
		'new_item'              => __( 'New Item', 'bonestheme' ),
		'edit_item'             => __( 'Edit Item', 'bonestheme' ),
		'update_item'           => __( 'Update Item', 'bonestheme' ),
		'view_item'             => __( 'View Item', 'bonestheme' ),
		'view_items'            => __( 'View Items', 'bonestheme' ),
		'search_items'          => __( 'Search Item', 'bonestheme' ),
		'not_found'             => __( 'Not found', 'bonestheme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bonestheme' ),
		'featured_image'        => __( 'Featured Image', 'bonestheme' ),
		'set_featured_image'    => __( 'Set featured image', 'bonestheme' ),
		'remove_featured_image' => __( 'Remove featured image', 'bonestheme' ),
		'use_featured_image'    => __( 'Use as featured image', 'bonestheme' ),
		'insert_into_item'      => __( 'Insert into item', 'bonestheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bonestheme' ),
		'items_list'            => __( 'Items list', 'bonestheme' ),
		'items_list_navigation' => __( 'Items list navigation', 'bonestheme' ),
		'filter_items_list'     => __( 'Filter items list', 'bonestheme' ),
	);
	$args = array(
		'label'                 => __( 'Preguntas Frecuentes', 'bonestheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
	);
	register_post_type( 'faqs', $args );

}
add_action( 'init', 'faqs_custom_post_type', 0 );






// Register Custom Post Type
function faqs_category_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'FAQs Categories', 'Post Type General Name', 'bonestheme' ),
		'singular_name'         => _x( 'FAQ Category', 'Post Type Singular Name', 'bonestheme' ),
		'menu_name'             => __( 'Preguntas Frecuentes Categorias', 'bonestheme' ),
		'name_admin_bar'        => __( 'Preguntas Frecuentes Categorias', 'bonestheme' ),
		'archives'              => __( 'Item Archives', 'bonestheme' ),
		'attributes'            => __( 'Item Attributes', 'bonestheme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bonestheme' ),
		'all_items'             => __( 'All Items', 'bonestheme' ),
		'add_new_item'          => __( 'Add New Item', 'bonestheme' ),
		'add_new'               => __( 'Add New', 'bonestheme' ),
		'new_item'              => __( 'New Item', 'bonestheme' ),
		'edit_item'             => __( 'Edit Item', 'bonestheme' ),
		'update_item'           => __( 'Update Item', 'bonestheme' ),
		'view_item'             => __( 'View Item', 'bonestheme' ),
		'view_items'            => __( 'View Items', 'bonestheme' ),
		'search_items'          => __( 'Search Item', 'bonestheme' ),
		'not_found'             => __( 'Not found', 'bonestheme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bonestheme' ),
		'featured_image'        => __( 'Featured Image', 'bonestheme' ),
		'set_featured_image'    => __( 'Set featured image', 'bonestheme' ),
		'remove_featured_image' => __( 'Remove featured image', 'bonestheme' ),
		'use_featured_image'    => __( 'Use as featured image', 'bonestheme' ),
		'insert_into_item'      => __( 'Insert into item', 'bonestheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bonestheme' ),
		'items_list'            => __( 'Items list', 'bonestheme' ),
		'items_list_navigation' => __( 'Items list navigation', 'bonestheme' ),
		'filter_items_list'     => __( 'Filter items list', 'bonestheme' ),
	);
	$args = array(
		'label'                 => __( 'Categorias de Preguntas Frecuentes', 'bonestheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
	);
	register_post_type( 'faq_category_input', $args );

}
add_action( 'init', 'faqs_category_custom_post_type', 0 );










// Register Custom Post Type
function faqs_instructores_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'FAQs Instructores', 'Post Type General Name', 'bonestheme' ),
		'singular_name'         => _x( 'FAQ Instructores', 'Post Type Singular Name', 'bonestheme' ),
		'menu_name'             => __( 'Preguntas Frecuentes Instructores', 'bonestheme' ),
		'name_admin_bar'        => __( 'Preguntas Frecuentes Instructores', 'bonestheme' ),
		'archives'              => __( 'Item Archives', 'bonestheme' ),
		'attributes'            => __( 'Item Attributes', 'bonestheme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bonestheme' ),
		'all_items'             => __( 'All Items', 'bonestheme' ),
		'add_new_item'          => __( 'Add New Item', 'bonestheme' ),
		'add_new'               => __( 'Add New', 'bonestheme' ),
		'new_item'              => __( 'New Item', 'bonestheme' ),
		'edit_item'             => __( 'Edit Item', 'bonestheme' ),
		'update_item'           => __( 'Update Item', 'bonestheme' ),
		'view_item'             => __( 'View Item', 'bonestheme' ),
		'view_items'            => __( 'View Items', 'bonestheme' ),
		'search_items'          => __( 'Search Item', 'bonestheme' ),
		'not_found'             => __( 'Not found', 'bonestheme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bonestheme' ),
		'featured_image'        => __( 'Featured Image', 'bonestheme' ),
		'set_featured_image'    => __( 'Set featured image', 'bonestheme' ),
		'remove_featured_image' => __( 'Remove featured image', 'bonestheme' ),
		'use_featured_image'    => __( 'Use as featured image', 'bonestheme' ),
		'insert_into_item'      => __( 'Insert into item', 'bonestheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bonestheme' ),
		'items_list'            => __( 'Items list', 'bonestheme' ),
		'items_list_navigation' => __( 'Items list navigation', 'bonestheme' ),
		'filter_items_list'     => __( 'Filter items list', 'bonestheme' ),
	);
	$args = array(
		'label'                 => __( 'Preguntas Frecuentes Instructores', 'bonestheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
	);
	register_post_type( 'faqs_instructores', $args );

}
add_action( 'init', 'faqs_instructores_custom_post_type', 0 );












// Register Custom Post Type
function faqs_certificadores_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'FAQs Certificadores', 'Post Type General Name', 'bonestheme' ),
		'singular_name'         => _x( 'FAQ Certificadores', 'Post Type Singular Name', 'bonestheme' ),
		'menu_name'             => __( 'Preguntas Frecuentes Certificadores', 'bonestheme' ),
		'name_admin_bar'        => __( 'Preguntas Frecuentes Certificadores', 'bonestheme' ),
		'archives'              => __( 'Item Archives', 'bonestheme' ),
		'attributes'            => __( 'Item Attributes', 'bonestheme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bonestheme' ),
		'all_items'             => __( 'All Items', 'bonestheme' ),
		'add_new_item'          => __( 'Add New Item', 'bonestheme' ),
		'add_new'               => __( 'Add New', 'bonestheme' ),
		'new_item'              => __( 'New Item', 'bonestheme' ),
		'edit_item'             => __( 'Edit Item', 'bonestheme' ),
		'update_item'           => __( 'Update Item', 'bonestheme' ),
		'view_item'             => __( 'View Item', 'bonestheme' ),
		'view_items'            => __( 'View Items', 'bonestheme' ),
		'search_items'          => __( 'Search Item', 'bonestheme' ),
		'not_found'             => __( 'Not found', 'bonestheme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bonestheme' ),
		'featured_image'        => __( 'Featured Image', 'bonestheme' ),
		'set_featured_image'    => __( 'Set featured image', 'bonestheme' ),
		'remove_featured_image' => __( 'Remove featured image', 'bonestheme' ),
		'use_featured_image'    => __( 'Use as featured image', 'bonestheme' ),
		'insert_into_item'      => __( 'Insert into item', 'bonestheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bonestheme' ),
		'items_list'            => __( 'Items list', 'bonestheme' ),
		'items_list_navigation' => __( 'Items list navigation', 'bonestheme' ),
		'filter_items_list'     => __( 'Filter items list', 'bonestheme' ),
	);
	$args = array(
		'label'                 => __( 'Preguntas Frecuentes Certificadores', 'bonestheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
	);
	register_post_type( 'faqs_certificadores', $args );

}
add_action( 'init', 'faqs_certificadores_custom_post_type', 0 );






// Register Custom Post Type
function manual_instructores_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Manual Instructores', 'Post Type General Name', 'bonestheme' ),
		'singular_name'         => _x( 'Manual Instructores', 'Post Type Singular Name', 'bonestheme' ),
		'menu_name'             => __( 'Manual Instructores', 'bonestheme' ),
		'name_admin_bar'        => __( 'Manual Frecuentes Instructores', 'bonestheme' ),
		'archives'              => __( 'Item Archives', 'bonestheme' ),
		'attributes'            => __( 'Item Attributes', 'bonestheme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bonestheme' ),
		'all_items'             => __( 'All Items', 'bonestheme' ),
		'add_new_item'          => __( 'Add New Item', 'bonestheme' ),
		'add_new'               => __( 'Add New', 'bonestheme' ),
		'new_item'              => __( 'New Item', 'bonestheme' ),
		'edit_item'             => __( 'Edit Item', 'bonestheme' ),
		'update_item'           => __( 'Update Item', 'bonestheme' ),
		'view_item'             => __( 'View Item', 'bonestheme' ),
		'view_items'            => __( 'View Items', 'bonestheme' ),
		'search_items'          => __( 'Search Item', 'bonestheme' ),
		'not_found'             => __( 'Not found', 'bonestheme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bonestheme' ),
		'featured_image'        => __( 'Featured Image', 'bonestheme' ),
		'set_featured_image'    => __( 'Set featured image', 'bonestheme' ),
		'remove_featured_image' => __( 'Remove featured image', 'bonestheme' ),
		'use_featured_image'    => __( 'Use as featured image', 'bonestheme' ),
		'insert_into_item'      => __( 'Insert into item', 'bonestheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bonestheme' ),
		'items_list'            => __( 'Items list', 'bonestheme' ),
		'items_list_navigation' => __( 'Items list navigation', 'bonestheme' ),
		'filter_items_list'     => __( 'Filter items list', 'bonestheme' ),
	);
	$args = array(
		'label'                 => __( 'Manual Instructores', 'bonestheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
	);
	register_post_type( 'manual_instructores', $args );

}
add_action( 'init', 'manual_instructores_custom_post_type', 0 );




// Register Custom Post Type
function manual_certificadores_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Manual Certificadores', 'Post Type General Name', 'bonestheme' ),
		'singular_name'         => _x( 'Manual Certificadores', 'Post Type Singular Name', 'bonestheme' ),
		'menu_name'             => __( 'Manual Certificadores', 'bonestheme' ),
		'name_admin_bar'        => __( 'Manual Frecuentes Certificadores', 'bonestheme' ),
		'archives'              => __( 'Item Archives', 'bonestheme' ),
		'attributes'            => __( 'Item Attributes', 'bonestheme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bonestheme' ),
		'all_items'             => __( 'All Items', 'bonestheme' ),
		'add_new_item'          => __( 'Add New Item', 'bonestheme' ),
		'add_new'               => __( 'Add New', 'bonestheme' ),
		'new_item'              => __( 'New Item', 'bonestheme' ),
		'edit_item'             => __( 'Edit Item', 'bonestheme' ),
		'update_item'           => __( 'Update Item', 'bonestheme' ),
		'view_item'             => __( 'View Item', 'bonestheme' ),
		'view_items'            => __( 'View Items', 'bonestheme' ),
		'search_items'          => __( 'Search Item', 'bonestheme' ),
		'not_found'             => __( 'Not found', 'bonestheme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bonestheme' ),
		'featured_image'        => __( 'Featured Image', 'bonestheme' ),
		'set_featured_image'    => __( 'Set featured image', 'bonestheme' ),
		'remove_featured_image' => __( 'Remove featured image', 'bonestheme' ),
		'use_featured_image'    => __( 'Use as featured image', 'bonestheme' ),
		'insert_into_item'      => __( 'Insert into item', 'bonestheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bonestheme' ),
		'items_list'            => __( 'Items list', 'bonestheme' ),
		'items_list_navigation' => __( 'Items list navigation', 'bonestheme' ),
		'filter_items_list'     => __( 'Filter items list', 'bonestheme' ),
	);
	$args = array(
		'label'                 => __( 'Manual Certificadores', 'bonestheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
	);
	register_post_type( 'manual_certificadores', $args );

}
add_action( 'init', 'manual_certificadores_custom_post_type', 0 );




?>
