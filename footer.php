<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
	$footer = get_field("footer");
	
?>

	<footer id="footer" class="site-footer">
		<?php
		if ($footer == "footer2"):
				$data = get_field( "footer2", "option" );

			if ($data):
			
			?>
			<div class="site-info footer2">
				<div class="container">
					<?php echo $data; ?>
				</div>
			</div>
			<?php
			endif;
		else: 
		?>
		<div class="top-footer">
			<div class="container">
				<div class="columns">
					<div class="column">
						<?php $data = get_field("footer_left", "option"); 
						if ($data) {
							echo $data;
						}
						?>
					</div>
					<div class="column">
						<?php
							$data = get_field( "footer_right", "option");

							if ($data) {
								echo do_shortcode($data);
							}
						?>
					</div>
				</div>
			</div>
		</div>

		<div class="site-info">
			<p class="container">
			<?php 
			$data = get_field( "footer_bottom", "option" );

			if ($data) {
				echo $data;
			}
			?>
			</p>
		</div><!-- .site-info -->
		<?php

		endif; ?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
