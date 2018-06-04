<?php
/* Wordpress Advanced Search Forms */








// WPAS Ajax Students Search
function ajax_search_students() {

	$current_user = wp_get_current_user();

	$args = array();
	$args['wp_query'] = array(
		'post_type' => array(
			'alumnos'
		),
		'author' => $current_user->ID,
		'post_status' => 'publish',
		//'orderby' => 'date', 
		//'order' => 'ASC',
		//'posts_per_page' => -1 
	);

	$args['form'] = array(
		'auto_submit' => true,
		'class' => array('grid-bottom', 'form-no-margins'),
		'disable_wrappers' => false
	);

	//$args['debug'] = true;
	$args['debug_level'] = verbose;

	$args['form']['ajax'] = array(
		'enabled' => true,
		'show_default_results' => true,
		'results_template' => 'students-ajax-results.php',
		'button_text' => 'Cargar más'
	);

	$args['fields'][] = array(
		'pre_html' => '<div class="col col_sm-12">',
		'post_html' => '</div>',
		'type' => 'search',
		'placeholder' => 'Buscar alumnos',
		'label' => '<i class="material-icons">search</i>',
		'attributes' => array('ng-model' => 'searchquery')
	);

	/*$current_user = wp_get_current_user();

	$args['fields'][] = array(
		'pre_html' => '<div class="col">',
		'post_html' => '</div>',
		'type' => 'author',
		'format' => 'select',
		'label' => 'Mostrar',
		//'authors' => array(1,2),
		'default' => $current_user->ID
	);
	/*$args['fields'][] = array(
		'pre_html' => '',
		'post_html' => '',
		'class' => 'col',
		'type' => 'orderby',
		'format' => 'radio',
		'label' => 'Ordenar por',
		'orderby_values' => array(
			'date' => array(
				'label' => 'Últimos Agregados'
			),
			'rand' => array(
				'label' => 'Aleatoriamente'
			)
		),
		'default' => 'date'
		
	);
	$args['fields'][] = array(
		'pre_html' => '',
		'post_html' => '',
		'class' => 'col',
		'type' => 'meta_key',
		'meta_key' => 'materiales_peligrosos',
		'format' => 'checkbox',
		//'value' => 'Materiales Peligrosos',
		'values' => array(
			'1' => 'Materiales Peligrosos',
		),
		'compare' => 'LIKE',
		'data_type' => 'ARRAY<CHAR>'
	);*/
	
	$args['fields'][] = array(
		'pre_html' => '<div class="col-2_sm-6">',
		'post_html' => '</div>',
		'type' => 'submit',
		'class' => 'waves-effect waves-light btn-flat',
		'value' => 'Buscar',
		//'attributes' => array('ng-click' => 'reset()')
	);
	$args['fields'][] = array(
		'pre_html' => '<div class="col-2_sm-6">',
		'post_html' => '</div>',
		'type' => 'reset',
		'class' => 'waves-effect waves-light btn-flat',
		'value' => 'Limpiar',
		'attributes' => array('ng-click' => 'reset()')
	);

	register_wpas_form('ajaxform-students', $args);
}
add_action('init', 'ajax_search_students');























