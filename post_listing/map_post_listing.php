<link rel='stylesheet' href="<?php echo plugin_dir_url( __DIR__ ).'/post_listing/style.css';?>"/>

<?php
include(dirname(__FILE__)."/count_terms.php");
include(dirname(__FILE__)."/display_mini_fiche.php");
include(dirname(__FILE__)."/posts_by_country.php");
include(dirname(__FILE__)."/form_search.php");

function map_post_listing($arr){
    echo "
    <input type='hidden' value=".$arr['map_url_style']." id='map_url_style'/>
    <input type='hidden' value=".$arr['access_token']." id='access_token'/>
    <input type='hidden' value=".$arr['zoom']." id='zoom'/>
    <input type='hidden' value=".$arr['position_lng']." id='position_lng'/>
    <input type='hidden' value=".$arr['position_lat']." id='position_lat'/>
    <input type='hidden' value=".$arr['acf']." id='acf'/>
    ";
    ?>
       

<div class="row">
  <div class="col-lg-9 col-12">
      <?php form_search();?>
      <div id='map' 
      style='width: 100%; height: <?php echo $arr['height']."px";?>'>
      </div>
  </div>

  <div class="col-lg-3 col-12" id="mini-fiche">
    <?php 
    
    if(isset($_GET['q']) && $_GET['q']==$arr['acf']){

      list_posts_by_country($arr);

    }
    elseif(isset($_GET['q']) && $_GET['q']=='mini-fiche'){
      mini_fiche($arr);
    }
    else
    {
      count_term_use ($arr['cpt']);
    }
    
    ;?>

  </div>

</div>
<!-- Insert Js  -->
<script type="text/javascript" src="<?php echo plugin_dir_url( __DIR__ ).'/post_listing/map_post_listing.js';?>"></script>

<?php
//mapBox function Js
}


