<?php
/**
 * Front Page Template
 *
 * This is the template for displaying Front Page.
 *
 * @package Otalo
 */

get_header(); ?>

	<div id="primary" class="content-area main-padding">
		<main id="main" class="site-main main-width" role="main">

			<?php
			while ( have_posts() ) : the_post();
			?>

				<header class="page-header">

					<?php the_title( '<h1 class="page-title title-font no-margin-bottom text-center text-italic">', '</h1>' ); ?>

					<?php
					$content = trim( get_the_content() ); // Get page content.
					if ( '' !== $content ) : ?>
						<div class="entry-front-page-content archive-description text-center soft-color">
							<?php the_content(); ?>
						</div><!-- .entry-front-page-content -->
					<?php endif; ?>

				</header><!-- .page-header -->

			<?php
			endwhile; // End of the loop.

			// Load first image.
			$img_1 = get_theme_mod( 'otalo_first_fp_img' );
			if ( $img_1 ) :
				echo '<div class="front-page-image-area front-page-area">';
					echo '<img alt="" src="' . esc_url( $img_1 ) . '">';
				echo '</div>';
			endif;

			// Load Front Page Extra Widget area.
			get_template_part( 'widget-areas/sidebar', 'extra-front-page' );

			// Load service and pricing table widgets.
			get_template_part( 'template-parts/content', 'service-pricing-area' );

			// Load featured area.
			get_template_part( 'template-parts/content', 'testimonials-area' );

			// Load second image and title. Support for Polylang.
			$title = get_theme_mod( 'before_image_title' );
			$title = ( function_exists( 'pll__' ) ) ? pll__( $title ) : $title;
			$img_2 = get_theme_mod( 'otalo_second_fp_img' );

			if ( $img_2 ) :
				echo '<div class="front-page-image-area front-page-area">';
				if ( $title ) :
					echo '<h2 class="page-title text-center before-footer-widgets-title">' . esc_html( $title ) . '</h2>';
				endif;
				echo '<img alt="" src="' . esc_url( $img_2 ) . '">';
				echo '</div>';
			endif;

			// Load featured area.
			get_template_part( 'template-parts/content', 'featured-area' );

			// Load Front Page Widget area.
			get_template_part( 'widget-areas/sidebar', 'front-page' );

			// Load blog area.
			get_template_part( 'template-parts/content', 'blog-area' );

			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
