<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="site-page">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'whitelabel' ); ?></a>

	<header id="masthead" class="site-header header-<?php echo get_theme_mod( 'header_position', 'top' ); ?>" style="background: <?php echo get_theme_mod( 'header_color', '#ffffff' ); ?>">
		<div class="header-content">
			<div class="site-branding">
				<?php the_custom_logo(); ?>

				<?php if ( is_front_page() || is_home() ) : ?>
					<h1 class="site-title <?php echo has_custom_logo() ? 'title-hidden' : ''; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<?php if ( ! has_custom_logo( ) ) : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
				<?php endif;

				$whitelabel_description = get_bloginfo( 'description', 'display' );
				if ( $whitelabel_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $whitelabel_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'whitelabel' ); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->

			<?php if ( get_theme_mod( 'enable_search', true ) ) : ?>
				<div class="site-search">
					<button class="search-toggle">
						<?php echo file_get_contents( get_template_directory_uri() . '/dist/images/search.svg' ); ?>
					</button>

					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
		</div>
	</header><!-- #masthead -->
