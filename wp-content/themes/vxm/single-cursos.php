<?php get_header(); ?>


	<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<div class="section title-section border-bottom neutral-bg">
			<hgroup class="container">
				<h1 class="page-title">Curso <?php single_post_title(); ?></h1>
				<?php //general_breadcrumbs(); ?>
			</hgroup>

			<nav class="breadcrumbs container">
				<div class="nav-wrapper">
					<a href="<?php echo get_page_link(16); ?>" class="breadcrumb"><?php echo get_the_title(16); ?></a>
					<span class="breadcrumb"><?php single_post_title();?></span>
				</div>
			</nav>								
		</div>

		<div id="content" class="container">


				<div class="primary-content mt2">	

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
					<div class="grid">

						<div class="left-side col-8_md-7_sm-12 cf">
							
							<?php // vars 
							$descripcion_del_curso = get_field('descripcion_del_curso'); ?>

							<section class="entry-content cf" itemprop="articleBody">
								
								<?php echo $descripcion_del_curso; ?>

							</section>

						</div>

						<div class="right-side col-4_md-5_sm-12 cf" role="complementary">

							<?php
								$terms = get_the_terms( $post->ID, 'tipo_de_curso' );
								if($terms !=null) {
									foreach ($terms as $term) {
										$taxclass = $term->slug;
										unset($term);
									}
								}
							?>

							<div class="cursos-dates">
								<img src="<?php echo libraryUrl(); ?>/img/<?php echo $taxclass; ?>.svg" class="taxclass" alt="img12">

								<?php if(have_rows('fechas_cursos')) {
									echo '<h5>Fechas:</h5>';
									echo '<table class="striped bordered fechas-cursos"><tbody>';
									while(have_rows('fechas_cursos')) {
										the_row();

										// vars
										$fecha = get_sub_field('fecha_del_curso');
										$ubicacion_id = get_sub_field('ubicacion_del_curso');
										$ubicacion = get_term( $ubicacion_id, 'location');

										$ancestors = get_ancestors( $ubicacion_id, 'location', 'taxonomy' );
										$ancestorsname = array();
										foreach ($ancestors as $ancestor) {
											$aname = get_term_by( 'id', $ancestor, 'location');
											$ancestorsname[] = $aname->name;
										}
										echo '<tr>';
										echo '<td>'.$ubicacion->name.', '.implode(", ", $ancestorsname).'</td>';
										echo '<td>'.$fecha.'</td>';
										echo '</tr>';

										//echo '<p>'.get_field('imagen_tipo_de_curso', 'tipo_de_curso_40').'</p>';
									}
									echo '</tbody></table>';
								} ?>

							</div>

						</div>



						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
								<header class="article-header">
									<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
								</header>
								<section class="entry-content">
									<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
								</section>
								<footer class="article-footer">
									<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
								</footer>
							</article>

						<?php endif; ?>

					</div><!-- /.grid -->

				</div><!-- /.primary-content -->



		</div><!-- /#content -->

	</main>

						


<?php get_footer(); ?>
