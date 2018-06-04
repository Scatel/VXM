<?php get_header(); ?>



						<main id="content" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<div class="section title-section">
								<hgroup class="container">
									<?php the_archive_title( '<h1 class="page-title white-text">', '</h1>' ); ?>
									<p class="section_ flow-text white-text"><?php the_archive_description(); ?></p>
								</hgroup>
								<?php/*<nav class="breadcrumbs container">
									<div class="nav-wrapper">
										<a href="<?php echo get_page_link(16); ?>" class="breadcrumb white-text"><?php echo get_the_title(16); ?></a>
										<span class="breadcrumb text-color"><?php the_archive_title(); ?></span>
									</div>
								</nav>*/?>
							</div>

							<div class="container">

								<div class="grid">

									<div class="col-12 kol-9_md-8_sm-12">

										<div class="mt2">
										




										<?php if (have_posts()) : ?>

											<ul class="lista-cursos card-cursos"><?php $counter = 0; ?>

												<?php while (have_posts()) : the_post(); ?>


													<?php $counter++; //$ms = str_pad($counter, 2, '0', STR_PAD_LEFT);
													$terms = get_terms('tipo_de_curso');
													$term_list = wp_get_post_terms($post->ID, 'tipo_de_curso', array("fields" => "all"));
													$tipo = $term_list[0]->slug;

													$descripcion_del_curso = get_field('descripcion_del_curso');
													$spoiler = get_field('course_spoiler');
													$description = empty($spoiler) ? $descripcion_del_curso : $spoiler;

													$desc = cortarTexto(strip_tags($description), 180);
													$perma = get_permalink(); ?>
													
													<li class="section wow fadeIn <?php echo $tipo; ?>" data-wow-delay="20ms">
														<h5 class="no-margin pdt">
															<a href="<?php echo $perma; ?>"><?php the_title(); ?></a>
														</h5>
														<p>
															<?php echo $desc; ?>
														</p>
														<a href="<?php echo $perma; ?>" class="view-more"><?php echo __('View more', 'bonestheme'); ?></a>
														<div class="chip">Fechas Disponibles</div>
													</li>



												<?php endwhile; ?>

											</ul>
											
											<?php bones_page_navi(); ?>

										<?php else : ?>

												<article id="post-not-found" class="hentry cf">
													<header class="article-header">
														<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
													</header>
													<section class="entry-content">
														<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
													</section>
													<footer class="article-footer">
															<p></p>
													</footer>
												</article>

										<?php endif; ?>

										</div>

									</div>
									

									

									

									<?php //get_sidebar(); ?>

								</div>

							</div>

						</main>

						


<?php get_footer(); ?>
