<?php
// Template part for displaying posts in the full layout

global $current_template;
$current_template = 'blog-full';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		 <?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				whitelabel_posted_on();
				whitelabel_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php whitelabel_post_thumbnail( 'large' ); ?>
	</a>

	<div class="entry-content">
		<?php
			the_excerpt();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'whitelabel' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php whitelabel_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->