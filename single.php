<?php
get_header();
?>

	<div id="primary" class="site-main">
		<main class="site-content">
			<?php Elimin8r\Breadcrumbs\Breadcrumbs::getBreadcrumbs(); ?>
			
			<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'elimin8r' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'elimin8r' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile;
			?>
		</main><!-- .site-content -->

		<?php
			get_sidebar();
		?>
	</div><!-- .site-main -->

<?php
get_footer();
