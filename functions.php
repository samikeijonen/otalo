<?php
/**
 * This is child themes functions.php file. All modifications should be made in this file.
 *
 * All style changes should be in child themes style.css file.
 *
 * @package   OTalo
 * @version   1.0.0
 * @author    Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright Copyright (c) 2017, Sami Keijonen
 * @link      https://foxland.fi/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Setup function. All child themes should run their setup within this function. The idea is to add/remove
 * filters and actions after the parent theme has been set up. This function provides you that opportunity.
 *
 * @since  1.0.0
 * @return void
 */
function otalo_styles_theme_setup() {
	// Load child theme text domain.
	load_child_theme_textdomain( 'otalo', get_stylesheet_directory() . '/languages' );

	// Remove theme support for custom fonts.
	remove_theme_support( 'checathlon-plus-custom-fonts' );

	// Remove theme support for custom colors.
	remove_theme_support( 'checathlon-plus-custom-colors' );
}
add_action( 'after_setup_theme', 'otalo_styles_theme_setup', 11 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function otalo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Front page widget area 1', 'otalo' ),
		'id'            => 'otalo-front-page',
		'description'   => esc_html__( 'Add widgets here for front page (after logos).', 'otalo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'otalo_widgets_init' );

/**
 * Add logo via 'checathlon_after_the_custom_logo' hook.
 *
 * @since  1.0.0
 * @return void
 */
function otalo_custom_logo() {
	echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home"><img alt="' . esc_html( get_bloginfo( 'name' ) ) . '" class="custom-logo" src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/logo-origi.svg"></a>';
}
add_action( 'checathlon_after_the_custom_logo', 'otalo_custom_logo' );

/**
 * Add logo to footer via 'checathlon_after_footer_title' hook.
 *
 * @since  1.0.0
 * @return void
 */
function otalo_custom_logo_footer() {
	echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home"><img alt="' . esc_html( get_bloginfo( 'name' ) ) . '" class="custom-logo-footer" src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/logo-white.svg"></a>';
}
add_action( 'checathlon_after_footer_title', 'otalo_custom_logo_footer' );

/**
 * Header image via 'checathlon_after_header' hook.
 *
 * @since  1.0.0
 * @return void
 */
function otalo_header_image() {
	if ( is_front_page() ) {
		the_header_image_tag();
	}
}
add_action( 'checathlon_after_header', 'otalo_header_image' );

/**
 * Always hide header background image. It's added via hook.
 *
 * @since  1.0.0
 * @return boolean
 */
function otalo_hide_header_image() {
	return true;
}
add_filter( 'checathlon_hide_header_image', 'otalo_hide_header_image' );

/**
 * Change how many testimonials to show in front page.
 *
 * @since  1.0.0
 *
 * @param  array $args Testimonial arguments.
 * @return array $args Modified testimonial arguments.
 */
function otalo_front_page_testimonials( $args ) {
	$args['posts_per_page'] = 6;
	return $args;
}
add_filter( 'checathlon_front_page_testimonials', 'otalo_front_page_testimonials' );

/**
 * Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function otalo_customize_register( $wp_customize ) {
	// First image setting.
	$wp_customize->add_setting(
		'otalo_first_fp_img',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	// First image control.
	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize,
			'otalo_first_fp_img',
			array(
				'label'    => esc_html__( 'First extra image', 'otalo' ),
				'section'  => 'front-page',
				'priority' => 50,
			)
		)
	);

	// Extra widget area title setting.
	$wp_customize->add_setting(
		'extra_widget_area_title',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	// Extra widget title control.
	$wp_customize->add_control(
		'extra_widget_area_title',
		array(
			'label'    => esc_html__( 'Extra widget area title', 'otalo' ),
			'section'  => 'front-page',
			'priority' => 55,
			'type'     => 'text',
		)
	);

	// Before image title setting.
	$wp_customize->add_setting(
		'before_image_title',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	// Before image title control.
	$wp_customize->add_control(
		'before_image_title',
		array(
			'label'    => esc_html__( 'Title before image', 'otalo' ),
			'section'  => 'front-page',
			'priority' => 56,
			'type'     => 'text',
		)
	);

	// Second image setting.
	$wp_customize->add_setting(
		'otalo_second_fp_img',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	// Second image control.
	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize,
			'otalo_second_fp_img',
			array(
				'label'    => esc_html__( 'Second extra image', 'otalo' ),
				'section'  => 'front-page',
				'priority' => 60,
			)
		)
	);
}
add_action( 'customize_register', 'otalo_customize_register' );

/**
 * Polylang additions.
 */
require get_stylesheet_directory() . '/inc/polylang.php';
