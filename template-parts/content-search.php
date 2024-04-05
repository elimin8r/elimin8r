<?php
// Template part for displaying search results in a compact layout

global $current_template;
$current_template = 'blog-compact';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php elimin8r_post_thumbnail( 'medium' ); ?>
	</a>

	<div class="article-content">
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	
			<div class="entry-meta">
				<?php
					elimin8r_posted_on();
					elimin8r_posted_by();
				?>
			</div><!-- .entry-meta -->
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