<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			?> <div class="blog-content"> <?php
			
			get_template_part( 'template-parts/blog', 'sticky' );

			while ( have_posts() ) :
				the_post();

				// Exlude sticky posts from the main loop
				if ( is_sticky() ) {
					continue;
				}

				$theme = get_theme_mod( 'blog_layout', '' );

				if ( $theme == 'grid' ) {
					get_template_part( 'template-parts/blog', 'grid' );
				} elseif ( $theme == 'compact' ) {
					get_template_part( 'template-parts/blog', 'compact' );
				} else {
					get_template_part( 'template-parts/blog', 'full' );
				}

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
get_footer();
