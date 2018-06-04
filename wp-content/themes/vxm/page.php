<?php get_header(); ?>



	<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		
		<div id="up" class="section title-section border-bottom">
			<hgroup class="container">
				<h1 class="page-title white-text"><?php single_post_title(); ?></h1>
				<p class="section_ flow-text white-text"><?php the_field('page_subtitle', get_the_ID()); ?></p>
			</hgroup>
		</div>



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
