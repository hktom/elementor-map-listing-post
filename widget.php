<?php
namespace Elementor_Map_Listing_Post;

use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include plugin_dir_path( __FILE__ ) . '/map_hover_countries/map_box_gl.php';
include plugin_dir_path( __FILE__ ) . '/post_listing/post_listing.php';
include plugin_dir_path( __FILE__ ) . '/simple_map/simple_map.php';

class Map_listing_post extends Widget_Base {

	public static $slug = 'elementor_map_listing_post';

	public function get_name() { return self::$slug; }

	public function get_title() { return __('Elementor Map Listing Post', self::$slug); }

	public function get_icon() { return 'fab fa-accusoft'; }

	public function get_categories() { return [ 'general' ]; }

	//list all post types
	private function _get_post_type(){
		$args = array('public' => true);
		$post_types = get_post_types( $args, 'objects' );
		$get_post_type=[];
		// Get All Post Types as List
		foreach ( $post_types as $post_type_obj ) {
			$labels = get_post_type_labels( $post_type_obj );
			$name=$post_type_obj->name;
			$get_post_type[$name]=__( $labels->name, 'self::$slug' );
		}
		return $get_post_type;
	}

	protected function _register_controls() {

		// Type parameter
		$this->start_controls_section(
			'content_type_map',
			[
				'label' => __( 'Map Options', self::$slug ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'map_options',
			[
				'label' => __( 'Options', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				//'input_type' => 'text',
				//'placeholder' => __( "height in px", 'self::$slug' ),
				'default' => 'simple_map',
				'options'=>[
					'simple_map'  => __( 'Simple Map', 'self::$slug' ),
					'post_listing'  => __( 'Post Listing', 'self::$slug' ),
					'map_hover_countries'  => __( 'Map Hover Countries', 'self::$slug' ),
				]
			]
		);

		$this->end_controls_section();

		// post listing parameter
		$this->start_controls_section(
			'post_listing_section',
			[
				'label' => __( 'Post Listing', self::$slug ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'cpt',
			[
				'label' => __( 'Custom Post Type', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				//'input_type' => 'text',
				//'placeholder' => __( "Post", 'self::$slug' ),
				'default' => 'post',
				'options'=>$this->_get_post_type()
				
			]
		);

		// $this->add_control(
		// 	'acf',
		// 	[
		// 		'label' => __( 'Location Field', 'self::$slug' ),
		// 		'type' => \Elementor\Controls_Manager::TEXT,
		// 		'input_type' => 'text',
		// 		'placeholder' => __( "country", 'self::$slug' ),
		// 		'default' => '',
		// 	]
		// );

		$this->end_controls_section();

		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content Section', self::$slug ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'height',
			[
				'label' => __( 'Height', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'input_type' => 'text',
				'placeholder' => __( "height in px", 'self::$slug' ),
				'min' => 100,
				'max' => 9999,
				'default' => 450,
			]
		);



		$this->end_controls_section();

		// Map Style Parameter
		$this->start_controls_section(
			'map_style',
			[
				'label' => __( 'Map Style', self::$slug ),
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
				'placeholder' => __( 'geo json file url', 'self::$slug' ),
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_parameters',
			[
				'label' => __( 'Map Parameters', self::$slug ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'position_lng',
			[
				'label' => __( 'Position Longitude', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( "lng", 'self::$slug' ),
				'default' => "21.634121",
			]
		);
		
		$this->add_control(
			'position_lat',
			[
				'label' => __( 'Position Latitude', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( "lat", 'self::$slug' ),
				'default' => "-2.380922",
			]
		);


		$this->add_control(
			'zoom',
			[
				'label' => __( 'Map Zoom', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'input_type' => 'text',
				'placeholder' => __( "starting zoom ex:1", 'self::$slug' ),
				'min' => 0,
				'max' => 10,
				'default' => 2,
			]
		);

		$this->add_control(
			'map_url_style',
			[
				'label' => __( 'Map Url Style', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'url',
				'placeholder' => __( 'mapbox url style', 'self::$slug' ),
			]
		);

		$this->add_control(
			'access_token',
			[
				'label' => __( 'Token Access', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( 'mapbox token access', 'self::$slug' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$params=[
			'fill-color'=> $settings['fill_color'],
			'border-color'=> $settings['border_color'],
			'geo_json'=>$settings['geo_json'],
			'map_url_style'=>$settings['map_url_style'],
			'access_token'=>$settings['access_token'],
			'position_lng'=>$settings['position_lng'],
			'position_lat'=>$settings['position_lat'],
			'zoom'=>$settings['zoom'],
			'height'=>$settings['height'],
			'map_options'=>$settings['map_options'],
			'cpt'=>$settings['cpt'],
			//'acf'=>$settings['acf'],
		];

		if($settings['map_options']=="simple_map"){
			simple_map($params);
		}
		else if($settings['map_options']=="post_listing"){
			echo "<h1> post listing</h2>";
			post_listing($params);
			//map_post_listing($params);
		}
		else if($settings['map_options']=="map_hover_countries"){
			map_box_gl($params);
		}
		else
		{

		}
	}
}