<?php
/*
Template Name: Certificadores AIO Search
*/
?>
<?php get_header(); ?>



	<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		
		<div id="up" class="section title-section border-bottom">
			<hgroup class="container">
				<h1 class="page-title white-text"><?php single_post_title(); ?></h1>
				<p class="section_ flow-text white-text"><?php the_field('page_subtitle', get_the_ID()); ?></p>
			</hgroup>
		</div>

		<div id="content" class="container">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

				<header class="article-header title-style hide">
					<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
				</header> <?php // end article header ?>

				<section class="entry-content mt2 cf" itemprop="articleBody">
					<?php the_content(); ?>
				</section> <?php // end article section ?>

				<footer class="article-footer cf">

					<div class="grid">
						<div class="col-3_md-4_sm-12 stuck zindex98">
							<div class="side-search-wrap">

								<p class="alert dismiss white bottom-triangle">Para buscar certificadores en tu localidad escribe pais, ciudad, colonia ó por nombre de certificador.</p>

								

								<form id="certificador-search-form" name="certificador-search-form" action="<?php /*echo get_home_url(); ?>/tienda*/?>" role="search">

									<div>
										<div class="grid-noGutter">
											<div class="col-12">
												<div class="input-field">
													<i class="material-icons prefix">search</i>	
													<input type="text" value="" name="search_query" id="certificador-search-input" class="search-input" autocomplete="off" />
													<label for="certificador-search-input">Buscar Certificadores</label>
												</div>
											</div>
											<div class="col-6">
												<input type="reset" id="certificador-search-reset" class="btn-flat" value="Limpiar"></input>
											</div>
											<div class="col-6 text-right">												
												<button type="submit" id="certificador-search-submit" class="btn"><?php _e('Search', 'bonestheme'); ?></button>
											</div>
										</div>
									</div>	

								</form>
								<br>
								<p style="text-align: center">
									¿Quieres ser Instructor de esta metodología?
									<a 
										href="<?php 
											$post_ID = 313;
											echo get_post_permalink($post_ID); ?>"
										class="btn" 
										id="instructor-ser-btn">
										Ser Instructor
									</a>
								</p>


							</div>
						</div>
						<div class="col-9_md-8_sm-12">

							<div id="wpas-results">
								<div id="aio-results">
								</div>

								<div id="loading-posts" class="col-12 center cf" style="display:none">
									<div class="preloader-wrapper active">
										<div class="spinner-layer spinner-blue-only">
											<div class="circle-clipper left">
												<div class="circle"></div>
											</div>
											<div class="gap-patch">
												<div class="circle"></div>
											</div>
											<div class="circle-clipper right">
												<div class="circle"></div>
											</div>
										</div>
									</div>
								</div>

							</div>




						</div>
					</div>

				</footer>

			</article>

			<?php endwhile; endif; ?>

		</div>

	</main>

	<?php //get_sidebar(); ?>


<?php get_footer(); ?>
