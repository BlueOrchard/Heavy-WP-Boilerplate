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
		$('.join-submit').attr("disabled", true);
		$('.submit-email').append('<h3 class="submit-status">Submitting...</h3>');

		$.ajax({
			data	: formData,
			url		: "<?php echo get_template_directory_uri().'/email-component/user-signup.php';?>",
			method	: 'POST',
		}).done(function(){
			$('.submit-status').text('Thanks for Joining!');
			$('.join-submit').attr("disabled", true);
		});
	});

	$('.mobile-nav-button').on('click', function(){
		$(this).toggleClass('active-nav');
		$('.main-navigation').toggleClass('active-main');
	});
</script>
<!-- Coded With <3 -->

</body>
</html>
