<?php
/**
 * Enqueue parent theme styles in child theme.
 */
function groenkoncert_child_enqueue_styles() {
	wp_enqueue_style(
		'groenkoncert-parent-style',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( get_template() )->get( 'Version' )
	);

	wp_enqueue_style(
		'groenkoncert-child-style',
		get_stylesheet_uri(),
		array( 'groenkoncert-parent-style' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'groenkoncert_child_enqueue_styles', 20 );

/**
 * Enqueue child JavaScript after parent "main" script.
 */
function groenkoncert_child_enqueue_scripts() {
	wp_enqueue_script(
		'groenkoncert-child-main',
		get_stylesheet_directory_uri() . '/assets/js/child-main.js',
		array( 'jquery', 'main' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'groenkoncert_child_enqueue_scripts', 30 );
