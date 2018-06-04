<?php/*
Template Name: OFC
*/
?>

<?php if (!is_user_logged_in()) auth_redirect(); ?>
<?php acf_form_head(); ?>
<?php get_header(); ?>

<?php $user = wp_get_current_user(); $userid = $user->ID; ?>

	<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

	<?php $allowed_roles = array('administrator', 'certificador', 'admin');
	if( array_intersect($allowed_roles, $user->roles ) ) {  ?>

		<?php // loop for instructor data
		/*$posts = get_posts(array(
			'post_type'		=> 'aspirantes',
			'meta_key'		=> '_userid',
			'meta_value'	=> $userid
		));
		setup_postdata( $post );*/
		$noiveo = get_field('numero_instructor_veo');
		$noiveo_or_id = !empty($noiveo) ? $noiveo : 'ID'.str_pad($userid, 5, '0', STR_PAD_LEFT); ?>
		
		<div id="up" class="section title-section border-bottom">
			<hgroup class="container">
				<h1 class="page-title white-text"><?php single_post_title(); ?></h1>
				<p class="no-margin white-text">
					<i 
						class="glyphicons glyphicons-certificate tooltipped" 
						data-position="bottom" 
						data-delay="50" 
						data-tooltip="Instructor Certificado"></i> 
					Número de Certificador: 
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
						<a href="#alta-aspirante-popup" class="inline-popup-link btn-big blue-grey darken-3" data-effect="mfp-move-horizontal">
							<i class="glyphicons glyphicons-user-add"></i>Alta de Aspirante a Instructor
						</a>
					</li>
					<li class="col-3 center">
						<a href="#faq" class="modal-trigger _inline-popup-link btn-big blue-grey darken-3" data-effect="mfp-modal">
							<i class="glyphicons glyphicons-question-sign"></i>Preguntas Frecuentes
						</a>
					</li>
					<li class="col-3 center">
						<a href="#manual-instructor-popup" class="modal-trigger _inline-popup-link btn-big blue-grey darken-3" data-effect="mfp-modal">
							<i class="glyphicons glyphicons-list-alt"></i>Manual de Certificador
						</a>
					</li>
				</ul>
			</div>
		</section>



		<div id="content" class="container">

			<section class="alumnos">
				<h3 class="h3 title-with-button">Aspirantes a Instructor <a href="javascript:void(0)" onClick="window.print()" class="btn button small hide-on-print"><i class="glyphicons glyphicons-print"></i> <span class="hide-on-small-only">Imprimir Lista</span></a></h3>
				<form 
					id="aspirante-admin-search-form" 
					name="aspirante-admin-search-form" 
					action="<?php /*echo get_home_url(); ?>/tienda*/?>" 
					role="search">
					<div>
						<div class="grid-middle-noGutter">
							<div class="col-8">
								<div class="input-field">
									<i class="material-icons prefix">search</i>	
									<input type="text" value="" name="search_query" id="aspirante-admin-search-input" class="search-input" autocomplete="off" />
									<label for="aspirante-admin-search-input">Buscar Instructores</label>
								</div>
								<div class="hide"><input name="pagetemplate" id="pagetemplate" type="hidden" value="<?php echo get_page_template_slug(get_the_ID()); ?>" /></div>
							</div>
							<div class="col-2_sm-4">
								<button type="submit" id="aspirante-admin-search-submit" class="btn-flat"><?php _e('Search', 'bonestheme'); ?></button>
							</div>
							<div class="col-2_sm-0">
								<input type="reset" id="aspirante-admin-search-reset" class="btn-flat" value="Limpiar" />
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


			<div id="alta-aspirante-popup" class="white-popup mfp-with-anim mfp-hide">
				
				<h2 class="h6 no-margin">Alta De Aspirantes a Instructores V.E.O. 1</h2>

				<div class="section"><div class="divider"></div></div>

				<?php acf_form(array(
					'post_id'      => 'new_post',
					'new_post'     => array(
						'post_type'    => 'aspirantes',
						'post_status'  => 'publish'
					),
					'field_groups'	=>	array('group_58083233c61be', 'group_58082fc615096', 'group_5a8b05de05701', 'group_5b0f2a4ad8df9', 'group_5a8ddba34185f'),
					'html_before_fields' => '<div class="grid-bottom">',
					'html_after_fields' => '</div>',
					'updated_message' => __("Post updated", 'acf'),
					'submit_value' => __("Alta de Aspirante", 'bonestheme')
				)); ?>
				
			</div>





			<div id="imprimir-manual-popup" class="white-popup mfp-with-anim mfp-hide">

				<h2 class="h6 no-margin">Imprimir Manual V.E.O. 1</h2>

				<div class="section"><div class="divider"></div></div>

				<p>Antes de dar click en "Imprimir" debes tener conectada a tu computadora una impresosra capaz de imprimir 420 páginas en blanco y negro, la impresora debe tener suficiente tinta para imprimir estas 420 páginas. Hemos dividido el documento en varias partes para hacer menos tedioso el proceso de impresión, de esta manera tendrás la opción de imprimir por partes tu manual. Si se te presenta algún problema, comunícate al email que está abajo.</p>

				<p class="alert">Sólo podrás imprimir una vez tu manual completo.</p>

				<form class="grid">
					<span class="col-4">
						<select>
							<option disabled selected>Elije la parte a imprimir</option>
							<option>Parte 1</option>
							<option>Parte 2</option>
							<option>Parte 3</option>
							<option>Parte 4</option>
							<option>Parte 5</option>
							<option>Parte 6</option>
							<option>Parte 7</option>
							<option>Parte 8</option>
						</select>
					</span>
				</form>
				<p class="no-margin text-right">
					<a href="javascript:void(0)" class="btn-flat">Cancelar</a>  
					<a href="javascript:void(0)" class="btn">Imprimir</a>
				</p>
			</div>


			<div id="faq" class="modal modal-fixed-footer">
				<div class="modal-content">
					<h4 class="h6 no-margin">Preguntas Frecuentes</h4>
					<div class="section"><div class="divider"></div></div>



<!-- -->



<div id="aio-results-certificadores">


</div>


<?php 	
if(current_user_can('edit_post', get_the_id())){
$new_faq_certificadores_args = array(
	'post_id'    	=> 'new_post',
	'new_post'     => array(
		'post_type'    => 'faqs_certificadores',
		'post_status'  => 'publish'
	),
	'return' => get_permalink(125),
	// 'field_groups' => array('1901'),
	'field_groups' => array('1789'),
	'submit_value' => __("Submit FAQ", 'bonestheme')
);

acf_form($new_faq_certificadores_args);

$new_certificadores_cat_args = array(
	'post_id'    	=> 'new_post',
	'new_post'     => array(
		'post_type'    => 'faq_cert_cat_input',
		'post_status'  => 'publish'
	),
	'return' => get_permalink(125),
	// 'field_groups' => array('1905'),
	'field_groups' => array('1797'),
	'submit_value' => __("Submit Category", 'bonestheme')
);

acf_form($new_certificadores_cat_args);
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
					<h4 class="h6 no-margin">Manual de Certificador</h4>
					<div class="section"><div class="divider"></div></div>

					<div class="format">
<!-- -->



<div id="aio-results-manual-certificadores">


</div>


<?php 	
if(current_user_can('edit_post', get_the_id())){
$new_entry_certificadores_args = array(
	'post_id'    	=> 'new_post',
	'new_post'     => array(
		'post_type'    => 'manual_certificadores',
		'post_status'  => 'publish'
	),
	'return' => get_permalink(125),
	// 'field_groups' => array('1920'),
	'field_groups' => array('1785'),
	'submit_value' => __("Submit FAQ", 'bonestheme')
);

acf_form($new_entry_certificadores_args);

$new_certificadores_entry_cat_args = array(
	'post_id'    	=> 'new_post',
	'new_post'     => array(
		'post_type'    => 'entry_cert_cat_input',
		'post_status'  => 'publish'
	),
	'return' => get_permalink(125),
	// 'field_groups' => array('1924'),
	'field_groups' => array('1777'),
	'submit_value' => __("Submit Category", 'bonestheme')
);

acf_form($new_certificadores_entry_cat_args);
}
?>


<!-- -->
					</div>

				</div>
				<div class="modal-footer">
					<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
				</div>
			</div>


			
			



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

	<?php //get_sidebar(); ?>



<?php get_footer(); ?>
