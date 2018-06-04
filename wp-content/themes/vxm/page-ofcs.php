<?php/*
Template Name: OFCS
*/
?>
<?php if (!is_user_logged_in()) auth_redirect(); ?>
<?php acf_form_head(); ?>
<?php get_header(); ?>

<?php $user = wp_get_current_user(); $userid = $user->ID; ?>

	<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

	<?php $allowed_roles = array('administrator', 'admin', 'certificador-senior');
	if( array_intersect($allowed_roles, $user->roles ) ) {  ?>
		
		<div id="up" class="section title-section border-bottom">
			<hgroup class="container">
				<h1 class="page-title"><?php single_post_title(); ?></h1>
				<p class="no-margin"><i class="glyphicons glyphicons-veteran tooltipped" data-position="bottom" data-delay="50" data-tooltip="Instructor Certificado"></i> Número de Certificador Senior: <span class="badge-status dark"><?php echo $userid; ?></span> <a href="">Imprimir Certificado</a></p>
				<p class="no-margin hide">
					<?php /*$field = array('user_id' => $userid, 'field' => 2);
					$telefono = bp_get_profile_field_data( $field );
					if ($telefono) echo 'Teléfono: '.$telefono; */?>
				</p>
				<p class="no-margin"><small><?php echo 'Último inicio de sesión hace '.do_shortcode('[lastlogin]'); ?></small></p>
				<p class="hide">
					<?php /*echo '<a href="'.bp_core_get_user_domain($userid).'profile/">Ver Perfil</a>'; ?>
					<?php echo '| <a href="'.bp_core_get_user_domain($userid).'profile/edit/">Editar Perfil</a>';*/ ?>
				</p>
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
							<li><a href="<?php echo home_url(); ?>/ofi/">OFI</a></li>
							<li><a href="<?php echo home_url(); ?>/ofc/">OFC</a></li>
							<li><a href="<?php echo home_url(); ?>/ofcs/" class="active">OFCS</a></li>
							<li><a href="<?php echo home_url(); ?>/ofa/">OFA</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		*/ ?>

		<?php //echo '<pre>'; print_r($user); echo '</pre>'; ?>

		<section class="menu-instructores section">
			<div class="container">
				<ul class="grid-center">
					<li class="col-3 center">
						<a href="#alta-aspirante-popup" class="inline-popup-link btn-big blue-grey darken-3" data-effect="mfp-move-horizontal">
							<i class="glyphicons glyphicons-user-add"></i>Alta de Aspirante a Certificador
						</a>
					</li>
					<li class="col-3 center">
						<a href="#alta-aspirante-popup" class="inline-popup-link btn-big blue-grey darken-3" data-effect="mfp-move-horizontal">
							<i class="glyphicons glyphicons-fingerprint-ok"></i>Firma de Contrato de Aspirante
						</a>
					</li>
					<li class="col-3 center">
						<a href="#alta-aspirante-popup" class="inline-popup-link btn-big blue-grey darken-3" data-effect="mfp-move-horizontal">
							<i class="glyphicons glyphicons-user-remove"></i>Baja de Aspirante
						</a>
					</li>
					<li class="col-3 center">
						<a href="#alta-aspirante-popup" class="inline-popup-link btn-big blue-grey darken-3" data-effect="mfp-move-horizontal">
							<i class="glyphicons glyphicons-file-export"></i>Envio de Contrato al Notario
						</a>
					</li>
				</ul>
			</div>
		</section>



		<div id="content" class="container">

			<section class="alumnos">
				<h3 class="h3 title-with-button">Aspirantes a Certificador <a href="javascript:void(0)" onClick="window.print()" class="btn button small hide-on-print"><i class="glyphicons glyphicons-print"></i> <span class="hide-on-small-only">Imprimir Lista</span></a></h3>

				<?php
				$args = array (
					'post_type'  => array( 'aspirantes' ),
					'author'     => $userid,
					'meta_key'   => 'tipo_de_aspirante',
					'meta_value' => 'certificador'
				);

				$query = new WP_Query( $args );

				if ( $query->have_posts() ) { ?>
					<ul class="lista-alumnos">
					<?php while ( $query->have_posts() ) {
						$query->the_post(); ?>

						<?php // custom fields 
						$numero = get_the_ID();
						$alta = get_the_date('Y-m-d');
						$sexo = get_field('OFI-1-ASexo');
						$pais = get_field('OFI-1-APais');
						$estado = get_field('OFI-1-AEstado');
						$municipio = get_field('OFI-1-AMunicipio');
						$telefono1 = get_field('OFI-1-ATelefono1');
						$telefono2 = get_field('OFI-1-ATelefono2');
						$mama = get_field('OFI-1-ANombreDeMama');
						$email = get_field('OFI-1-AEmail'); 

						$cfuserid = get_post_meta( get_the_ID(), '_userid', true ); 

						$statusraw = get_field('status', 'user_'.$cfuserid);
						$status = ( $statusraw == 00) ? 'Sin Certificar' : 'Certificado' ; ?>

						<div class="divider"></div>
						<li class="section">
							<h5 class="no-margin"><?php the_title(); ?></h5>
							<small class="blue-grey-text">User: <?php echo $cfuserid; ?> — <span class="badge-status status-<?php echo $statusraw; ?>"><?php echo $status; ?></span> — Fecha de Alta: <?php echo $alta; ?></small>
							<div class="">

							</div>
							<a class="box-picture post-link" href="<?php the_permalink(); ?>" data-mfp-src="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>" data-effect="mfp-modal"><small>Modificar Datos</small></a>
						</li>

					<?php } ?>
					</ul>
				<?php } else {
					echo 'Aún no has dado de alta ningun aspirante.';
				}

				
				wp_reset_postdata(); ?>




				<form id="certificador-admin-search-form" name="certificador-admin-search-form" action="<?php /*echo get_home_url(); ?>/tienda*/?>" role="search">

					<div>
						<div class="grid-middle-noGutter">
							<div class="col-8">
								<div class="input-field">
									<i class="material-icons prefix">search</i>	
									<input type="text" value="" name="search_query" id="certificador-admin-search-input" class="search-input" autocomplete="off" />
									<label for="certificador-admin-search-input">Buscar Instructores</label>
								</div>
								<div class="hide"><input name="pagetemplate" id="pagetemplate" type="hidden" value="<?php echo get_page_template_slug(get_the_ID()); ?>" /></div>
							</div>
							<div class="col-2_sm-4">
								<button type="submit" id="certificador-admin-search-submit" class="btn-flat"><?php _e('Search', 'bonestheme'); ?></button>
							</div>
							<div class="col-2_sm-0">
								<input type="reset" id="certificador-admin-search-reset" class="btn-flat" value="Limpiar" />
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
				
				<h2 class="h6 no-margin">Alta De Aspirantes a Certificadores V.E.O. 1</h2>

				<div class="section"><div class="divider"></div></div>

				<?php acf_form(array(
					'post_id'      => 'new_post',
					'new_post'     => array(
						'post_type'    => 'aspirantes',
						'post_status'  => 'publish'
					),
					'field_groups'	=>	array('group_58083233c61be', 'group_58082fc615096'),
					'html_before_fields' => '<div class="grid-bottom">',
					'html_after_fields' => '</div>',
					'updated_message' => __("Post updated", 'acf'),
					'submit_value' => __("Alta de Aspirante", 'bonestheme')
				)); ?>
				
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
