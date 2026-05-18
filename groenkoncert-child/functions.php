<?php

/* Indlæser parent theme og child theme CSS gennem WordPress’ enqueue-system,
så child theme CSS bliver indlæst efter parent theme CSS */
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

/* Sørger for at WordPress kører styles-funktionen i enqueue-systemet */
add_action( 'wp_enqueue_scripts', 'groenkoncert_child_enqueue_styles', 20 );

/* Indlæser child theme JavaScript gennem WordPress’ enqueue-system,
så scriptet bliver indlæst efter jQuery og parent theme-scriptet */
function groenkoncert_child_enqueue_scripts() {
	wp_enqueue_script(
		'groenkoncert-child-main',
		get_stylesheet_directory_uri() . '/assets/js/child-main.js',
		array( 'jquery', 'main' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}

/* Sørger for at WordPress kører JavaScript-funktionen i enqueue-systemet */
add_action( 'wp_enqueue_scripts', 'groenkoncert_child_enqueue_scripts', 30 );
