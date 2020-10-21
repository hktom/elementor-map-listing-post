<?php
//list solutions
function list_posts_by_country($arr){
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
            $url=home_url( $wp->request ).'?q=mini-fiche&v='.get_the_ID();   
            ?>
            <a class="dropdown-item" href="<?php echo $url;?>">
            <?php echo get_the_title();?>
            </a>

            <?php
        }
        wp_reset_postdata();
    }
}