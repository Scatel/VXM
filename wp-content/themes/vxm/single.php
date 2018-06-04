<?php get_header(); ?>


						<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<div class="section title-section border-bottom">
								<hgroup class="container">
									<h1 class="page-title"><?php single_post_title(); ?></h1>
									<?php //general_breadcrumbs(); ?>
								</hgroup>

								<nav class="breadcrumbs container">
									<div class="nav-wrapper">
										<a href="<?php echo get_page_link(23); ?>" class="breadcrumb"><?php echo get_the_title(23); ?></a>
										<span class="breadcrumb"><?php single_post_title(); ?></span>
									</div>
								</nav>								
							</div>

							<div id="content" class="container">

								<div class="panel white styled">
									<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

										<?php get_template_part( 'post-formats/format', get_post_format() ); ?>

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

								</div>						
								

								<?php get_sidebar(); ?>

							</div>

						</main>

						


<?php get_footer(); ?>
