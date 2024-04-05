<?php
get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<span>404</span>
				
				<h1 class="page-title"><?php esc_html_e( 'Whoops! That page can&rsquo;t be found.', 'elimin8r' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'Perhaps the search below will help you find what you\'re looking for?', 'elimin8r' ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

		<?php $pages = get_pages(); ?>
			<?php if ( $pages ) : ?>
				<section class="page-links">
					<p><?php esc_html_e( 'Below are some of our other pages that may be useful?', 'elimin8r' ); ?></p>
					<ul>
						<?php foreach ( $pages as $page ) :	?>
							<li><a href="<?php echo esc_url( get_page_link( $page->ID ) ); ?>"><?php echo esc_html( $page->post_title ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</section><!-- .page-links -->
			<?php endif; ?>

	</main><!-- #main -->

<?php
get_footer();
