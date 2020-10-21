<?php
//list solutions
function list_posts_by_country($arr){
    global $wp;
    $url=home_url( $wp->request );
    
    ?>

<div id="menu-tags">
    <div class="text-left pl-4">
      <h3> <?php echo $_GET['v'];?> </h3>
      <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $url ;?>">Tous</a></li>
      </ol>
      </nav>

    </div>
    <div class="menu">
    <?php

    $params=array( 'post_type' => $arr['cpt'], 'posts_per_page' => -1);
    $params['tax_query']=array(
        array(
        'taxonomy' => $arr['acf'],
        'field'    => 'slug',
        'terms'=>urldecode($_GET['v'])
        )
    );

    $query = new WP_Query($params);
    if($query->have_posts()){
        
        while($query->have_posts()){
            $query->the_post();
            global $wp; 
            $url=home_url( $wp->request ).'?q=mini-fiche&post='.get_the_ID();   
            ?>
            <a class="dropdown-item" href="<?php echo $url;?>">
            <?php echo get_the_title();?>
            </a>

            <?php
        }
        wp_reset_postdata();
    }
    echo '</div>';
    echo '</div>';
}