<?php
// Template part for displaying posts
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				Elimin8r\PostMeta\PostMeta::postedOn();
				Elimin8r\PostMeta\PostMeta::postedBy();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php
		$header_position = get_theme_mod( 'header_position', 'top' );

		// If the featured image is not set to full width then display the featured image
		if ( is_single() && ! get_post_meta( get_the_ID(), '_featured_image_checkbox', true ) || $header_position != 'top') {
			Elimin8r\Media\Media::postThumbnail( 'large' );
		}
	?>

	<div class="entry-content">
		<?php
			if ( is_singular() ) :
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'elimin8r' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			else :
				the_excerpt();
			endif;

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elimin8r' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php Elimin8r\PostMeta\PostMeta::EntryFooter(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->