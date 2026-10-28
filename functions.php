<?php
/**
 * Masjidul Astra Child - theme functions.
 * Child theme of Astra (Template: astra). All templates are overridden by this
 * theme, so Astra's front-end CSS/JS is dequeued to avoid style conflicts.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MASJIDUL_VERSION', '2.0.0' );

require_once get_stylesheet_directory() . '/inc/data.php';
require_once get_stylesheet_directory() . '/inc/customizer.php';

/* ---------- Helpers ---------- */

function masjidul_asset( $path ) {
	return get_theme_file_uri( 'assets/' . ltrim( $path, '/' ) );
}

function masjidul_mod( $key, $default = '' ) {
	$v = get_theme_mod( $key, $default );
	return ( '' === $v || null === $v || false === $v ) ? $default : $v;
}

/** Media setting: attachment ID or URL from Customizer, otherwise bundled asset. */
function masjidul_media( $key, $default_path ) {
	$v = get_theme_mod( $key );
	if ( $v ) {
		if ( is_numeric( $v ) ) {
			$url = wp_get_attachment_url( (int) $v );
			if ( $url ) {
				return $url;
			}
		} else {
			return $v;
		}
	}
	return masjidul_asset( $default_path );
}

function masjidul_link( $section ) {
	return is_front_page() ? '#' . $section : home_url( '/#' . $section );
}

function masjidul_blog_url() {
	$page = get_page_by_path( 'blog' );
	if ( $page ) {
		return get_permalink( $page );
	}
	$posts_page = (int) get_option( 'page_for_posts' );
	if ( $posts_page ) {
		return get_permalink( $posts_page );
	}
	return home_url( '/' );
}

function masjidul_icon( $name ) {
	$fill = array(
		'github'   => 'M12 .5C5.65.5.5 5.65.5 12c0 5.08 3.29 9.39 7.86 10.91.58.1.79-.25.79-.56v-2c-3.2.7-3.87-1.37-3.87-1.37-.52-1.33-1.28-1.69-1.28-1.69-1.04-.71.08-.7.08-.7 1.15.08 1.76 1.18 1.76 1.18 1.02 1.75 2.68 1.25 3.34.95.1-.74.4-1.25.72-1.54-2.55-.29-5.24-1.28-5.24-5.68 0-1.25.45-2.28 1.18-3.08-.12-.29-.51-1.46.11-3.04 0 0 .97-.31 3.17 1.18a11 11 0 0 1 5.77 0c2.2-1.49 3.17-1.18 3.17-1.18.62 1.58.23 2.75.11 3.04.74.8 1.18 1.83 1.18 3.08 0 4.41-2.69 5.38-5.25 5.67.41.36.78 1.06.78 2.14v3.17c0 .31.21.67.8.56A11.5 11.5 0 0 0 23.5 12C23.5 5.65 18.35.5 12 .5z',
		'linkedin' => 'M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zM7.12 20.45H3.56V9h3.56v11.45z',
	);
	$stroke = array(
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
		'download' => '<path d="M12 4v11m0 0-4-4m4 4 4-4M5 20h14"/>',
		'arrow'    => '<path d="M7 17 17 7M8 7h9v9"/>',
		'globe'    => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c3 3.2 3 14.8 0 18M12 3c-3 3.2-3 14.8 0 18"/>',
		'phone'    => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/>',
		'whatsapp' => '<path d="M3 21l1.6-4.7A8.5 8.5 0 1 1 8 19.6L3 21z"/><path d="M9 9.5c0 3 2.5 5.5 5.5 5.5l1.2-1.4-2-1-.8.8a4 4 0 0 1-2-2l.8-.8-1-2L9 9.5z"/>',
		'pin'      => '<path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
		'doc'      => '<path d="M6 3h8l4 4v14H6zM14 3v4h4M9 12h6M9 16h6"/>',
	);
	if ( isset( $fill[ $name ] ) ) {
		return '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="' . esc_attr( $fill[ $name ] ) . '"/></svg>';
	}
	if ( isset( $stroke[ $name ] ) ) {
		return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $stroke[ $name ] . '</svg>';
	}
	return '';
}

