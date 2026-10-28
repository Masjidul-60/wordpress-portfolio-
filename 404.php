<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="nf">
	<div class="wrap">
		<h1>404</h1>
		<p class="muted">This page could not be found.</p>
		<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to home</a>
	</div>
</section>
<?php get_footer(); ?>