// WPAS Ajax Cursos Search
function ajax_search_cursos() {
	$args = array();
	$args['wp_query'] = array(
		'post_type' => array(
			'cursos'
		),
		'post_status' => 'publish',
		'orderby' => 'menu_order', 
		'order' => 'ASC',
		//'posts_per_page' => -1 
	);

	$args['form'] = array(
		'auto_submit' => true,
		'class' => array('grid', 'form-margin-top-bottom', 'form-no-margins'),
		'disable_wrappers' => false
	);

	//$args['debug'] = true;
	$args['debug_level'] = verbose;

	$args['form']['ajax'] = array(
		'enabled' => true,
		'show_default_results' => true,
		'results_template' => 'cursos-ajax-results.php',
		'button_text' => 'Cargar más'
	);

	/*$args['fields'][] = array(
		'pre_html' => '<div class="col-12">',
		'post_html' => '</div>',
		'type' => 'search',
		'placeholder' => 'Buscar cursos',
		'label' => '<i class="material-icons">search</i>',
		'attributes' => array('ng-model' => 'searchquery')
	);*/

	$args['fields'][] = array(
		'pre_html' => '<div class="col-12">',
		'post_html' => '</div></div>',
		//'class' => '',
		'format' => 'checkbox',
		'type' => 'taxonomy',
		'taxonomy' => 'location',
		'term_args' => array(
			'hide_empty' => true,
			//'hierarchical' => false,
			'orderby' => 'none',
			//'child_of' => '22'
		),
		'operator' => 'IN',
		'nested' => true,
		'label' => 'Elije una ubicación',
		//'attributes' => array('ng-model' => 'searchquery')
	);

	$args['fields'][] = array(
		'pre_html' => '<div class="col-12">',
		'post_html' => '</div></div>',
		//'class' => '',
		'format' => 'checkbox',
		'type' => 'taxonomy',
		'taxonomy' => 'tipo_de_curso',
		'term_args' => array(
			'hide_empty' => false,
			//'hierarchical' => false,
			'orderby' => 'none',
			//'child_of' => '22'
		),
		'operator' => 'IN',
		'nested' => true,
		'label' => 'Elije un tipo de Curso',
		//'attributes' => array('ng-model' => 'searchquery')
	);
	
	$args['fields'][] = array(
		'pre_html' => '<div class="col-12">',
		'post_html' => '</div>',
		'type' => 'submit',
		'class' => 'waves-effect waves-light btn',
		'value' => 'Buscar',
		//'attributes' => array('ng-click' => 'reset()')
	);
	$args['fields'][] = array(
		'pre_html' => '<div class="col-12">',
		'post_html' => '</div>',
		'type' => 'reset',
		'class' => 'waves-effect waves-light btn-flat',
		'value' => 'Limpiar',
		'attributes' => array('ng-click' => 'reset()')
	);

	register_wpas_form('ajaxform-cursos', $args);
}
add_action('init', 'ajax_search_cursos');














