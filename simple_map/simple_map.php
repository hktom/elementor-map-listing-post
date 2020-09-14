<?php
function simple_map($arr){
    echo "
    
    <input type='hidden' value=".$arr['map_url_style']." id='map_url_style'/>
    <input type='hidden' value=".$arr['access_token']." id='access_token'/>
    <input type='hidden' value=".$arr['zoom']." id='zoom'/>
    <input type='hidden' value=".$arr['position_lng']." id='position_lng'/>
    <input type='hidden' value=".$arr['position_lat']." id='position_lat'/>
    ";
    ?>
       
<div id='map' style='width: 100%; height: <?php echo $arr['height']."px";?>'>
</div>
<script>
$(function(){


    mapboxgl.accessToken = $(`#access_token`).val();
    var mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });
    var lng=parseFloat($(`#position_lng`).val());
    var lat=parseFloat($(`#position_lat`).val());
    var map = new mapboxgl.Map({
        container: 'map',
        style: $(`#map_url_style`).val(),
        // stylesheet location
        center: [lng, lat], // starting position [lng, lat]
        zoom: parseInt($(`#zoom`).val()) // starting zoom
    });

map.addControl(new mapboxgl.NavigationControl());


});
</script>
<?php
//mapBox function
}