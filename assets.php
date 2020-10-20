<?php

function assets_css() {
    // slick css
    wp_enqueue_style( 'mapbox_css', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css', array(), null, 'all' );
    
    wp_enqueue_style( 'mapbox_gl_css', 'https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css', array(), null, 'all' );
    
    wp_enqueue_style( 'boostrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), null, 'all' );


}

function assets_js() {
    
    // wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.5.1.js', array(), null, 'all' );
    
    wp_enqueue_script( 'mapbox-gl-js', 'https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js', array(), null, 'all' );
    
    wp_enqueue_script( 'mapbox-sdk-js', 'https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js', array(), null, 'all' );
    
    wp_enqueue_script( 'mapbox-geocoder', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js', array(), null, 'all' );
   
    wp_enqueue_script( 'mapbox-geocoder-gl', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js', array(), null, 'all' );

    wp_enqueue_script( 'popper_js', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', array(), null, 'all' );
   
    wp_enqueue_script( 'boostrap_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array(), null, 'all' );
    
}

function add_jquery(){
    echo '<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>';
}

add_action( 'wp_head', 'add_jquery' );
add_action( 'wp_enqueue_scripts', 'assets_css' );
add_action( 'wp_enqueue_scripts', 'assets_js' );

?>


