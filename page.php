<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
while ( have_posts() ) :
	the_post();
	?>
<section class="page-hero"><div class="wrap"><h1><?php the_title(); ?></h1></div></section>
<section class="inner">
	<div class="wrap">
		<article <?php post_class( 'prose' ); ?>><?php the_content(); ?></article>
	</div>
</section>
<?php endwhile; get_footer(); ?>
