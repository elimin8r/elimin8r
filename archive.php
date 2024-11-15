<?php
get_header();
?>

	<main id="primary" class="site-main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
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

				endwhile; ?>
			</div>

			<?php
			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;

			Elimin8r\Pagination\Pagination::getPagination();
			?>
		</div>
	</main><!-- #main -->

<?php
get_footer();
