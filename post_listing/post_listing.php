<?php
// List Post Query
function post_listing($arr){
    // The Query
$args = array( 'post_type' => $arr['cpt'] );
$the_query = new WP_Query($args);
$i=0;
$k=0;
// The Loop
if ( $the_query->have_posts() ) { ?>
    
    <?php while ( $the_query->have_posts() ): $the_query->the_post() ?>
       <?php 
       $terms = get_the_terms( $post->ID, $arr['acf']);
       if ( $terms && ! is_wp_error( $terms ) ){
        foreach ($terms as $term) {
            echo "<input type='hidden' id='post_$i' location='$term->name'/>";
            $i++; 
          }
       }
       ?>
    <?php endwhile ?>

    <?php 
       $terms = get_terms( $arr['acf']);
       if ( $terms && ! is_wp_error( $terms ) ){
        foreach ($terms as $term) {
            echo "<input type='hidden' id='terms_$k' term='$term->name'/>";
            $k++; 
          }
       }
       ?>

    <?php
    echo "<input type='hidden' id='total_posts' value='".$i."'>";
    echo "<input type='hidden' id='total_terms' value='".$k."'>";
    
} else {
    ?>
    <div style="text-align:center"> Aucun item trouvé</div>
    <?php
}
/* Restore original Post Data */
wp_reset_postdata();
}