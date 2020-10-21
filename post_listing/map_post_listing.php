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
       

<div class="row">
 <div class="col-lg-9 col-12">
    
 <form class="my-1" method="get" action="<?php global $wp; echo home_url( $wp->request );?>">
  <div class="form-group mb-0">
    <!-- <label for="exampleInputEmail1">Email address</label> -->
    <input type="search" class="form-control" name="q" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Rechercher une solution">
  </div>
</form>

    <div id='map' style='width: 100%; height: <?php echo $arr['height']."px";?>'>
    </div>
 </div>
 <div class="col-lg-3 col-12" id="mini-fiche">
   <div class="text-left pl-4"> <h3>Solutions par categories</h3></div>
   <div class="menu">
   <a class="dropdown-item" href="<?php  global $wp;echo home_url( $wp->request );?>">Tous </a>
   <?php count_term_use ($arr['cpt']);?>
  </div>
 </div>
</div>



<script type="text/javascript" src="<?php echo plugin_dir_url( __DIR__ ).'/post_listing/map_post_listing.js';?>"></script>

<?php
//mapBox function Js
}

function count_term_use ($post_type){
$taxonomies = get_object_taxonomies( $post_type, 'objects');
$exclude = array( 'country', 'category');
if ( $taxonomies ) {

    foreach ( $taxonomies  as $taxonomy ) {

        if( in_array( $taxonomy->name, $exclude ) ) {
            continue;
        }

        $terms = get_terms( array(
            'taxonomy' => $taxonomy->name,
            'hide_empty' => true,
        ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

            foreach ( $terms as $term ) {
                global $wp; 
                $url=home_url( $wp->request ).'?v='.$term->name.'&q=tag&tags='.$taxonomy->name;       
                ?>
                <a class="dropdown-item" href="<?php echo $url;?>"><?php echo $term->name;?> <span class="badge badge-light"><?php echo $term->count;?> </span></a>
                <?php
            }

        }

    }

}

}