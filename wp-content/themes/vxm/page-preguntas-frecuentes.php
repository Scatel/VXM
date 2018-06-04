<?php
/*
Template Name: Preguntas Frecuentes
*/
?>
<?php 
	acf_form_head();
	get_header(); 
?>




	<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		
		<div id="up" class="section title-section border-bottom">
			<hgroup class="container">
				<h1 class="page-title white-text"><?php single_post_title(); ?></h1>
				<p class="section_ flow-text white-text"><?php the_field('page_subtitle', get_the_ID()); ?></p>
			</hgroup>
		</div>

		<div id="content" class="container">

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
				</div> <!-- .loading-posts -->
			<?php

	?>



	<!-- https://stackoverflow.com/questions/46561686/wordpress-delete-posts-by-using-the-date-of-a-custom-field -->

					<?php 	
					if(current_user_can('edit_post', get_the_id())){
						$new_faq_args = array(
							'post_id'    	=> 'new_post',
							'new_post'     => array(
								'post_type'    => 'faqs',
								'post_status'  => 'publish'
							),
							// 'field_groups' => array('1780'),
							'field_groups' => array('1735'),
							'submit_value' => __("Submit FAQ", 'bonestheme')
						);
					
						acf_form($new_faq_args);

						$new_cat_args = array(
							'post_id'    	=> 'new_post',
							'new_post'     => array(
								'post_type'    => 'faq_category_input',
								'post_status'  => 'publish'
							),
							// 'field_groups' => array('1802'),
							'field_groups' => array('1750'),
							'submit_value' => __("Submit Category", 'bonestheme')
						);
					
						acf_form($new_cat_args);
					}
					?>

		</div>

	</main>


	<script type="text/javascript">
jQuery(document).ready(function($) {
    $('textarea').css('height', '150')
});
</script>


<?php get_footer(); ?>
