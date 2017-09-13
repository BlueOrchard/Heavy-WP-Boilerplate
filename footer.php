<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bplate
 */

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bplate' ) ); ?>">Powered by WordPress</a>
			<span class="sep"> | </span>
			Blue's WordPress Boilerplate Theme
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
	$('.submit-email').submit(function(e){
		e.preventDefault();
		var formData = $(this).serialize();

		$.ajax({
			data	: formData,
			url		: "<?php echo get_template_directory_uri().'/email-component/user-signup.php';?>",
			method	: 'POST',
		}).done(function(){
			$('.submit-email').append('<h3 class="thanks">Thanks for Joining!</h3>');
			$('.join-submit').attr("disabled", true);
		});
	})
</script>
<!-- Coded With <3 -->

</body>
</html>
