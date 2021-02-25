<?php

add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {

  if (! preg_match('/( |^)[^ ]+@mydomain\.co\.uk( |$)/', $user_email )) {
    $errors->add( 'invalid_email', __( 'ERROR: Only valid "mydomain" email address is allowed.' ));
    $user_email = '';
  }

  return $errors;
}

add_action( 'after_setup_theme', function() {
	load_theme_textdomain( 'bathe', get_theme_file_uri( 'languages' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
} );

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'bathe-main', get_theme_file_uri( 'assets/css/main.css' ) );
	wp_enqueue_script( 'bathe-bundle', get_theme_file_uri( 'assets/js/bundle.js' ), array(), null, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} );

show_admin_bar(false);

/**
 * Pluralizes a word if quantity is not one.
 *
 * @param int $quantity Number of items
 * @param string $singular Singular form of word
 * @param string $plural Plural form of word; function will attempt to deduce plural form from singular if not provided
 * @return string Pluralized word if quantity is not one, otherwise singular
 */
function pluralize($quantity, $singular, $plural=null) {
	if($quantity==1 || !strlen($singular)) return $singular;
	if($plural!==null) return $plural;

	$last_letter = strtolower($singular[strlen($singular)-1]);
	switch($last_letter) {
		case 'y':
			return substr($singular,0,-1).'ies';
		case 's':
			return $singular.'es';
		default:
			return $singular.'s';
	}
}

function plc_comment_post( $incoming_comment ) {
	$incoming_comment['comment_content'] = htmlspecialchars($incoming_comment['comment_content']);
	$incoming_comment['comment_content'] = str_replace( "'", '&apos;', $incoming_comment['comment_content'] );
	return( $incoming_comment );
}

function plc_comment_display( $comment_to_display ) {
	$comment_to_display = str_replace( '&apos;', "'", $comment_to_display );
	return $comment_to_display;
}

add_filter( 'preprocess_comment', 'plc_comment_post', '', 1);
add_filter( 'comment_text', 'plc_comment_display', '', 1);
add_filter( 'comment_text_rss', 'plc_comment_display', '', 1);
add_filter( 'comment_excerpt', 'plc_comment_display', '', 1);
