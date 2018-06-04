<?php get_header(); ?>



	<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php the_content(); ?>

		<?php endwhile; endif; ?>


	</main>

	<?php //get_sidebar(); ?>



<?php get_footer(); ?>
