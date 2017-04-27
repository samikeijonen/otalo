<?php
/**
 * Polylang related functions and strings.
 *
 * @package Otalo
 */

/**
 * Register strings for translation.
 */
if ( function_exists( 'pll_register_string' ) ) {
	pll_register_string( esc_html__( 'Extra widget area title', 'otalo' ), get_theme_mod( 'extra_widget_area_title' ), 'Otalo' );
	pll_register_string( esc_html__( 'Title before image', 'otalo' ), get_theme_mod( 'before_image_title' ), 'Otalo', true );
}
