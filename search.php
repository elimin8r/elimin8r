<?php
get_header();
?>

	<main id="primary" class="site-main" style="background: <?php echo whitelabel_hex_opacity( get_theme_mod( 'content_color', '#ffffff' ), get_theme_mod( 'content_transparency', '0' ) ); ?>">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						printf( esc_html__( 'Search Results for: %s', 'whitelabel' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="blog-content">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				whitelabel_pagination(); ?>
			</div>

			<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
