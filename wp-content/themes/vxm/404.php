<?php get_header(); ?>

			<main id="content">

				<div id="inner-content" class="container">

					<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<article id="post-not-found" class="hentry cf">

							<header class="article-header">

								<h1><?php _e( 'Epic 404 - Article Not Found', 'bonestheme' ); ?></h1>

							</header>

							<section class="entry-content">

								<p><?php //_e( 'The article you were looking for was not found, but maybe try looking again!', 'bonestheme' ); ?></p>

							</section>

							<section class="search">

									<p><?php //get_search_form(); ?></p>

							</section>

							<footer class="article-footer">

									<p><?php// _e( 'This is the 404.php template.', 'bonestheme' ); ?></p>

							</footer>

						</article>

					</div>

				</div>

			</main>

<?php get_footer(); ?>
