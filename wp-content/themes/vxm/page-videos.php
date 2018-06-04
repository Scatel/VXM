<?php
/*
Template Name: Videos
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

						<section class="entry-content mt2 cf" itemprop="articleBody">
							<?php the_content(); ?>

							<?php // Videos
							$videos = get_field('videos_de_youtube');

							if($videos) { ?>

								<ul class="grid">

									<?php
									$i = 0;
									$len = count($videos);
									foreach ($videos as $video) {
										if($i == 0) { ?>
											<li class="col-12">
												<div class="js-lazyYT" data-youtube-id="<?php echo $video['youtube_id']; ?>"></div>
											</li>
										<?php } else { ?>
											<li class="col-6">
												<div class="js-lazyYT" data-youtube-id="<?php echo $video['youtube_id']; ?>"></div>
											</li>
										<?php }
										$i++;
									} ?>

								</ul>

							<?php } ?>

						</section> <?php // end article section ?>

						<footer class="article-footer cf">

						</footer>

					</article>

					<?php endwhile; endif; ?>

				</div><!-- /.primary-content -->

				<?php get_sidebar(); ?>

			</div><!-- /.grid -->

		</div>

	</main>





<?php get_footer(); ?>
