<?php
// Template part for displaying posts in the full layout

global $current_template;
$current_template = 'blog-full';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php Elimin8r\Media\Media::postThumbnail( 'large' ); ?>
	</a>

	<div class="article-content">
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->
						
		<div class="entry-content">
			<?php
			the_excerpt();
			
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elimin8r' ),
					'after'  => '</div>',
					)
				);
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->