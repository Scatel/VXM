				<div id="sidebar1" class="sidebar stuck release col-3_md-4_sm-12_xs-0 cf" role="complementary">

					<div class="pin-helper" style="height:1px;"></div>

					<div class="toc-wrapper">

						<?php //echo get_post_type(); ?>

						<?php /*$ajaxsearch = new WP_Advanced_Search('ajaxform-'.get_post_type()); ?>
						<?php $ajaxsearch->the_form(); ?>

						<?php /*$search = new WP_Advanced_Search('search-form'); ?>
						<?php $search->the_form(); */?>


						<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

							<?php dynamic_sidebar( 'sidebar1' ); ?>

						<?php endif; ?>

						<div class="social-sidebar grid-2">
							<div class="col">
								<div class="social-network social-facebook">
									<div class="social-icon">
										<span><i class="ti-facebook"></i></span>
										<p>Facebook</p>
									</div>
									<div class="social-followers">
										<strong>+1000</strong><br>
										<?php echo _e('Followers', 'bonestheme'); ?>
									</div>
									<a href="javascript:void(0)" target="_blank"></a>
								</div>
							</div>
							<div class="col">
								<div class="social-network social-twitter">
									<div class="social-icon">
										<span><i class="ti-twitter-alt"></i></span>
										<p>Twitter</p>
									</div>
									<div class="social-followers">
										<strong>+100</strong><br>
										<?php echo _e('Followers', 'bonestheme'); ?>
									</div>
									<a href="javascript:void(0)" target="_blank"></a>
								</div>
							</div>
						</div>


						<?php echo list_child_pages(); ?>

					</div>


				</div>