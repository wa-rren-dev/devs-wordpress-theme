<?php
/**
 * Set up theme defaults and registers support for various WordPress feaures.
 */
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

function twentynineteen_comment_form_defaults( $defaults ) {
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );

	return $defaults;
}
add_filter( 'comment_form_defaults', 'twentynineteen_comment_form_defaults' );

/**
 * Returns information about the current post's discussion, with cache support.
 */
function twentynineteen_get_discussion_data() {
	static $discussion, $post_id;

	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}

	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
		)
	);

	$authors = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}

	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);

	return $discussion;
}
