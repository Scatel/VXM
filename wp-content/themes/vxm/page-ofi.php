<?php/*
Template Name: OFI
*/
?>
<?php if (!is_user_logged_in()) auth_redirect(); ?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php $user = wp_get_current_user(); $userid = $user->ID; ?>

	<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
	
	<?php $allowed_roles = array('instructor', 'administrator', 'certificador', 'admin');
	if( array_intersect($allowed_roles, $user->roles ) ) {  ?>

		<?php // loop for instructor data
		$posts = get_posts(array(
			'post_type'		=> 'aspirantes',
			'meta_key'		=> '_userid',
			'meta_value'	=> $userid
		));
		setup_postdata( $post );
		$noiveo = get_field('numero_instructor_veo');
		$noiveo_or_id = !empty($noiveo) ? $noiveo : 'ID'.str_pad($userid, 5, '0', STR_PAD_LEFT); ?>

		<div id="up" class="section title-section border-bottom">
			<hgroup class="container">
				<h1 class="page-title white-text"><?php single_post_title(); ?></h1>
				<p class="no-margin white-text">
					<i class="glyphicons glyphicons-certificate tooltipped" data-position="bottom" data-delay="50" data-tooltip="Instructor Certificado"></i> 
					Número de Instructor: 
					<span class="badge-status dark">
						<?php echo $noiveo_or_id; ?>
					</span>
				</p>
				<p class="no-margin white-text">
					<small>
						<?php echo 'Último inicio de sesión hace '.do_shortcode('[lastlogin]'); ?>
					</small>
				</p>
			</hgroup>
		</div>

		<section class="menu-instructores section">
			<div class="container">
				<ul class="grid-center">
					<li class="col-3 center">
						<a href="#alta-alumno-popup" class="inline-popup-link btn-big blue-grey darken-3" data-effect="mfp-modal">
							<i class="glyphicons glyphicons-user-add"></i>
							Alta de Alumno
						</a>
					</li>
					<li class="col-3 center">
						<a href="#faq" class="modal-trigger _inline-popup-link btn-big blue-grey darken-3" data-effect="mfp-modal">
							<i class="glyphicons glyphicons-question-sign"></i>Preguntas Frecuentes
						</a>
					</li>
					<li class="col-3 center">
						<a href="#manual-instructor-popup" class="modal-trigger _inline-popup-link btn-big blue-grey darken-3" data-effect="mfp-modal">
							<i class="glyphicons glyphicons-list-alt"></i>Manual de Instructor
						</a>
					</li>
				</ul>
			</div>
		</section>



		<div id="content" class="container">

			<section class="alumnos">
				<h3 class="h3 title-with-button">
					Lista de Alumnos 
					<a 
						href="javascript:void(0)" 
						onClick="window.print()" 
						class="btn button small hide-on-print">
						<i class="glyphicons glyphicons-print"></i> 
						<span class="hide-on-small-only">
							Imprimir Lista
						</span>
					</a>
				</h3>

				<form id="alumno-search-form" name="alumno-search-form" action="<?php /*echo get_home_url(); ?>/tienda*/?>" role="search">
					<div>
						<div class="grid-middle-noGutter">
							<div class="col-8">
								<div class="input-field">
									<i class="material-icons prefix">search</i>	
									<input type="text" value="" name="search_query" id="alumno-search-input" class="search-input" autocomplete="off" />
									<label for="alumno-search-input">Buscar Alumnos</label>
								</div>
							</div>
							<div class="col-2_sm-4">
								<button type="submit" id="alumno-search-submit" class="btn-flat"><?php _e('Search', 'bonestheme'); ?></button>
							</div>
							<div class="col-2_sm-0">
								<input type="reset" id="alumno-search-reset" class="btn-flat" value="Limpiar"></input>
							</div>
						</div>
					</div>	

				</form>

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
			</section>

			<div id="alta-alumno-popup" class="white-popup mfp-with-anim mfp-hide">

				<h2 class="h6 no-margin">Alta de Alumno</h2>

				<div class="section"><div class="divider"></div></div>

				<?php acf_form(array(
					'post_id'      => 'new_post',
					'new_post'     => array(
						'post_type'    => 'alumnos',
						'post_status'  => 'publish'
					),
					'html_before_fields' => '<div class="grid-bottom">',
					'html_after_fields' => '</div>',
					'updated_message' => __("Post updated", 'acf'),
					'submit_value' => __("Alta de Alumno", 'bonestheme')
				)); ?>
			</div>



			<div id="faq" class="modal modal-fixed-footer">
				<div class="modal-content">
					<h4 class="h6 no-margin">Preguntas Frecuentes</h4>
					<div class="section"><div class="divider"></div></div>

					<!-- -->
					<div id="aio-results-instructores">
					</div>
					<?php 	
						if(current_user_can('edit_post', get_the_id())){
							$new_faq_instructores_args = array(
								'post_id'    	=> 'new_post',
								'new_post'     => array(
									'post_type'    => 'faqs_instructores',
									'post_status'  => 'publish'
								),
								'return' => get_permalink(92),
								// 'field_groups' => array('1884'),
								'field_groups' => array('1793'),
								'submit_value' => __("Submit FAQ", 'bonestheme')
							);
							$new_instructores_cat_args = array(
								'post_id'    	=> 'new_post',
								'new_post'     => array(
									'post_type'    => 'faq_inst_cat_input',
									'post_status'  => 'publish'
								),
								'return' => get_permalink(92),
								// 'field_groups' => array('1889'),
								'field_groups' => array('1775'),
								'submit_value' => __("Submit Category", 'bonestheme')
							);
							acf_form($new_faq_instructores_args);
							acf_form($new_instructores_cat_args);
						}
					?>
					<!-- -->

				</div>
				<div class="modal-footer">
					<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
				</div>
			</div>

			<div id="manual-instructor-popup" class="modal modal-fixed-footer">
				<div class="modal-content">
					<h4 class="h6 no-margin">Manual de Instructor</h4>
					<div class="section"><div class="divider"></div></div>

					<div class="format">
						<!-- -->
						<div id="aio-results-manual-instructores">
						</div>
						<?php 	
							if(current_user_can('edit_post', get_the_id())){
								$new_entry_instructores_args = array(
									'post_id'    	=> 'new_post',
									'new_post'     => array(
										'post_type'    => 'manual_instructores',
										'post_status'  => 'publish'
									),
									'return' => get_permalink(92),
									// 'field_groups' => array('1911'),
									'field_groups' => array('1781'),
									'submit_value' => __("Submit FAQ", 'bonestheme')
								);
								$new_instructores_entry_cat_args = array(
									'post_id'    	=> 'new_post',
									'new_post'     => array(
										'post_type'    => 'entry_inst_cat_input',
										'post_status'  => 'publish'
									),
									'return' => get_permalink(92),
									// 'field_groups' => array('1916'),
									'field_groups' => array('1779'),
									'submit_value' => __("Submit Category", 'bonestheme')
								);
								acf_form($new_entry_instructores_args);
								acf_form($new_instructores_entry_cat_args);
							}
						?>
						<!-- -->
					</div>

				</div>
				<div class="modal-footer">
					<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
				</div>
			</div>







			<div id="imprimir-formatos" class="white-popup mfp-with-anim mfp-hide">
				<p class="flow-text">
					Te recuerdo que en la primera clase, debes entregar a los padres de familia para su debido llenado y firma los formatos:  F-VXM-001, F-VXM-003 y F-VXM-004
				</p>
				<p>Click en los botones para imprimir</p>
				<button 
					type="button" 
					class="btn" 
					onclick="printJS('<?php echo get_site_url().'/assets/PDF-Formats/VXM-001.pdf'?>')"> <!-- pdf file created in create_format() function-->
   			 		F-VXM-001
				</button>
				<button 
					type="button" 
					class="btn" 
					onclick="printJS('<?php echo get_site_url().'/assets/PDF-Formats/VXM-003.pdf'?>')"> <!-- pdf file created in create_format() function-->
   			 		F-VXM-003
				</button>
				<button 
					type="button" 
					class="btn" 
					onclick="printJS('<?php echo get_site_url().'/assets/PDF-Formats/VXM-004.pdf'?>')"> <!-- pdf file created in create_format() function-->
   			 		F-VXM-004
 				</button>
				<a 
					href="#0" 
					class="btn-flat" 
					onclick="$.magnificPopup.close();">
					No Imprimir
				</a>
			</div>

			<?php $altaok = $_GET['updated'];
			if($altaok == 'true') {
				create_format();
			?>
				<a href="#imprimir-formatos" class="inline-popup-link-autopen hide" data-effect="mfp-modal">Imprimir formatos</a>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$('.inline-popup-link-autopen').magnificPopup({
							type:'inline',
							midClick: true,
							removalDelay: 500,
							callbacks: {
								beforeOpen: function() {
									this.st.mainClass = this.st.el.attr('data-effect');
								},
								close: function() {
								},
							}
						}).magnificPopup('open');
					});
				</script>
			<?php } ?>
		</div>

	<?php } else { // ends conditional if user roles ?>
		
		<div class="container">
			<div class="form-margin-top-bottom">
				<div class="alert message section">
					<p>No tienes acceso a esta sección del sitio. Si crees que es un error, favor de contactar un administrador.</p>
				</div>
			</div>
		</div>

	<?php } ?>

	</main>




<?php get_footer(); ?>