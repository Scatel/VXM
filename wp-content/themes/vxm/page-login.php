<?php
/*
Template Name: Login
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

		<div id="content" class="container">

			<?php
			if ( ! is_user_logged_in() ) {
				$args = array(
					'redirect' => home_url(),
					'remember' => true
					);
				wp_login_form( $args );
			} else {
				wp_loginout( home_url() );
				echo " | ";
				wp_register('', '');
			}
			?>

		</div>

	</main>

	<?php //get_sidebar(); ?>



<?php get_footer(); ?>
