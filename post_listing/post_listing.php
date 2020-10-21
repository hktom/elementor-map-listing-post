<?php
// List Post Query
function post_listing($arr){
    // The Query
$args = array( 'post_type' => $arr['cpt'], 'posts_per_page' => -1);

    if(isset($_GET['q'])){
        if($_GET['q']=='tag' && isset($_GET['tags']) && isset($_GET['v'] )){
            $args['tax_query']=array(
                array('taxonomy' => urldecode($_GET['tags']),
                'field'    => 'slug',
                'terms'=>urldecode($_GET['v']))
            );
        }
        else
        {
            $args['s']=urldecode($_GET['q']);
        }

    }

$query = new WP_Query($args);
$i=0;
$k=0;
// The Loop
if($query->have_posts()){
    echo "<div id='post-wrapper'>";
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
    wp_reset_postdata();

    $terms = get_terms( $arr['acf']);
    if ( $terms && ! is_wp_error( $terms ) ){
        foreach ($terms as $term) {
            echo "<input type='hidden' id='terms_$k' term='$term->name'/>";
            $k++; 
          }
       }

       echo "<input type='hidden' id='total_posts' value='".$i."'>";
       echo "<input type='hidden' id='total_terms' value='".$k."'>";
       echo '</div>';
}
/* Restore original Post Data */

}