<?php 
/*
 * template-ajax-results.php
 * This file should be created in the root of your theme directory
 */
?>

<?php if ( have_posts() ) : ?>

	<ul class="lista-cursos-ajax">

	<?php $counter = 0; ?>

	<?php while ( have_posts() ) : the_post();

		$counter++; //$ms = str_pad($counter, 2, '0', STR_PAD_LEFT);

		$post_type = get_post_type_object($post->post_type); 

		// vars 
		$descripcion_del_curso = get_field('descripcion_del_curso');

		$terms = get_the_terms( $post->ID, 'tipo_de_curso' );
		if($terms !=null) {
			foreach ($terms as $term) {
				$taxclass = $term->slug;
				unset($term);
			}
		}
		?>


		<div class="divider wow fadeIn" data-wow-delay="100ms"></div>
		<li class="section wow fadeIn <?php echo $taxclass; ?>" data-wow-delay="<?php echo $counter*2; ?>0ms">

			<img src="<?php echo libraryUrl(); ?>/img/<?php echo $taxclass; ?>.svg" class="taxclass" alt="img12">

			<h5 class="no-margin"><?php the_title(); ?></h5>
			<?php/*<small class="blue-grey-text">Número de Alumno: <?php echo $numero; ?> — Fecha de Alta: <?php echo $alta; ?></small>*/?>
			<div class="">
				<p><?php echo cortarTexto(strip_tags($descripcion_del_curso), 180); ?></p>
			</div>
			<?php /* if(have_rows('fechas_cursos')) {
				while(have_rows('fechas_cursos')) {
					the_row();

					$fecha = get_sub_field('fecha_del_curso');
					$ubicacion_id = get_sub_field('ubicacion_del_curso');
					$ubicacion = get_term( $ubicacion_id, 'location');

					echo $fecha.$ubicacion->name;

					echo '<p>'.get_field('imagen_tipo_de_curso', 'tipo_de_curso_40').'</p>';
				}
			} */ ?>
			<a href="<?php the_permalink(); ?>">View more</a>
			<div class="chip right">Fechas Disponibles</div>
		</li>


		<?php/*<div class="divider blue-grey lighten-4 wow fadeIn" data-wow-delay="100ms"></div>*/?>


	<?php endwhile; ?>

	</ul>

	<script>
	jQuery('.phone').text(function(i, text) {
			return text.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, '($1) $2-$3');
		});
	</script>

<?php else :

	echo '<p>No se encontraron resultados.</p>';

endif; 
wp_reset_query();
?>