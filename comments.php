<?php
if ( ! defined( 'ABSPATH' ) || post_password_required() ) {
	return;
}
if ( have_comments() ) {
	echo '<h2>Comments</h2><ol class="comment-list">';
	wp_list_comments( array( 'style' => 'ol', 'short_ping' => true ) );
	echo '</ol>';
	the_comments_navigation();
}
comment_form();
