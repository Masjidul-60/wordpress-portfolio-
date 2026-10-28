<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$brand_text = masjidul_mod( 'brand_text', 'Masjidul Islam' );
$logo_id    = (int) get_theme_mod( 'custom_logo' );
$use_logo   = masjidul_mod( 'use_logo_image', false ) && $logo_id;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header" id="site-header">
	<div class="wrap">
		<a class="brand" href="<?php echo esc_url( masjidul_link( 'home' ) ); ?>" aria-label="<?php echo esc_attr( $brand_text ); ?> - home">
			<?php if ( $use_logo ) : ?>
				<?php echo wp_get_attachment_image( $logo_id, 'medium', false, array( 'class' => 'brand__img', 'alt' => $brand_text ) ); ?>
			<?php else : ?>
				<svg class="brand__mark" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><rect width="64" height="64" rx="14" fill="#10131a"/><path d="M6 36h10l6-18 8 30 7-24 5 12h16" fill="none" stroke="#6ea8ff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
				<span><?php echo esc_html( $brand_text ); ?></span>
			<?php endif; ?>
		</a>
		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Open menu"><span></span></button>
		<nav class="nav" id="site-nav" aria-label="Primary">
			<?php
			if ( has_nav_menu( 'masjidul_primary' ) ) {
				wp_nav_menu( array( 'theme_location' => 'masjidul_primary', 'container' => false, 'depth' => 1 ) );
			} else {
				echo '<ul>';
				foreach ( masjidul_nav_items() as $id => $label ) {
					echo '<li><a href="' . esc_url( masjidul_link( $id ) ) . '" data-spy="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</a></li>';
				}
				echo '</ul>';
			}
			?>
		</nav>
	</div>
</header>
<main id="main">
