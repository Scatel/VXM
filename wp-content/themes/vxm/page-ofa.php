<?php/*
Template Name: OFA
*/
?>
<?php if (!is_user_logged_in()) auth_redirect(); ?>
<?php acf_form_head(); ?>
<?php get_header(); ?>

<?php $user = wp_get_current_user(); $userid = $user->ID; ?>

	<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

	<?php $allowed_roles = array('administrator', 'admin');
	if( array_intersect($allowed_roles, $user->roles ) ) {  ?>

		<div id="up" class="section title-section border-bottom">
			<hgroup class="container">
				<h1 class="page-title white-text"><?php single_post_title(); ?></h1>
				<p class="no-margin white-text"><i class="glyphicons glyphicons-police tooltipped" data-position="bottom" data-delay="50" data-tooltip="Instructor Certificado"></i> Número de Administrador: <span class="badge-status dark"><?php echo $userid; ?></span></p>
				<p class="no-margin hide">
					<?php /*$field = array('user_id' => $userid, 'field' => 2);
					$telefono = bp_get_profile_field_data( $field );
					if ($telefono) echo 'Teléfono: '.$telefono; */?>
				</p>
				<p class="no-margin white-text"><small><?php echo 'Último inicio de sesión hace '.do_shortcode('[lastlogin]'); ?></small></p>
				<p class="hide">
					<?php /*echo '<a href="'.bp_core_get_user_domain($userid).'profile/">Ver Perfil</a>'; ?>
					<?php echo '| <a href="'.bp_core_get_user_domain($userid).'profile/edit/">Editar Perfil</a>';*/ ?>
				</p>
			</hgroup>
		</div>


		<?php //echo '<pre>'; print_r($user); echo '</pre>'; ?>

		<?php/*
		<section class="menu-instructores section">
			<div class="container">
				<ul class="grid-center">
					<li class="col-3 center">
						<a href="#alta-aspirante-popup" class="inline-popup-link btn-big blue-grey darken-3" data-effect="mfp-move-horizontal">
							<i class="glyphicons glyphicons-user-add"></i>Alta de Aspirante a Certificador Senior
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
		*/ ?>



		<div id="content" class="container__">

			<section class="alumnos with-tabs">

				<div class="white mb2">
					<div class="container">
						<ul id="ofatabs" class="tabs grid-noGutter">
							<li class="tab col"><a href="#alumnos">Alumnos</a></li>
							<li class="tab col"><a href="#instructores">Instructores</a></li>
							<li class="tab col"><a href="#certificadores">Certificadores</a></li>
							<li class="tab col"><a href="#certificadores-senior">Certificadores Senior</a></li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div id="alumnos" class="content-tab">
						<h3 class="h3 title-with-button">Lista de Alumnos <a href="javascript:void(0)" onClick="window.print()" class="btn button small hide-on-print"><i class="glyphicons glyphicons-print"></i> <span class="hide-on-small-only">Imprimir Lista</span></a></h3>


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


					</div>
					<div id="instructores" class="content-tab">
						<h3 class="h3 title-with-button">Aspirantes a Instructor <a href="javascript:void(0)" onClick="window.print()" class="btn button small hide-on-print"><i class="glyphicons glyphicons-print"></i> <span class="hide-on-small-only">Imprimir Lista</span></a></h3>


						<form id="aspirante-admin-search-form" name="aspirante-admin-search-form" action="" role="search">

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
										<input type="reset" id="aspirante-admin-search-reset" class="btn-flat" value="Limpiar"></input>
									</div>
								</div>
							</div>	

						</form>


					</div>
					<div id="certificadores" class="content-tab">
						<h3 class="h3 title-with-button">Lista de Certificadores <a href="javascript:void(0)" onClick="window.print()" class="btn button small hide-on-print"><i class="glyphicons glyphicons-print"></i> <span class="hide-on-small-only">Imprimir Lista</span></a></h3>



						<form id="certificador-admin-search-form" name="certificador-admin-search-form" action="" role="search">

							<div>
								<div class="grid-middle-noGutter">
									<div class="col-8">
										<div class="input-field">
											<i class="material-icons prefix">search</i>	
											<input type="text" value="" name="search_query" id="certificador-admin-search-input" class="search-input" autocomplete="off" />
											<label for="certificador-admin-search-input">Buscar Certificadores</label>
										</div>
										<div class="hide"><input name="pagetemplate" id="pagetemplate" type="hidden" value="<?php echo get_page_template_slug(get_the_ID()); ?>" /></div>
									</div>
									<div class="col-2_sm-4">
										<button type="submit" id="certificador-admin-search-submit" class="btn-flat"><?php _e('Search', 'bonestheme'); ?></button>
									</div>
									<div class="col-2_sm-0">
										<input type="reset" id="certificador-admin-search-reset" class="btn-flat" value="Limpiar"></input>
									</div>
								</div>
							</div>	

						</form>




					</div>
					<div id="certificadores-senior" class="content-tab">
						<h3 class="h3">Lista de Certificadores Senior</h3>

					</div>
				</div><!-- /.container -->

				<div class="container">					
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
				
			</section>



			


			<div id="alta-aspirante-popup" class="white-popup mfp-with-anim mfp-hide">
				
				<h2 class="h6 no-margin">Alta De Aspirantes a Certificadores Senior V.E.O. 1</h2>

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
