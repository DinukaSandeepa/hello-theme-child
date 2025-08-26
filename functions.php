<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );

function tour_itinerary_shortcode() {
    ob_start();
    $itinerary = SCF::get('itinerary');
    if ($itinerary) {
        echo '<div class="tour-itinerary">';
        foreach ($itinerary as $index => $day) {
            echo '<div class="tour-day">';
            echo '<h3>Day ' . ($index + 1) . ': ' . esc_html($day['day_title']) . '</h3>';
            echo '<p>' . esc_html($day['activities']) . '</p>';
            if (!empty($day['meals'])) {
                echo '<p><strong>Meals:</strong> ' . esc_html($day['meals']) . '</p>';
            }
            if (!empty($day['hotel'])) {
                echo '<p><strong>Hotel:</strong> ' . esc_html($day['hotel']) . '</p>';
            }
            echo '</div>';
        }
        echo '</div>';
    }
    return ob_get_clean();
}
add_shortcode('tour_itinerary', 'tour_itinerary_shortcode');
