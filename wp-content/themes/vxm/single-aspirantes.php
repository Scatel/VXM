<?php
	$user = wp_get_current_user(); $userid = $user->ID;
	$allowed_roles = array('administrator', 'admin');
?>

<article id="single-post" class="white-popup mfp-with-anim post-<?php the_ID(); ?>">

		<?php while (have_posts()) : the_post(); ?>

			<h1 class="h5 no-margin hide"><?php the_title(); ?></h1>
			<h2 class="h6 no-margin">Modificar Datos</h2>

			<div class="section"><div class="divider"></div></div>

			<?php
				if( array_intersect($allowed_roles, $user->roles ) ) {
					// $args = array(
					// 		'post_id'      => get_the_ID(),
					// 		'new_post'     => array(
					// 			'post_type'    => 'aspirantes',
					// 			'post_status'  => 'publish'
					// 		),
					// 		'field_groups' => array('group_58083233c61be', 'group_58082fc615096', 'group_5a8b05de05701', 'group_5a8bdc3c1366a','group_5b16f7026f5d8', 'group_5a8ddba34185f'),
					// 		'html_before_fields' => '<div class="grid-bottom">',
					// 		'html_after_fields' => '</div>',
					// 		'return' =>  get_the_permalink($_GET['redirect_id']),
					// 		'updated_message' => __("Post updated", 'acf'),
					// 		'submit_value' => __("Grabar Cambios", 'bonestheme')
					// 	);

					acf_form(array(
						'post_id'      => get_the_ID(),
						'new_post'     => array(
							'post_type'    => 'aspirantes',
							'post_status'  => 'publish'
						),
						'field_groups'	=>	array(
							'group_58082fc615096', // datos personales y contacto
							'group_58083233c61be', // datos de aspirantes 
							'group_5a2ebc1e3f068', // numero de instructor veo
							'group_5b16f7026f5d8', // inicio de anualidad
							'group_5b16f2ed36963', // password inicial
							'group_5b46854b34e04', // privacidad
							'group_5b490ae27dc08',
							'group_5b4631ac7abc9'  // comentarios sobre el aspirante
						),
						'html_before_fields' => '<div class="grid-bottom">',
						'html_after_fields' => '</div>',
						'return' =>  get_the_permalink($_GET['redirect_id']),
						'updated_message' => __("Post updated", 'acf'),
						'submit_value' => __("Grabar Cambios", 'bonestheme')
					)); 
						
				} else {
					// $args = array(
					// 		'post_id'      => get_the_ID(),
					// 		'new_post'     => array(
					// 			'post_type'    => 'aspirantes',
					// 			'post_status'  => 'publish'
					// 		),
					// 		'field_groups' => array('group_58083233c61be', 'group_58082fc615096', 'group_5a8b05de05701','group_5b16f7026f5d8', 'group_5a8ddba34185f'),
					// 		'html_before_fields' => '<div class="grid-bottom">',
					// 		'html_after_fields' => '</div>',
					// 		'return' =>  get_the_permalink($_GET['redirect_id']),
					// 		'updated_message' => __("Post updated", 'acf'),
					// 		'submit_value' => __("Grabar Cambios", 'bonestheme')
					// 	);

					acf_form(array(
						'post_id'      => get_the_ID(),
						'new_post'     => array(
							'post_type'    => 'aspirantes',
							'post_status'  => 'publish'
						),
						'field_groups'	=>	array(
							'group_58082fc615096', // datos personales y contacto
							'group_58083233c61be', // datos de aspirantes 
							'group_5a2ebc1e3f068', // numero de instructor veo
							// 'group_5b16f7026f5d8', // inicio de anualidad
							// 'group_5b16f2ed36963', // password inicial
							'group_5b46854b34e04', // privacidad
							'group_5b490ae27dc08',
							'group_5b4631ac7abc9'  // comentarios sobre el aspirante
						),
						'html_before_fields' => '<div class="grid-bottom">',
						'html_after_fields' => '</div>',
						'return' =>  get_the_permalink($_GET['redirect_id']),
						'updated_message' => __("Post updated", 'acf'),
						'submit_value' => __("Grabar Cambios", 'bonestheme')
					)); 
				}
			?>



			<?php acf_form($args); ?>

			<footer>
			</footer>

		<?php endwhile;?>

	</article>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('select').material_select();
		});
	</script>