<?php
/**
 * Template Name: Blog
 * Create a page called "Blog" (slug: blog) with this template to list all posts.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
$q     = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged, 'ignore_sticky_posts' => true ) );
?>
<section class="page-hero"><div class="wrap"><h1><?php the_title(); ?></h1></div></section>
<section class="inner">
	<div class="wrap">
		<?php if ( $q->have_posts() ) : ?>
			<div class="posts">
				<?php
				while ( $q->have_posts() ) {
					$q->the_post();
					get_template_part( 'template-parts/post-card' );
				}
				?>
			</div>
			<?php
			$links = paginate_links( array( 'total' => $q->max_num_pages, 'current' => $paged, 'type' => 'array', 'prev_text' => '←', 'next_text' => '→' ) );
			if ( $links ) {
				echo '<nav class="pagination" aria-label="Posts">' . implode( '', $links ) . '</nav>'; // phpcs:ignore
			}
			wp_reset_postdata();
			?>
		<?php else : ?>
			<p class="muted">No posts yet.</p>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
