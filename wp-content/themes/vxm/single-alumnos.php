<?php //acf_form_head(); ?>
<?php //get_header(); ?>

<?php $user = wp_get_current_user(); $userid = $user->ID; ?>

<?php $post = get_post($_POST['id']); ?>

<?php //if($userid != $post->post_author) : echo 'no puedes acceder directamente'; exit; endif; ?>

	<article id="single-post" class="white-popup mfp-with-anim post-<?php the_ID(); ?>">

		<?php while (have_posts()) : the_post(); ?>

			<h1 class="h5 no-margin hide"><?php the_title(); ?></h1>
			<h2 class="h6 no-margin">Cambios a Alumnos</h2>

			<div class="section"><div class="divider"></div></div>

			<?php acf_form(array(
				'post_id'      => get_the_ID(),
				'new_post'     => array(
					'post_type'    => 'alumnos',
					'post_status'  => 'publish'
				),
				'html_before_fields' => '<div class="grid">',
				'html_after_fields' => '</div>',
				'return' => get_the_permalink($_GET['redirect_id']),
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


<?php //get_footer(); ?>