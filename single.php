<?php
get_header();
?>

	<main id="primary" class="site-main" style="background: <?php echo whitelabel_hex_opacity( get_theme_mod( 'content_color', '#ffffff' ), get_theme_mod( 'content_transparency', '0' ) ); ?>">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'whitelabel' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'whitelabel' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
