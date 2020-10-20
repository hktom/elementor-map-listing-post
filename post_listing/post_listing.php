<?php
// List Post Query
function post_listing($arr){
    // The Query
$args = array( 'post_type' => $arr['cpt'] );
$query = new WP_Query($args);
$i=0;
$k=0;
// The Loop
if($query->have_posts()){
    while($query->have_posts()){
        $query->the_post();
        $terms=get_the_terms(get_the_ID(), $arr['acf']);
        if ( $terms && ! is_wp_error( $terms ) ){
            foreach ($terms as $term) {
            echo "<input type='hidden' id='post_$i' location='$term->name'/>";
                $i++; 
              }
           }
    }

    $terms = get_terms( $arr['acf']);
    if ( $terms && ! is_wp_error( $terms ) ){
        foreach ($terms as $term) {
            echo "<input type='hidden' id='terms_$k' term='$term->name'/>";
            $k++; 
          }
       }

       echo "<input type='hidden' id='total_posts' value='".$i."'>";
       echo "<input type='hidden' id='total_terms' value='".$k."'>";
}
/* Restore original Post Data */
wp_reset_postdata();
}