/** Social/contact values (Customizer with sensible defaults). */
function masjidul_contact() {
	$phone = masjidul_mod( 'phone', '' );
	$wa    = preg_replace( '/\D+/', '', (string) masjidul_mod( 'whatsapp', '' ) );
	return array(
		'email'     => masjidul_mod( 'email', 'masjidulislam17@gmail.com' ),
		'github'    => masjidul_mod( 'github', 'https://github.com/Masjidul-60' ),
		'linkedin'  => masjidul_mod( 'linkedin', 'https://www.linkedin.com/in/masjidul-islam-8a5140354/' ),
		'phone'     => $phone,
		'whatsapp'  => $wa ? 'https://wa.me/' . $wa : '',
		'location'  => masjidul_mod( 'location', 'Bogura, Bangladesh' ),
	);
}

/** CV link: Customizer upload, else the bundled PDF if it exists, else empty (button is hidden). */
function masjidul_cv_url() {
	$v = get_theme_mod( 'cv_file' );
	if ( $v ) {
		$url = is_numeric( $v ) ? wp_get_attachment_url( (int) $v ) : $v;
		if ( $url ) {
			return $url;
		}
	}
	if ( file_exists( get_theme_file_path( 'assets/docs/Md-Masjidul-Islam-CV.pdf' ) ) ) {
		return masjidul_asset( 'docs/Md-Masjidul-Islam-CV.pdf' );
	}
	return '';
}

/** One navigation list, used by the header and the footer. */
function masjidul_nav_items() {
	return array(
		'home'         => 'Home',
		'about'        => 'About',
		'education'    => 'Education',
		'research'     => 'Research',
		'publications' => 'Publications',
		'projects'     => 'Projects',
		'skills'       => 'Skills',
		'gallery'      => 'Gallery',
		'achievements' => 'Achievements',
		'contact'      => 'Contact',
	);
}

function masjidul_sanitize_bool( $v ) {
	return (bool) $v;
}

/* ---------- Setup ---------- */

function masjidul_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 60, 'width' => 200, 'flex-width' => true, 'flex-height' => true ) );
	register_nav_menus( array( 'masjidul_primary' => 'Portfolio menu (optional, replaces the built-in menu)' ) );
	add_image_size( 'masjidul-card', 800, 500, true );
}
add_action( 'after_setup_theme', 'masjidul_setup' );

