<?php
get_header();
?>

	<main id="primary" class="site-main" style="background: <?php echo get_theme_mod( 'content_color', '#ffffff' ); ?>">

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
