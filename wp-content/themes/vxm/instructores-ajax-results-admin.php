<?php 
/*
 * template-ajax-results.php
 * This file should be created in the root of your theme directory
 */
?>

<?php //echo 'Total de Resultados: ' . $wp_query->found_posts; ?>

<?php if ( have_posts() ) : ?>

	<ul class="lista-alumnos">

	<?php $counter = 0; ?>
	

	<?php while ( have_posts() ) : the_post();


		$counter++; //$ms = str_pad($counter, 2, '0', STR_PAD_LEFT);

		$post_type = get_post_type_object($post->post_type); 

		// vars 
		$numero = get_the_ID();
		$noiveo = get_field('numero_instructor_veo');
		$alta = get_the_date('M j, Y');
		$sexo = get_field('OFI-1-ASexo');
		$pais = get_field('OFI-1-APais');
		$estado = get_field('OFI-1-AEstado');
		$municipio = get_field('OFI-1-AMunicipio');
		$telefono1 = get_field('OFI-1-ATelefono1');
		$telefono2 = get_field('OFI-1-ATelefono2');
		$email = get_field('OFI-1-AEmail'); 

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


		<?php/*<div class="divider wow fadeIn" data-wow-delay="100ms""></div>*/?>
		<li class="section wow fadeIn" data-wow-delay="<?php echo $counter*2; ?>0ms">
			<h5 class="no-margin">
				<?php the_title(); ?>
				<span><a class="box-picture post-link" href="<?php the_permalink(); ?>" data-mfp-src="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>" data-effect="mfp-modal"><small><i class="ti-pencil"></i> Ed</small>*/?></a></span>
			</h5>
			
			<?php $noiveo_or_id = !empty($noiveo) ? $noiveo : 'ID'.str_pad($cfuserid, 5, '0', STR_PAD_LEFT); ?>
			<small class="blue-grey-text">
				<?php echo $noiveo_or_id; ?> — <span class="badge-status status-<?php echo $statusraw; ?>"><?php echo $status; ?></span> — Fecha de alta: <?php echo $alta; ?>. 
			</small>

			<a class="box-picture post-link" href="<?php the_permalink(); ?>" data-mfp-src="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>" data-effect="mfp-modal"><small>Modificar Datos</small></a>

			<a href="<?php the_permalink(); ?>" data-mfp-src="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>" data-effect="mfp-modal" class="personal-data-toggle-admin post-link"><i class="ti-pencil"></i></a>
			<div class="personal-data-admin">
				<ul class="data-list">
					<li><?php echo $municipio.', '.$estado.', '.$pais; ?>.</li>
					
					<?php // phone number and email data
					$tel2 = !empty($telefono2) ? '<span class="tel2"><i class="ti-headphone-alt"></i> '.$telefono2.'</span>' : '';
					echo sprintf('<li><span class="tel1"><i class="ti-headphone-alt"></i> <span class="phone">%s</span></span> %s <span class="email"><i class="ti-email"></i> <a href="mailto:%s">%s</a></span></li>', $telefono1, $tel2, antispambot($email), antispambot($email)); ?>
				</ul>
			</div>
			

			<?php /*
			<div style="background:yellow">
			<p>Autor: <?php echo $post->post_author; ?></p>
			<p>Post ID: <?php the_ID(); ?></p>
			<p>User ID: <?php echo get_post_meta( $post->ID, '_userid', true ); ?></p>
			<p>Email: <?php echo $email; ?></p>
			</div> */ ?>


			<?php //echo '<pre style="background:#333;color:#ccc;font-size:11px">'; print_r(get_post_meta( get_the_ID(), '_status', false )); echo '</pre>'; ?>

		</li>


		<?php/*<div class="divider blue-grey lighten-4 wow fadeIn" data-wow-delay="100ms"></div>*/?>


	<?php endwhile; ?>

	</ul>


<?php else :

	echo '<p>No se encontraron resultados.</p>';

endif; //wp_reset_query(); ?>

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