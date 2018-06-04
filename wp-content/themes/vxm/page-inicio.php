<?php
/*
Template Name: Inicio
*/
?>

<?php get_header(); ?>

	<main id="content" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		

		<div class="parallax-container" id="nosotros">
			<div class="parallax green-blue-light"><img src="<?php echo libraryUrl(); ?>/img/bg-parallax.jpg"></div>
			<hroup class="vxmbig">
				<h1><span class="span1">Viendo por</span><br><span class="span2">el Mundo</span></h1>
				<h2>Developing your Mind</h2>
			</hroup>
			<?php /* <img src="<?php echo libraryUrl(); ?>/img/noe_esperon_home.png" class="slider-fixed-img"> */ ?>
		</div>


		



		<div class="container">
			
			<div class="section center">
				<p class="flow-text">En Viendo por el Mundo queremos que todos los niños en edad escolar primaria se transformen en niños superdotados activando su VISIÓN EXTRA OCULAR que desarrollará su mente y abrirá su conciencia convertiéndolos en mejores personas en la familia, escuela y sociedad.</p>

				<p>Te invitamos a conocer esta propuesta que cambiará tu vida y la de tus pequeños.</p>

				<h2>¡En Pro de una humanidad mejor!</h2>
			</div>

			<div class="section center">
				<div class="grid-center">
					<div class="col-6_md-8_sm-12">
						<div class="js-lazyYT" data-youtube-id="undXkQv_1TI"></div>
					</div>
				</div>
			</div>

		</div>

		<div id="home-testi" class="section green-blue-light">
			<div class="container">
				<h3 class="lined center">Testimonios</h3>



				<?php $args = array(
						'post_type' => array('testimonios'),
						'posts_per_page' => '1',
						'order' => 'ASC'
					);
				
				$query = new WP_Query( $args );
				
				if($query->have_posts()) {
					while ($query->have_posts()) {
						$query->the_post(); ?>

						<figure class="testimg">
						<?php if(has_post_thumbnail()) {
							the_post_thumbnail( 'large');
						} else {
							echo '<img src="'.libraryUrl().'/img/man.svg">';
						} ?>
						</figure>
						<?php the_title('<h5>', '</h5>');
						the_content();

						echo '<a href="'.get_permalink( 12 ).'" class="btn right">Ver todos los testimonios</a>';
					}
				} else {
					echo 'No hay testimonios aún.';
				}

				// echo '<pre style="background:#333;color:#ccc">';print_r($ppp);echo '</pre>';
				?>




			</div>
		</div>
		
		<div id="home-cursos" class="section">
			<div class="container">
				<h3 class="lined center">Próximos Cursos</h3>
			</div>
			<div class="padd">

				<?php $terms = get_terms( array(
					'taxonomy' => 'dirigido-a',
					'hide_empty' => false,
				) );
				//echo '<pre>';print_r($terms);echo '</pre>';
				if($terms) { ?>
					<div class="grid-equalHeight taxonomy-dirigido-a">

						<?php foreach ($terms as $term) { ?>

						<?php $term_link = get_term_link($term); ?>

						<div class="col-6_md-12">
							<article class="tax-item <?php echo $term->slug; ?>">
								<header class="entry-header">
									<hgroup>
										<h1 class="h2 entry-title padded center">
											<a href="<?php echo esc_url($term_link); ?>" class="taxy-dirigido-a relative">
												<?php echo $term->name; ?>
												<span 
													class="absolute">
														<!-- echo __(foo, 'bonestheme') translates the foo variable to predefined value stored in bonestheme-->
														<?php echo __('Intended for', 'bonestheme'); ?>
												</span> 
											</a>
										</h1>
										<h2><?php echo $term->description; ?></h2>
									</hgroup>													
								</header>


								<footer>
									<?php 
										$args = array(
											'post_type'   => array( 'cursos' ),
											'post_status' => array( 'publish' ),
											'order'       => 'ASC',
											'orderby' => 'menu_order',
											'taxonomy'    => 'dirigido-a',
											'term'        => $term->slug,
										);
										$query = new WP_Query( $args );
										if ( $query->have_posts() ) { 
									?>
									<ul class="lista-cursos card-cursos">
										<?php 
											while ( $query->have_posts() ) {
												$query->the_post();

												$terms = get_terms('tipo_de_curso');

														$taxclass = $term->slug;

												$term_list = wp_get_post_terms($post->ID, 'tipo_de_curso', array("fields" => "all"));
												$tipo = $term_list[0]->slug;

												$descripcion_del_curso = get_field('descripcion_del_curso');
												$spoiler = get_field('course_spoiler');
												$description = empty($spoiler) ? $descripcion_del_curso : $spoiler;

												$desc = cortarTexto(strip_tags($description), 180);
												$perma = get_permalink(); 
										?>	
												<li class="section wow fadeIn <?php echo $tipo; ?>" data-wow-delay="20ms">
													<h5 class="no-margin pdt">
														<a href="<?php echo $perma; ?>"><?php the_title(); ?></a>
													</h5>
													<p>
													
														<?php echo $desc;?>
													</p>
													<a href="<?php echo $perma; ?>" class="view-more"><?php echo __('View more', 'bonestheme'); ?></a>
													<?php
														if($term->slug !== "ninos-y-adolescentes"){
															echo '<div class="chip">Lugares y fechas próximas</div>';
														}
													?>
												</li>

										<?php 
											} // end while
										?>
										</ul>
									<?php 
										} // end if
										wp_reset_postdata();
										$post_ID = 22;
										if($term->slug == "ninos-y-adolescentes"){
											echo '<a href="'.get_post_permalink($post_ID).'" class="btn" style="display: block;">VER INSTRUCTORES</a>';
										} 	
									?>
								</footer>
							</article>
						</div>

						<?php } ?>

					</div>
				<?php } ?>

			</div>
		</div>

		<?php //get_template_part('footer', 'contact'); ?>



	</main>

<?php get_footer(); ?>
