							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

								<header class="article-header entry-header">

									<div class="title-style"><h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1></div>

									<p class="byline entry-meta vcard">
										<?php printf( 'Publicado el %1$s %2$s', '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>', '<span class="by">por</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'); ?>
									</p>

								</header> <?php // end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
									<?php the_content(); ?>

									<?php if(is_singular('cursos')) {
										$fecha = get_field('fecha_evento');
										$lugar = get_field('lugar_evento');
										$desc  = get_field('descripcion_evento'); ?>

										<ul class="no-style">
											<li><i class="icon-calendar"></i> <?php echo $fecha; ?></li>
											<li><i class="icon-place"></i> <?php echo $lugar; ?></li>
										</ul>
										<p><?php echo $desc; ?></p>
									<?php } ?>
								</section> <?php // end article section ?>

								<footer class="article-footer">
									<?php if(is_singular('post')) printf( 'Tipo: %1$s', get_the_category_list(', ')); ?>
								</footer> <?php // end article footer ?>

								<?php //comments_template(); ?>

							</article> <?php // end article ?>
