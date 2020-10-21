<link rel='stylesheet' href="<?php echo plugin_dir_url( __DIR__ ).'/post_listing/style.css';?>"/>

<?php
include(dirname(__FILE__)."/count_terms.php");
include(dirname(__FILE__)."/display_mini_fiche.php");
include(dirname(__FILE__)."/list_project.php");
include(dirname(__FILE__)."/form_search.php");

function map_post_listing($arr){
    
    global $wp;
    $url=home_url( $wp->request );

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
    <!-- form search -->
    <?php form_search();?>
    <div id='map' style='width: 100%; height: <?php echo $arr['height']."px";?>'>
    </div>
 </div>

 <div class="col-lg-3 col-12" id="mini-fiche">
  <?php if(isset($_GET['q']) && $_GET['q']==$arr['acf']):;?>
  <!-- display projects by countries -->
  <div id="menu-tags">
    <div class="text-left pl-4">
      <h3> <?php echo $_GET['v'];?> </h3>

      <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $url ;?>">Tous</a></li>
        <!-- <li class="breadcrumb-item active" aria-current="page">Library</li> -->
      </ol>
      </nav>

    </div>
    <div class="menu">
      <?php list_posts_by_country($arr);?>
    </div>
  </div>
  <!-- display projects by countries -->

  <?php elseif(isset($_GET['q']) && $_GET['q']=='mini fiche'):;?>
  <!-- Display mini fiche -->
  <?php  mini_fiche($arr);?>
  <!-- Display mini fiche -->

  <?php else:?>
  <!-- Display terms -->
    <div id="menu-tags">
    <div class="text-left pl-4"> <h3>Solutions par categories</h3></div>
    <div class="menu">
    <a class="dropdown-item" href="<?php echo $url;?>">Tous </a>
    <?php count_term_use ($arr['cpt']);?>
    </div>
    </div>
  <!-- Display terms -->
  <?php endif;?>

 </div>

</div>
<!-- Insert Js  -->
<script type="text/javascript" src="<?php echo plugin_dir_url( __DIR__ ).'/post_listing/map_post_listing.js';?>"></script>

<?php
//mapBox function Js
}


