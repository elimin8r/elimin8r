<?php
$header_position = get_theme_mod( 'header_position', 'top' );
?>

</div><!-- #page -->

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<?php echo wp_kses_post( get_theme_mod( 'footer_text', '' ) ); ?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
