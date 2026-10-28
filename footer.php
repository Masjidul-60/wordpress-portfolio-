<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$c = masjidul_contact();
?>
</main>
<footer class="site-footer">
	<div class="wrap">
		<nav class="footer-nav" aria-label="Footer">
			<ul>
				<?php foreach ( masjidul_nav_items() as $id => $label ) : ?>
					<li><a href="<?php echo esc_url( masjidul_link( $id ) ); ?>"><?php echo esc_html( $label ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>
		<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( masjidul_mod( 'footer_text', 'Md. Masjidul Islam' ) ); ?>. Research portfolio.</p>
		<div class="social">
			<?php if ( $c['github'] ) : ?><a href="<?php echo esc_url( $c['github'] ); ?>" aria-label="GitHub" target="_blank" rel="noopener"><?php echo masjidul_icon( 'github' ); // phpcs:ignore ?></a><?php endif; ?>
			<?php if ( $c['linkedin'] ) : ?><a href="<?php echo esc_url( $c['linkedin'] ); ?>" aria-label="LinkedIn" target="_blank" rel="noopener"><?php echo masjidul_icon( 'linkedin' ); // phpcs:ignore ?></a><?php endif; ?>
			<?php if ( $c['email'] ) : ?><a href="mailto:<?php echo esc_attr( antispambot( $c['email'] ) ); ?>" aria-label="Email"><?php echo masjidul_icon( 'mail' ); // phpcs:ignore ?></a><?php endif; ?>
		</div>
		<a href="<?php echo esc_url( masjidul_link( 'home' ) ); ?>">Back to top ↑</a>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
