<?php
get_header();
?>

	<main id="primary" class="site-main" style="background: <?php echo get_theme_mod( 'content_color', '#ffffff' ); ?>">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

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

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();