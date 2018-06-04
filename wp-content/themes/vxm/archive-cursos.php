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
																			<span class="absolute"><?php echo __('Intended for', 'bonestheme'); ?></span>
																		</a>
																	</h1>
																	<h2><?php echo $term->description; ?></h2>
																</hgroup>													
															</header>


															<footer>
																<?php $args = array(
																	'post_type'   => array( 'cursos' ),
																	'post_status' => array( 'publish' ),
																	'order'       => 'ASC',
																	'orderby' => 'menu_order',
																	'taxonomy'    => 'dirigido-a',
																	'term'        => $term->slug,
																);

																$query = new WP_Query( $args );

																if ( $query->have_posts() ) { ?>
																	<ul class="lista-cursos card-cursos">
																	<?php while ( $query->have_posts() ) {
																		$query->the_post();

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
																	
																	<?php } ?>
																	</ul>
																<?php }
																wp_reset_postdata(); ?>
															</footer>
														</article>
													</div>

													<?php } ?>

												</div>
											<?php } ?>
										</div>


										<?php /*if (have_posts()) : while (have_posts()) : the_post(); ?>

											<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

												<header class="entry-header article-header">

													<h3 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
													<p class="byline entry-meta vcard">
														<?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
				                  							     
				                  							     '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
				                       								
				                       								'<span class="by">'.__('by', 'bonestheme').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
				                    							); ?>
													</p>

												</header>

												<section class="entry-content cf">

													<?php the_post_thumbnail( 'bones-thumb-300' ); ?>

													<?php the_excerpt(); ?>

												</section>

												<footer class="article-footer">

												</footer>

											</article>

										<?php endwhile; ?>

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
															<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
													</footer>
												</article>

										<?php endif;*/ ?>

									</div>
									

									

									

									<?php //get_sidebar(); ?>

								</div>

							</div>

						</main>

						


<?php get_footer(); ?>
