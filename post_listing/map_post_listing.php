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

#marker {
background-color: #5B5FA8;
width: 25px;
  height: 25px;
  line-height: 25px;
  border-radius: 50%;
  font-size: 13px;
  color: #fff;
  text-align: center;
cursor: pointer;
}


</style>
       
<div id='map' style='width: 100%; height: <?php echo $arr['height']."px";?>'>
</div>
<script>
$(function(){

//Set Locations from posts
function getPosts(posts){
    var i=0;
    var totalPost=parseInt($(`#total_posts`).val());
    if(totalPost > 0){
        while(i < totalPost ){
            posts.push($(`#post_${i}`).attr('location'));
           i++;
       }
    }    
}

function getTerms(terms){
    var i=0;
    var totalTerms=parseInt($(`#total_terms`).val());
    if(totalTerms > 0){
        while(i < totalTerms ){
            terms.push($(`#terms_${i}`).attr('term'));
           i++;
       }
    }    
}


//markers 
function setMarker(countryName, totalPost){
    mapboxClient.geocoding
    .forwardGeocode({
    query: countryName,
    autocomplete: false,
    limit: 1
    }).send().then(function(res){
        if(res && res.body && res.body.features && res.body.features.length){
            var feature = res.body.features[0];
            
            // create DOM element for the marker
            var el = document.createElement('div');
            el.innerHTML =`${totalPost}`;
            el.id = 'marker';

            new mapboxgl.Marker(el).
            setLngLat(feature.center).
            addTo(map);
        }
    })
}

//geocoder
function geocoder(posts){
    var locations={};

    posts.forEach(post => {
            terms.forEach(item => {
                if(item==post){
                    locations[post]?locations[post]++:locations[post]=1;
                }
            });
    });

    for (var key in locations) {
        //key => country name
        //locations[key] => total 
        setMarker(key, locations[key]);
    }
   

}

//shapefile african countries

    var posts=[]; //post lists
    var terms=[]; //terms countries
    mapboxgl.accessToken = $(`#access_token`).val();
    var mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });
    var lng=parseFloat($(`#position_lng`).val());
    var lat=parseFloat($(`#position_lat`).val());
    var map = new mapboxgl.Map({
        container: 'map',
        style: $(`#map_url_style`).val(),// stylesheet location
        center: [lng, lat], // starting position [lng, lat]
        zoom: parseInt($(`#zoom`).val()) // starting zoom
    });

    map.addControl(new mapboxgl.NavigationControl());
    getTerms(terms);
    getPosts(posts);
    geocoder(posts);



});
</script>
<?php
//mapBox function
}