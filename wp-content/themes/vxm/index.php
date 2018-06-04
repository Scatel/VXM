<?php get_header(); ?>


						<main id="content" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">							

							<div class="section title-section border-bottom">
								<hgroup class="container">
									<h1 class="page-title"><?php single_post_title(); ?></h1>
									<p class="flow-text"></p>
								</hgroup>								
							</div>



						<div class="blog-posts-group">

							<?php $args = array ('post_status' => array( 'publish' ), 'offset' => 0, 'posts_per_page' => 3);

							$query = new WP_Query( $args );

							if ( $query->have_posts() ) { ?>

								<div class="grid-3_sm-1-equalHeight">

								<?php while ( $query->have_posts() ) {
									$query->the_post(); ?>
									
									<?php $bgimage = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>

									<div class="col">
									<article id="post-<?php the_ID(); ?>" <?php post_class('cf z-depth-1 bgcover'); ?> role="article" style="background-image: url(<?php echo $bgimage[0]; ?>);">

										<header class="entry-header article-header">

											<h3 class="search-title entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

	                  						<p class="byline entry-meta vcard">
	                    							<?php printf( __( 'Posted %1$s by %2$s', 'bonestheme' ),
	                   							    /* the time the post was published */
	                   							    '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
	                      							    /* the author of the post */
	                       							    '<span class="by">by</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
	                    							); ?>
	                  						</p>

										</header>

										<section class="entry-content">
											<?php echo excerpt(25); ?>
										</section>

										<footer class="article-footer">

											<?php if(get_the_category_list(', ') != ''): ?>
		                  					<?php printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); ?>
		                  					<?php endif; ?>

		                 					<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

										</footer> <!-- end article footer -->

									</article>
									</div>

								<?php }  ?>

								</div>

							<?php } else { ?>

								<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
										<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
									</footer>
								</article>

							<?php }

							wp_reset_postdata(); ?>












							<?php $args = array ('post_status' => array( 'publish' ), 'offset' => 3, 'posts_per_page' => 4);

							$query = new WP_Query( $args );

							if ( $query->have_posts() ) { ?>

								<div class="grid-4_md-2_xs-1-equalHeight">

								<?php while ( $query->have_posts() ) {
									$query->the_post(); ?>
									
									<?php $bgimage = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>

									<div class="col">
									<article id="post-<?php the_ID(); ?>" <?php post_class('cf z-depth-1 bgcover'); ?> role="article" style="background-image: url(<?php echo $bgimage[0]; ?>);">

										<header class="entry-header article-header">

											<h3 class="search-title entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

	                  						<p class="byline entry-meta vcard">
	                    							<?php printf( __( 'Posted %1$s by %2$s', 'bonestheme' ),
	                   							    /* the time the post was published */
	                   							    '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
	                      							    /* the author of the post */
	                       							    '<span class="by">by</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
	                    							); ?>
	                  						</p>

										</header>

										<section class="entry-content">
											<?php //echo excerpt(25); ?>
										</section>

										<footer class="article-footer">

											<?php if(get_the_category_list(', ') != ''): ?>
		                  					<?php printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); ?>
		                  					<?php endif; ?>

		                 					<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

										</footer> <!-- end article footer -->

									</article>
									</div>

								<?php }  ?>

								</div>

							<?php } else { ?>

								<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
										<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
									</footer>
								</article>

							<?php }

							wp_reset_postdata(); ?>


						</div>












							<div id="content" class="container">

								<div class="panel white">

								<?php // normal loop
								if ( have_posts() ) {
									while ( have_posts() ) {
										the_post(); ?>
										
										

										<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

											<header class="entry-header article-header">

												<h3 class="search-title entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

		                  						<p class="byline entry-meta vcard">
		                    							<?php printf( __( 'Posted %1$s by %2$s', 'bonestheme' ),
		                   							    /* the time the post was published */
		                   							    '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
		                      							    /* the author of the post */
		                       							    '<span class="by">by</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
		                    							); ?>
		                  						</p>

											</header>

											<section class="entry-content">
												<?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'bonestheme' ) . '</span>' ); ?>
											</section>

											<footer class="article-footer">

												<?php if(get_the_category_list(', ') != ''): ?>
			                  					<?php printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); ?>
			                  					<?php endif; ?>

			                 					<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

											</footer> <!-- end article footer -->

										</article>

									<?php }

									bones_page_navi();

								} else { ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
											<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

								<?php }

								wp_reset_postdata(); ?>

								</div>

							</div>

						</main>

						<?php get_sidebar(); ?>


<?php get_footer(); ?>
