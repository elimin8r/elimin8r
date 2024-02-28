<?php
get_header();
?>

	<main id="primary" class="site-main" style="background: <?php echo whitelabel_hex_opacity( get_theme_mod( 'content_color', '#ffffff' ), get_theme_mod( 'content_transparency', '0' ) ); ?>">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
