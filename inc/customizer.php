<?php
/**
 * Customizer: Appearance > Customize > Portfolio Settings.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function masjidul_customize( $wp_customize ) {
	$wp_customize->add_panel( 'masjidul_panel', array( 'title' => 'Portfolio Settings', 'priority' => 20 ) );

	$add = function ( $section, $id, $label, $type, $default, $sanitize, $desc = '' ) use ( $wp_customize ) {
		$wp_customize->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => $sanitize, 'transport' => 'refresh' ) );
		$wp_customize->add_control( $id, array( 'section' => $section, 'label' => $label, 'type' => $type, 'description' => $desc ) );
	};
	$media = function ( $section, $id, $label, $mime, $desc = '' ) use ( $wp_customize ) {
		$wp_customize->add_setting( $id, array( 'default' => '', 'sanitize_callback' => 'absint' ) );
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $id, array(
			'section'     => $section,
			'label'       => $label,
			'mime_type'   => $mime,
			'description' => $desc,
		) ) );
	};

	/* Header and behavior */
	$wp_customize->add_section( 'masjidul_header', array( 'title' => 'Header and behavior', 'panel' => 'masjidul_panel', 'priority' => 5 ) );
	$add( 'masjidul_header', 'brand_text', 'Name shown in the header', 'text', 'Masjidul Islam', 'sanitize_text_field' );
	$add( 'masjidul_header', 'use_logo_image', 'Show the Site Identity logo image instead of the text name', 'checkbox', false, 'masjidul_sanitize_bool', 'Off by default. A dark logo on this black header is hard to read, and the image is limited to 34px high.' );
	$add( 'masjidul_header', 'redirect_legacy', 'Send old pages (About, Services, Portfolio, Contact) to the matching section on the home page', 'checkbox', true, 'masjidul_sanitize_bool', 'The pages are not deleted. Turn this off to open them normally.' );

	/* Hero text */
	$wp_customize->add_section( 'masjidul_hero', array( 'title' => 'Hero text', 'panel' => 'masjidul_panel', 'priority' => 10 ) );
	$add( 'masjidul_hero', 'hero_role', 'Line above the name', 'text', 'Computer Science & Engineering student · EEG and AI research', 'sanitize_text_field' );
	$add( 'masjidul_hero', 'hero_name', 'Name', 'text', 'Md. Masjidul Islam', 'sanitize_text_field' );
	$add( 'masjidul_hero', 'hero_intro', 'Intro paragraph', 'textarea', 'I am interested in biomedical signal processing and machine learning, particularly EEG reconstruction and motor-imagery brain-computer interfaces. My long-term goal is to pursue advanced research in AI for neurorehabilitation.', 'sanitize_textarea_field' );
	$add( 'masjidul_hero', 'hero_photo_caption', 'Photo caption', 'text', 'RURS 2nd International Conference, 2023', 'sanitize_text_field' );

	/* Media */
	$wp_customize->add_section( 'masjidul_media', array( 'title' => 'Photos, video and CV', 'panel' => 'masjidul_panel', 'priority' => 20, 'description' => 'Leave empty to use the images, video and CV bundled with the theme.' ) );
	$media( 'masjidul_media', 'hero_photo', 'Hero photo (portrait, about 5:6)', 'image' );
	$media( 'masjidul_media', 'about_photo', 'About photo (square)', 'image' );
	$media( 'masjidul_media', 'hero_video', 'Hero background video (MP4)', 'video', 'Short, silent, looping clip under 5 MB works best.' );
	$media( 'masjidul_media', 'hero_poster', 'Hero video poster image', 'image' );
	$media( 'masjidul_media', 'cv_file', 'CV (PDF)', 'application/pdf' );
	$media( 'masjidul_media', 'goals_bg', 'Graduate goals background image', 'image' );
	$d = masjidul_data();

	/* Real photos for the gallery */
	$wp_customize->add_section( 'masjidul_photos', array( 'title' => 'Gallery: your real photos', 'panel' => 'masjidul_panel', 'priority' => 25, 'description' => 'Add real conference, poster or lab photos here. They appear first in the gallery and are shown uncropped. The same image is never shown twice.' ) );
	for ( $i = 1; $i <= 6; $i++ ) {
		$media( 'masjidul_photos', 'photo_' . $i, 'Photo ' . $i, 'image' );
		$add( 'masjidul_photos', 'photo_' . $i . '_caption', 'Caption for photo ' . $i, 'text', '', 'sanitize_text_field' );
	}

	/* Contact & social */
	$wp_customize->add_section( 'masjidul_contact', array( 'title' => 'Contact and social links', 'panel' => 'masjidul_panel', 'priority' => 30 ) );
	$add( 'masjidul_contact', 'email', 'Email (the contact form sends here)', 'email', 'masjidulislam17@gmail.com', 'sanitize_email' );
	$add( 'masjidul_contact', 'github', 'GitHub URL', 'url', 'https://github.com/Masjidul-60', 'esc_url_raw' );
	$add( 'masjidul_contact', 'linkedin', 'LinkedIn URL', 'url', 'https://www.linkedin.com/in/masjidul-islam-8a5140354/', 'esc_url_raw' );
	$add( 'masjidul_contact', 'location', 'Location text', 'text', 'Bogura, Bangladesh', 'sanitize_text_field' );
	$add( 'masjidul_contact', 'phone', 'Phone (optional, shown publicly)', 'text', '', 'sanitize_text_field', 'Empty by default for privacy.' );
	$add( 'masjidul_contact', 'whatsapp', 'WhatsApp number (optional, digits with country code)', 'text', '', 'sanitize_text_field', 'Example: 8801516336236' );

	/* Project repo links */
	$wp_customize->add_section( 'masjidul_projects', array( 'title' => 'Project links', 'panel' => 'masjidul_panel', 'priority' => 40, 'description' => 'Paste each project’s GitHub repository URL. Empty means no link is shown.' ) );
	foreach ( $d['projects'] as $p ) {
		$add( 'masjidul_projects', 'repo_' . $p['slug'], $p['title'] . ' repository', 'url', '', 'esc_url_raw' );
	}

	/* Footer */
	$wp_customize->add_section( 'masjidul_footer', array( 'title' => 'Footer', 'panel' => 'masjidul_panel', 'priority' => 50 ) );
	$add( 'masjidul_footer', 'footer_text', 'Footer text', 'text', 'Md. Masjidul Islam', 'sanitize_text_field' );
}
add_action( 'customize_register', 'masjidul_customize' );
