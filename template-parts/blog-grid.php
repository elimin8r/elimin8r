<?php
// Template part for displaying posts in a grid layout

global $current_template;
$current_template = 'blog-grid';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php echo esc_url( get_permalink() ); ?>">
		<div class="article-content">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php
						whitelabel_posted_on();
						whitelabel_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
		</div>

		<?php whitelabel_post_thumbnail( 'medium' ); ?>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->