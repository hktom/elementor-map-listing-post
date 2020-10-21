$(function() {
    $("#map-form-search").submit(function(e) {
        e.preventDefault();
        map_form_search();
        initialize_map();
        display_map();
    });
    //function search
    function map_form_search() {
        $("#post-wrapper").html("<h1> Access Granted v2 </h1>");
    }

    //Set Locations from posts
    function getPosts(posts) {
        var i = 0;
        var totalPost = parseInt($(`#total_posts`).val());
        if (totalPost > 0) {
            while (i < totalPost) {
                posts.push($(`#post_${i}`).attr("location"));
                i++;
            }
        }
    }

    function getTerms(terms) {
        var i = 0;
        var totalTerms = parseInt($(`#total_terms`).val());
        if (totalTerms > 0) {
            while (i < totalTerms) {
                terms.push($(`#terms_${i}`).attr("term"));
                i++;
            }
        }
    }

    //markers
    function setMarker(countryName, totalPost, acf) {
        mapboxClient.geocoding
            .forwardGeocode({
                query: countryName,
                autocomplete: false,
                limit: 1,
            })
            .send()
            .then(function(res) {
                if (res && res.body && res.body.features && res.body.features.length) {
                    var feature = res.body.features[0];
                    // create DOM element for the marker
                    var el = document.createElement("div");
                    el.innerHTML = `${totalPost}`;
                    el.id = "marker";
                    el.addEventListener('click', () => {
                        //alert("Marker Clicked. v2");
                        var url = $("#page-url").val();
                        url += `/?q=${acf}&v=${countryName}`;
                        window.location.href = url;
                    });
                    var marker = new mapboxgl.Marker(el).setLngLat(feature.center);
                    marker.remove(map);
                    marker.addTo(map);
                }
            });
    }

    //geocoder
    function geocoder(posts) {
        var locations = {};

        posts.forEach((post) => {
            terms.forEach((item) => {
                if (item == post) {
                    locations[post] ? locations[post]++ : (locations[post] = 1);
                }
            });
        });

        for (var key in locations) {
            //key => country name
            //locations[key] => total
            var acf = $("#acf").val();
            setMarker(key, locations[key], acf);
        }
    }

    function display_map() {
        getTerms(terms);
        getPosts(posts);
        geocoder(posts);
    }

    function initialize_map() {
        map = new mapboxgl.Map({
            container: "map",
            style: $(`#map_url_style`).val(), // stylesheet location
            center: [lng, lat], // starting position [lng, lat]
            zoom: parseInt($(`#zoom`).val()), // starting zoom
        });
        map.addControl(new mapboxgl.NavigationControl());
    }
    //shapefile african countries

    var posts = []; //post lists
    var terms = []; //terms countries
    mapboxgl.accessToken = $(`#access_token`).val();
    var mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });
    var lng = parseFloat($(`#position_lng`).val());
    var lat = parseFloat($(`#position_lat`).val());
    // display map
    var map;
    initialize_map();
    display_map();
});