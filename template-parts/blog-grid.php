<?php
// Template part for displaying posts in a grid layout

global $current_template;
$current_template = 'blog-grid';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php echo esc_url( get_permalink() ); ?>">
		<?php Elimin8r\Media\Media::postThumbnail( 'medium' ); ?>
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
	</div><!-- .article-content -->
</article><!-- #post-<?php the_ID(); ?> -->