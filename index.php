<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="page-hero">
	<div class="wrap">
		<h1>
			<?php
			if ( is_search() ) {
				printf( 'Search: %s', esc_html( get_search_query() ) );
			} elseif ( is_archive() ) {
				echo esc_html( wp_strip_all_tags( get_the_archive_title() ) );
			} else {
				echo 'Blog';
			}
			?>
		</h1>
	</div>
</section>
<section class="inner">
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
			<div class="posts">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/post-card' );
				}
				?>
			</div>
			<?php masjidul_pagination(); ?>
		<?php else : ?>
			<p class="muted">Nothing here yet.</p>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
