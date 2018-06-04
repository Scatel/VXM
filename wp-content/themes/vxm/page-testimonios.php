<?php
/*
Template Name: Testimonios
*/
?>
<?php get_header(); ?>



	<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		
		<div id="up" class="section title-section border-bottom">
			<hgroup class="container">
				<h1 class="page-title"><?php single_post_title(); ?></h1>
				<p class="section_ flow-text white-text_"><?php the_field('page_subtitle', get_the_ID()); ?></p>
			</hgroup>								
		</div>

		<?php /*
		<div class="sections-menu stuck">
			<div class="container">
				<div class="grid-noGutter">
					<div class="col-6">
						<h6 class="title-appear no-margin"><?php single_post_title(); ?></h6>
					</div>
					<div class="col-6">
						<ul>
							<li><a href="#up"><i class="ti-arrow-up"></i></a></li>
							<li><a href="#descripcion">Descripción</a></li>
							<li><a href="#cerradas">Cerradas</a></li>
							<li><a href="#ubicacion">Ubicación</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		*/ ?>

		<div id="content" class="container">

			<div class="grid">
				<div class="primary-content col-9_md-8_sm-12">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						<header class="article-header title-style hide">

							<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

						</header> <?php // end article header ?>

						<section id="home-testi" class="entry-content mt2 cf" itemprop="articleBody">
							<?php the_content(); ?>

							<?php $args = array(
								'post_type' => array('testimonios'),
								'posts_per_page' => '-1',
								'order' => 'ASC'
							);
						
							$query = new WP_Query( $args );
							
							if($query->have_posts()) { ?>
								<ol class="testimonios-list">
								<?php while ($query->have_posts()) {
									$query->the_post(); ?>

									<?php/*
									<figure class="testimg">
									<?php if(has_post_thumbnail()) {
										the_post_thumbnail( 'large');
									} else {
										echo '<img src="'.libraryUrl().'/img/man.svg">';
									} ?>
									</figure>*/?>
									<li>
										<?php the_title('<h5>', '</h5>');
										the_content(); ?>
									</li>
								<?php } ?>
								</ol>
							<?php } else {
								echo 'No hay testimonios aún.';
							} 
							wp_reset_postdata(); ?>

						</section> <?php // end article section ?>

						<footer class="article-footer cf">

						</footer>

					</article>

					<?php endwhile; endif; ?>

				</div><!-- /.primary-content -->

				<?php get_sidebar(); ?>

			</div><!-- /.grid -->

		</div><!-- /#content -->


	</main>




<?php get_footer(); ?>
