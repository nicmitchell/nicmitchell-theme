<?php if ( is_home() ) : ?>
	<div id="pre-footer">
		<div class="container">
			<p class="tagline"><?php bloginfo( 'description' ); ?></p>

			<br />

			<?php et_vertex_action_button(); ?>
		</div> <!-- .container -->
	</div> <!-- #pre-footer -->
<?php endif; ?>

	<footer id="main-footer">
		<div class="container">
			<?php get_sidebar( 'footer' ); ?>

			<p id="footer-info"><?php printf( __( 'Copyright © 2014 %1$s | %2$s', 'Vertex' ), '<a href="http://nicmitchell.com" title="Premium WordPress Themes">nicmitchell.com</a>', 'All Rights Reserved' ); ?></p>
		</div> <!-- .container -->
	</footer> <!-- #main-footer -->

	<?php wp_footer(); ?>
</body>
</html>