function masjidul_scripts() {
	wp_enqueue_style( 'masjidul-fonts', 'https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Manrope:wght@400;500;600;700;800&display=swap', array(), null );
	wp_enqueue_style( 'masjidul-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
	wp_enqueue_script( 'masjidul-main', masjidul_asset( 'js/main.js' ), array(), filemtime( get_stylesheet_directory() . '/assets/js/main.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'masjidul_scripts' );

/** Our templates replace Astra's markup, so Astra's own front-end CSS/JS is not needed. */
function masjidul_drop_parent_assets() {
	if ( apply_filters( 'masjidul_keep_astra_assets', false ) ) {
		return;
	}
	foreach ( array( 'astra-theme-css', 'astra-addon-css', 'astra-theme-js', 'astra-google-fonts', 'astra-addon-js' ) as $handle ) {
		wp_dequeue_style( $handle );
		wp_dequeue_script( $handle );
	}
}
add_action( 'wp_enqueue_scripts', 'masjidul_drop_parent_assets', 999 );

/**
 * Old generic pages (About, Services, Portfolio, Contact) are replaced by sections of the new
 * home page. Visitors are sent to the matching section. Pages are NOT deleted or changed.
 * Disable in Customize > Portfolio Settings > Header and behavior.
 */
function masjidul_legacy_redirects() {
	if ( is_admin() || is_customize_preview() || ! is_page() || is_front_page() ) {
		return;
	}
	if ( ! masjidul_mod( 'redirect_legacy', true ) ) {
		return;
	}
	$map = apply_filters( 'masjidul_legacy_page_map', array(
		'home'      => 'home',
		'about'     => 'about',
		'services'  => 'research',
		'portfolio' => 'projects',
		'contact'   => 'contact',
	) );
	$obj = get_queried_object();
	if ( $obj && ! empty( $obj->post_name ) && empty( $obj->post_parent ) && isset( $map[ $obj->post_name ] ) ) {
		wp_safe_redirect( home_url( '/#' . $map[ $obj->post_name ] ), 302 );
		exit;
	}
}
add_action( 'template_redirect', 'masjidul_legacy_redirects' );

function masjidul_resource_hints( $urls, $relation ) {
	if ( 'preconnect' === $relation ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'masjidul_resource_hints', 10, 2 );

/* ---------- Head: favicon, meta, structured data ---------- */

function masjidul_head() {
	echo '<meta name="theme-color" content="#050608">' . "\n";
	if ( ! has_site_icon() ) {
		echo '<link rel="icon" href="' . esc_url( masjidul_asset( 'img/favicon.svg' ) ) . '" type="image/svg+xml">' . "\n";
	}
	if ( ! is_front_page() || defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return;
	}
	$c    = masjidul_contact();
	$desc = 'Academic portfolio of Md. Masjidul Islam, a Computer Science and Engineering student researching EEG signal reconstruction, motor-imagery BCI, and AI for neurorehabilitation.';
	$img  = masjidul_asset( 'img/og-image.jpg' );
	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:type" content="profile">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( 'Md. Masjidul Islam | Research Portfolio' ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:image" content="' . esc_url( $img ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( home_url( '/' ) ) . '">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Person',
		'name'        => 'Md. Masjidul Islam',
		'jobTitle'    => 'Computer Science and Engineering student and researcher',
		'url'         => home_url( '/' ),
		'image'       => masjidul_media( 'hero_photo', 'img/portrait.jpg' ),
		'email'       => $c['email'],
		'affiliation' => array( '@type' => 'CollegeOrUniversity', 'name' => 'Pundra University of Science & Technology' ),
		'knowsAbout'  => array( 'EEG', 'Brain-computer interfaces', 'Biomedical signal processing', 'Generative AI', 'Neurorehabilitation', 'Machine learning' ),
		'sameAs'      => array_values( array_filter( array( $c['github'], $c['linkedin'] ) ) ),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'masjidul_head', 5 );

function masjidul_front_title( $title ) {
	if ( is_front_page() ) {
		return 'Md. Masjidul Islam | Research Portfolio';
	}
	return $title;
}
add_filter( 'pre_get_document_title', 'masjidul_front_title' );

function masjidul_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'masjidul_excerpt_more' );

function masjidul_excerpt_length() {
	return 24;
}
add_filter( 'excerpt_length', 'masjidul_excerpt_length' );

/* ---------- Contact form handler ---------- */

function masjidul_handle_contact() {
	$back = wp_get_referer();
	$back = $back ? strtok( $back, '#' ) : home_url( '/' );
	$back = remove_query_arg( 'contact', $back );
	$fail = add_query_arg( 'contact', 'error', $back ) . '#contact';
	$ok   = add_query_arg( 'contact', 'sent', $back ) . '#contact';

	$nonce = isset( $_POST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'masjidul_contact' ) ) {
		wp_safe_redirect( $fail );
		exit;
	}
	// Honeypot: bots fill this in. Pretend success.
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( $ok );
		exit;
	}
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'x';
	$key = 'masjidul_rl_' . md5( $ip );
	if ( get_transient( $key ) ) {
		wp_safe_redirect( $fail );
		exit;
	}

	$name    = isset( $_POST['cname'] ) ? sanitize_text_field( wp_unslash( $_POST['cname'] ) ) : '';
	$email   = isset( $_POST['cemail'] ) ? sanitize_email( wp_unslash( $_POST['cemail'] ) ) : '';
	$subject = isset( $_POST['csubject'] ) ? sanitize_text_field( wp_unslash( $_POST['csubject'] ) ) : '';
	$message = isset( $_POST['cmessage'] ) ? sanitize_textarea_field( wp_unslash( $_POST['cmessage'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || strlen( $message ) < 10 ) {
		wp_safe_redirect( $fail );
		exit;
	}

	$c       = masjidul_contact();
	$to      = is_email( $c['email'] ) ? $c['email'] : get_option( 'admin_email' );
	$subject = '' !== $subject ? $subject : 'New message from your portfolio';
	$body    = "Name: {$name}\nEmail: {$email}\n\n{$message}\n";
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, '[Portfolio] ' . $subject, $body, $headers );
	if ( $sent ) {
		set_transient( $key, 1, 60 );
		wp_safe_redirect( $ok );
	} else {
		wp_safe_redirect( $fail );
	}
	exit;
}
add_action( 'admin_post_nopriv_masjidul_contact', 'masjidul_handle_contact' );
add_action( 'admin_post_masjidul_contact', 'masjidul_handle_contact' );

/* ---------- Pagination helper ---------- */

function masjidul_pagination() {
	$links = paginate_links( array( 'type' => 'array', 'prev_text' => '←', 'next_text' => '→' ) );
	if ( $links ) {
		echo '<nav class="pagination" aria-label="Posts">' . implode( '', $links ) . '</nav>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
}
