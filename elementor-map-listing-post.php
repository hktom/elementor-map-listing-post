<?php
/**
 * Plugin Name: Elementor Map Listing Post 
 * Description: A simple Elementor Widget to List Post on Widget
 * Plugin URI:  https://github.com/hktom/elementor-map-listing-post
 * Version:     1.0.0
 * Author:      Tom Hikari
 * Author URI:  https://github.com/hktom/
 * Text Domain: elementor-map-listing-post
 */
namespace Elementor_Map_Listing_Post;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// The Widget_Base class is not available immediately after plugins are loaded, so
// we delay the class' use until Elementor widgets are registered
add_action( 'elementor/widgets/widgets_registered', function() {
	require_once('widget.php');

	$map_listing_post =	new Map_listing_post();

	// Let Elementor know about our widget
	Plugin::instance()->widgets_manager->register_widget_type( $map_listing_post );
});