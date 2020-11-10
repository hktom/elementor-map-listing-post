
<?php
  function vue_map_post_listing($arr){
?>

  <!-- <!-- <!DOCTYPE html> -->
  <!-- <html lang="en"> -->
    <head>
      <!-- <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <link rel="icon" href="/favicon.ico">
      <title>cartographie</title> -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <script src="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js"></script>
      <link href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css" rel="stylesheet">
      <style>
        #app{
          margin-top: 0px !important;
        }
      </style>
      <link href="<?= plugin_dir_url( __DIR__ ).'/post_listing/css/app.053c1023.css';?>" rel="preload" as="style">
      <link href="<?= plugin_dir_url( __DIR__ ).'/post_listing/js/app.a491bb25.js';?>" rel="preload" as="script">
      <link href="<?= plugin_dir_url( __DIR__ ).'/post_listing/js/chunk-vendors.8eec77c1.js';?>" rel="preload" as="script">
      <link href="<?= plugin_dir_url( __DIR__ ).'/post_listing/css/app.053c1023.css';?>" rel="stylesheet">
    </head>
    
    <body>
      <noscript>
        <strong>We're sorry but cartographie doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
      </noscript>
      
      <div id="app" class="mt-0"></div>

      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js"></script>
      <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
      <script>
        window.mapboxSdk = mapboxSdk
        window.map_url_style = "<?= $arr['map_url_style'] ?>" // default : 'mapbox://styles/thesy/ckh0h1vl90z5o19nm3a9wq4fe/draft'
        window.access_token = "<?= $arr['access_token'] ?>" // default: 'pk.eyJ1IjoidGhlc3kiLCJhIjoiY2tmMm5hZWM3MTlxczJ4bzAzaXR5cm5rciJ9.hD0g1llrf64deGWq2V_rqg'
        window.zoom = "<?= $arr['zoom'] ?>" // default: 2
        window.position_lng = "<?= $arr['position_lng'] ?>" // default: 35
        window.position_lat = "<?= $arr['position_lat'] ?>" // default: 5
        window.geo_json = "<?= $arr['geo_json'] ?>" // default: 'https://raw.githubusercontent.com/hktom/assets/master/africa-countries.geo.json'
        window.border_color = "<?= $arr['border-color'] ?>" // default: 'transparent'
        window.fill_color = "<?= $arr['fill-color'] ?>" // default: 'red' 
      </script>
      <script src="<?= plugin_dir_url( __DIR__ ).'/post_listing/js/chunk-vendors.8eec77c1.js';?>"></script>
      <script src="<?= plugin_dir_url( __DIR__ ).'/post_listing/js/app.a491bb25.js';?>"></script>
  </body>
  </html>

<?php
  }
?>