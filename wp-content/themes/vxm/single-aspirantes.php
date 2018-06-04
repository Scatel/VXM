	<article id="single-post" class="white-popup mfp-with-anim post-<?php the_ID(); ?>">

		<?php while (have_posts()) : the_post(); ?>

			<h1 class="h5 no-margin hide"><?php the_title(); ?></h1>
			<h2 class="h6 no-margin">Modificar Datos</h2>

			<div class="section"><div class="divider"></div></div>

			<?php acf_form(array(
				'post_id'      => get_the_ID(),
				'new_post'     => array(
					'post_type'    => 'aspirantes',
					'post_status'  => 'publish'
				),

				// 'group_58083233c61be', 'group_58082fc615096', 'group_5a8b05de05701', 'group_5a8ddba34185f'
				// field_5a8bdc3f3e036
				
				'field_groups' => array('group_58083233c61be', 'group_58082fc615096', 'group_5a8b05de05701', 'group_5a8bdc3c1366a', 'group_5a8ddba34185f'),
				'html_before_fields' => '<div class="grid-bottom">',
				'html_after_fields' => '</div>',
				'return' =>  get_the_permalink($_GET['redirect_id']),
				'updated_message' => __("Post updated", 'acf'),
				'submit_value' => __("Grabar Cambios", 'bonestheme')
			)); ?>

			<footer>
			</footer>

		<?php endwhile;?>

	</article>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('select').material_select();
		});
	</script>