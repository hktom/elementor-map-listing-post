<?php
namespace Elementor_Map_Listing_Post;

use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include plugin_dir_path( __FILE__ ) . 'map_box_gl.php';
include plugin_dir_path( __FILE__ ) . 'post_listing.php';

class Map_listing_post extends Widget_Base {

	public static $slug = 'elementor_map_listing_post';

	public function get_name() { return self::$slug; }

	public function get_title() { return __('Elementor Map Listing Post', self::$slug); }

	public function get_icon() { return 'fab fa-accusoft'; }

	public function get_categories() { return [ 'general' ]; }

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Map Parameters', self::$slug ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'fill_color',
			[
				'label' => __( 'Color on hover', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'placeholder' => __( '#ffff', 'self::$slug' ),
			]
        );
        
        $this->add_control(
			'border_color',
			[
				'label' => __( 'Country Border Color', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'placeholder' => __( '#ffff', 'self::$slug' ),
			]
        );
        
        $this->add_control(
			'geo_json',
			[
				'label' => __( 'Geo Json Url', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'url',
				'placeholder' => __( 'https://docs.mapbox.com/mapbox-gl-js/assets/us_states.geojson', 'self::$slug' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$map_params=[
			'fill-color'=> $settings['fill_color'],
			'border-color'=> $settings['border_color'],
			'geo_json'=>$settings['geo_json'],
		];
        // render map
        show_post_listing();
        show_map($map_params);
	}
}