<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package belmarco
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="row">
					<div class="col-xs-3 col-md-2 col-md-offset-2">
						<img src=<?php echo get_template_directory_uri(). "/img/belmaric-404.png";?> class="belmaric-404 img-responsive center-block">
					</div>
					<div class="col-xs-9 col-md-5">
						<header class="page-header">
							<h1 class="page-title">Ошибка <span>404</span></h1>
							<p>Запрашиваемая Вами страница не найдена</p>
						</header><!--/.page-header-->

						<div class="page-content">
							<p>Пожалуйста, перейдите на<br /><a href="/" class="fs18 c_92bf2b"><b>главную страницу сайта</b></a></p>
							<p>или воспользуйтесь формой поиска:</p>

							<?php
								get_search_form();
							?>


						</div><!-- .page-content -->
					</div>
				</div><!--/.row-->
			</section><!--/.error-404-->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
