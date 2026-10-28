<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
while ( have_posts() ) :
	the_post();
	?>
<section class="page-hero">
	<div class="wrap">
		<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		<h1><?php the_title(); ?></h1>
	</div>
</section>
<section class="inner">
	<div class="wrap">
		<article <?php post_class( 'prose' ); ?>>
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'large' );
			}
			the_content();
			wp_link_pages();
			?>
		</article>
		<?php if ( comments_open() || get_comments_number() ) : ?>
			<div class="prose"><?php comments_template(); ?></div>
		<?php endif; ?>
	</div>
</section>
<?php endwhile; get_footer(); ?>