// WPAS Ajax Instructores VEO Search
function ajax_search_instructores() {
	$args = array();
	$args['wp_query'] = array(
		'post_type' => array(
			'aspirantes'
		),
		//'meta_key'		=> '_status',
		//'meta_value'	=> '10',
		//'meta_compare' => '=',
		'meta_query' => array(
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
			/*array(
				'key' => '_status',
				'value' => '30',
				'compare' => '='
			)*/
		),
		'post_status' => 'publish',
		//'orderby' => 'date', 
		//'order' => 'ASC',
		//'posts_per_page' => -1 
	);

	$args['form'] = array(
		'auto_submit' => true,
		'class' => array('grid', 'form-margin-top-bottom', 'form-no-margins'),
		'disable_wrappers' => false
	);

	//$args['debug'] = true;
	$args['debug_level'] = verbose;

	$args['form']['ajax'] = array(
		'enabled' => true,
		'show_default_results' => true,
		'results_template' => 'instructores-ajax-results.php',
		'button_text' => 'Cargar más'
	);

	$args['fields'][] = array(
		'pre_html' => '<div class="col-12">',
		'post_html' => '</div>',
		'type' => 'search',
		'placeholder' => 'Buscar instructores',
		'label' => '<i class="material-icons">search</i>',
		'attributes' => array('ng-model' => 'searchquery')
	);



	/*

	$args['fields'][] = array(
		'pre_html' => '<div class="col-12_sm-6">',
		'post_html' => '</div>',
		'class' => '',
		'type' => 'meta_key',
		'meta_key' => 'OFI-1-APais',
		'label' => 'País',
		"allow_null" => 'Elige un País:',
		'format' => 'select',
		//'values' => paises(),
		'compare' => 'LIKE',
		'data_type' => 'ARRAY<CHAR>'
	);










	// Municipios
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
	$mpioraw = array();
	foreach ($posts as $post) {
		$mpioraw[] = get_post_meta($post->ID, 'OFI-1-AMunicipio', true);
	}
	wp_reset_postdata();


	$mpios_arr = array();
	foreach ($mpioraw as $key => $value) {
		$valuef = str_replace(array('_', '(', ')'), ' ', $value);
		$mpios_arr[$value] = ucwords($valuef);
	}
	$mpios_arr_sorted = asort($mpios_arr);

	$args['fields'][] = array(
		'pre_html' => '<div class="col-12_sm-6">',
		'post_html' => '</div>',
		'class' => '',
		'type' => 'meta_key',
		'meta_key' => 'OFI-1-AMunicipio',
		'label' => 'Ciudad',
		"allow_null" => 'Elige una Ciudad:',
		'format' => 'select',
		//'values' => $mpios_arr,
		'compare' => 'LIKE',
		'data_type' => 'ARRAY<CHAR>'
	);

	*/

	/*$args['fields'][] = array(
		'pre_html' => '<div class="col-12">',
		'post_html' => '</div></div>',
		//'class' => '',
		'format' => 'checkbox',
		'type' => 'taxonomy',
		'taxonomy' => 'location',
		'term_args' => array(
			'hide_empty' => false,
			//'hierarchical' => false,
			'orderby' => 'none',
			//'child_of' => '22'
		),
		'operator' => 'IN',
		'nested' => true,
		'label' => 'Elije una ubicación',
		//'attributes' => array('ng-model' => 'searchquery')
	);*/
	
	$args['fields'][] = array(
		'pre_html' => '<div class="col-12_sm-3_xs-6">',
		'post_html' => '</div>',
		'type' => 'submit',
		'class' => 'waves-effect waves-light btn',
		'value' => 'Buscar',
		//'attributes' => array('ng-click' => 'reset()')
	);
	$args['fields'][] = array(
		'pre_html' => '<div class="col-12_sm-3_xs-6">',
		'post_html' => '</div>',
		'type' => 'reset',
		'class' => 'waves-effect waves-light btn-flat',
		'value' => 'Limpiar',
		'attributes' => array('ng-click' => 'reset()')
	);

	register_wpas_form('ajaxform-instructores', $args);
}
add_action('init', 'ajax_search_instructores');































// WPAS Ajax Instructores VEO Search OFC
function ajax_search_instructores_ofc() {

	$current_user = wp_get_current_user();

	$args = array();
	$args['wp_query'] = array(
		'post_type' => array(
			'aspirantes'
		),
		'author' => $current_user->ID,
		'post_status' => 'publish',
		//'orderby' => 'date',
		//'order' => 'ASC',
		//'posts_per_page' => -1 
	);

	$args['form'] = array(
		'auto_submit' => true,
		'class' => array('grid-bottom', 'form-no-margins'),
		'disable_wrappers' => false
	);

	//$args['debug'] = true;
	$args['debug_level'] = verbose;

	$args['form']['ajax'] = array(
		'enabled' => true,
		'show_default_results' => true,
		'results_template' => 'instructores-ajax-results-admin.php',
		'button_text' => 'Cargar más'
	);

	$args['fields'][] = array(
		'pre_html' => '<div class="col col_sm-12">',
		'post_html' => '</div>',
		'type' => 'search',
		'placeholder' => 'Buscar instructores',
		'label' => '<i class="material-icons">search</i>',
		'attributes' => array('ng-model' => 'searchquery')
	);
	
	$args['fields'][] = array(
		'pre_html' => '<div class="col-2_sm-6">',
		'post_html' => '</div>',
		'type' => 'submit',
		'class' => 'waves-effect waves-light btn-flat',
		'value' => 'Buscar',
		//'attributes' => array('ng-click' => 'reset()')
	);
	$args['fields'][] = array(
		'pre_html' => '<div class="col-2_sm-6">',
		'post_html' => '</div>',
		'type' => 'reset',
		'class' => 'waves-effect waves-light btn-flat',
		'value' => 'Limpiar',
		'attributes' => array('ng-click' => 'reset()')
	);

	register_wpas_form('ajaxform-instructores_ofc', $args);
}
add_action('init', 'ajax_search_instructores_ofc');










?>