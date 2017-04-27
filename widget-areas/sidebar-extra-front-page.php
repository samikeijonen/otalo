<?php
/**
 * The area containing the before footer widget areas.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Otalo
 */

if ( ! is_active_sidebar( 'otalo-front-page' ) ) {
	return;
}

// Extra title and support for Polylang.
$title = get_theme_mod( 'extra_widget_area_title' );
$title = ( function_exists( 'pll__' ) ) ? pll__( $title ) : $title;
?>

<div class="front-page-otalo-info text-center">

	<?php
	if ( $title ) :
		echo '<h2 class="page-title before-footer-widgets-title">' . esc_html( $title ) . '</h2>';
	endif;
	?>

	<aside id="front-page-extra-widget-area" class="front-page-extra-widget-area widget-area" role="complementary">
		<div class="grid-wrapper grid-wrapper-3">
		<?php
			dynamic_sidebar( 'otalo-front-page' );
		?>
		</div><!-- .grid-wrapper -->
	</aside><!-- .widget-area -->

</div><!-- .front-page-otalo-info -->
