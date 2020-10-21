<?php

// display mini fiche
function mini_fiche($arr){
    global $wp;
    $url=home_url( $wp->request );
    
    $query = new WP_Query(array( 'p' => $_GET['post'], 'post_type' => $arr['cpt'] ));
    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();
            ?>

        <div id="menu-tags">
        <div class="text-left pl-4">
        <h3> <?php echo get_the_title();?> </h3>

        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="<?php echo $url ;?>">Tous</a>
            </li>
        </ol>
        </nav>

        </div>
        <div class="menu">

        <a class="dropdown-item" href="#"> Site web: google.com</a>
        <a class="dropdown-item" href="<?php echo get_permalink();?>">
        En Savoir plus
        </a>

        </div>
        </div>

        <?php
         }
        }

        wp_reset_postdata();
}