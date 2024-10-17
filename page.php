<?php
get_header();
?>

	<div id="primary" class="site-main">
		<main class="site-content">
			<?php Elimin8r\Breadcrumbs\Breadcrumbs::getBreadcrumbs(); ?>
			
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile;
			?>
		</main><!-- .site-content -->
	</div><!-- .site-main -->

<?php
get_footer();
