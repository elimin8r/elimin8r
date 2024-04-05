<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						printf( esc_html__( 'Search Results for: %s', 'elimin8r' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="blog-content">
				<?php
				while ( have_posts() ) :
					the_post();

					$theme = get_theme_mod( 'blog_layout', '' );

					if ( $theme == 'grid' ) {
						get_template_part( 'template-parts/blog', 'grid' );
					} elseif ( $theme == 'compact' ) {
						get_template_part( 'template-parts/blog', 'compact' );
					} else {
						get_template_part( 'template-parts/blog', 'full' );
					}

				endwhile;

				elimin8r_pagination(); ?>
			</div>

			<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
