<?php 
/*
 * template-ajax-results.php
 * This file should be created in the root of your theme directory
 */
?>

<?php if ( have_posts() ) : ?>

	<ul class="lista-alumnos">

	<?php $counter = 0; ?>

	<?php while ( have_posts() ) : the_post();

		$counter++; //$ms = str_pad($counter, 2, '0', STR_PAD_LEFT);

		$post_type = get_post_type_object($post->post_type); 

		// vars 
		$numero = get_the_ID();
		$alta = get_the_date('Y-m-d');
		$sexo = get_field('OFI-1-ASexo');
		$pais = get_field('OFI-1-APais');
		$estado = get_field('OFI-1-AEstado');
		$municipio = get_field('OFI-1-AMunicipio');
		$telefono1 = get_field('OFI-1-ATelefono1');
		$telefono2 = get_field('OFI-1-ATelefono2');
		$mama = get_field('OFI-1-ANombreDeMama');
		$email = get_field('OFI-1-AEmail');
		?>


		<?php/*<div class="divider wow fadeIn" data-wow-delay="100ms""></div>*/?>
		<li class="section wow fadeIn" data-wow-delay="<?php echo $counter*2; ?>0ms">
			<h5 class="no-margin"><?php the_title(); ?></h5>
			<small class="blue-grey-text">Número de Alumno: <?php echo $numero; ?> — Fecha de Alta: <?php echo $alta; ?></small>
			<div class="">

			</div>
			<a class="box-picture post-link" href="<?php the_permalink(); ?>" data-mfp-src="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>" data-effect="mfp-modal"><small>Cambios al Alumno</small></a><?php/* — 
			<a class="box-picture post-link" href="<?php the_permalink(); ?>" data-mfp-src="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>" data-effect="mfp-modal"><small>Imprimir Cuestionario y Registrar Costo de la Clase</small></a> — 
			<a class="box-picture post-link" href="<?php the_permalink(); ?>" data-mfp-src="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>" data-effect="mfp-modal"><small>Imprimir Diploma del Alumno</small></a>*/?>
		</li>


		<?php/*<div class="divider blue-grey lighten-4 wow fadeIn" data-wow-delay="100ms"></div>*/?>


	<?php endwhile; ?>

	</ul>

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
				}
			});
		});
	</script>

<?php else :

	echo '<p>No se encontraron resultados.</p>';

endif; 
wp_reset_query(); ?>