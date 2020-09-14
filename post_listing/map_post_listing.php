<?php
function map_post_listing($arr){
    echo "
    <input type='hidden' value=".$arr['map_url_style']." id='map_url_style'/>
    <input type='hidden' value=".$arr['access_token']." id='access_token'/>
    <input type='hidden' value=".$arr['zoom']." id='zoom'/>
    <input type='hidden' value=".$arr['position_lng']." id='position_lng'/>
    <input type='hidden' value=".$arr['position_lat']." id='position_lat'/>
    ";
    ?>

<style>
.mapboxgl-popup {
max-width: 400px !important;
}
</style>
       
<div id='map' style='width: 100%; height: <?php echo $arr['height']."px";?>'>
</div>
<script>
$(function(){

//Set Locations from posts
function setLocations(){
    var i=0;
    var totalPost=parseInt($(`#total_locations`).val());
    if(totalPost > 0){
        while(i < totalPost ){
            posts.push({
                'location':$(`#location_${i}`).val(),
                'title':$(`#location_${i}`).attr('title'),
                'excerpt':$(`#location_${i}`).attr('excerpt'),
                'url':$(`#location_${i}`).attr('url'),
                'id':$(`#location_${i}`).attr('post_id'),
            });
           i++;
       }
    }    
}


//markers 
function setMarkers(post){
    mapboxClient.geocoding
    .forwardGeocode({
    query: post.location,
    autocomplete: false,
    limit: 1
    }).send().then(function(res){
        if(res && res.body && res.body.features && res.body.features.length){
            var feature = res.body.features[0];
            
            // create the popup
            var popup = new mapboxgl.Popup({ offset: 25 }).setHTML(
                `<h3>${post.title}</h3> 
                <p> ${post.excerpt}</p> 
                <a href="${post.url}"> Voir ce créateur</a>`
            );

            // create DOM element for the marker
            var el = document.createElement('div');
            el.id = `marker_${post.id}`;

            new mapboxgl.Marker().
            setLngLat(feature.center).
            setPopup(popup).
            addTo(map);
        }
    })
}

//geocoder
function geocoder(){
    posts.forEach(post => {
        setMarkers(post);
    });
}

//shapefile african countries

    var posts=[];
    var locations=[];
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
countrieShap();
//setLocations();
//geocoder(locations);


























});
</script>
<?php
//mapBox function
}