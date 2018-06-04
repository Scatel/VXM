<?php
/*
Template Name: Instructores
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

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

				<header class="article-header title-style hide">

					<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

				</header> <?php // end article header ?>

				<section class="entry-content mt2 cf" itemprop="articleBody">
					<?php the_content(); ?>
				</section> <?php // end article section ?>

				<footer class="article-footer cf">

					<div class="grid">
						<div class="col-3_md-4_sm-12">
							<div class="side-search-wrap">

								<p class="alert dismiss">Para buscar instructores en tu localidad escribe pais, ciudad, colonia ó por nombre de instructor.</p>

								<?php $search_instructors = new WP_Advanced_Search('ajaxform-instructores');
								$search_instructors->the_form(); ?>
							</div>
						</div>
						<div class="col-9_md-8_sm-12">

							<div class="grid">
								<div class="col-8_md-7_sm-12">
									<p><strong>Para los interesados en aprender esta metodología y convertirse en Instructor Certificado VEO</strong></p>
								</div>
								<div class="col-4_md-5_sm-12">
									<a href="<?php echo get_permalink(get_page_by_path('programa-estandar-para-instructores-veo-1')); ?>" class="btn right">Ser Instructor</a>
								</div>
							</div>

							<div id="wpas-results"></div>
						</div>
					</div>

				</footer>

			</article>

			<?php endwhile; endif; ?>

		</div>

	</main>

	<?php //get_sidebar(); ?>



<script>

    /* Light YouTube Embeds by @labnol */
    /* Web: http://labnol.org/?p=27941 */
/*
    document.addEventListener("DOMContentLoaded",
        function() {
            var div, n,
                v = document.getElementsByClassName("youtube-player");
            for (n = 0; n < v.length; n++) {
                div = document.createElement("div");
                div.setAttribute("data-id", v[n].dataset.id);
                div.innerHTML = labnolThumb(v[n].dataset.id);
                div.onclick = labnolIframe;
                v[n].appendChild(div);
            }
        });

    function labnolThumb(id) {
        var thumb = '<img src="https://i.ytimg.com/vi/ID/hqdefault.jpg">',
            play = '<div class="play"></div>';
        return thumb.replace("ID", id) + play;
    }

    function labnolIframe() {
        var iframe = document.createElement("iframe");
        var embed = "https://www.youtube.com/embed/ID?autoplay=1";
        iframe.setAttribute("src", embed.replace("ID", this.dataset.id));
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("allowfullscreen", "1");
        this.parentNode.replaceChild(iframe, this);
    }
*/
</script>



<?php get_footer(); ?>
