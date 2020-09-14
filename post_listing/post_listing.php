<?php
// List Post Query
function post_listing($arr){
    // The Query
$the_query = new WP_Query( array( 'post_type' => $arr['cpt'] ) );

// The Loop
if ( $the_query->have_posts() ) {
    $i=0;
    ?>
    <div class='container'> 
    <div class='row'>


    <?php while ( $the_query->have_posts() ):?>
        <div class="col-lg-4">
            <div class="card">
                <img src="<?php the_post_thumbnail_url( null, 'medium' );?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php the_title();?></h5>
                    <p class="card-text"><?php the_excerpt();?></p>
                    <a href="<?php echo get_permalink( get_the_ID());?>" class="btn btn-primary">En savoir plus</a>
                </div>
            </div>
    </div>
    <?php endwhile ?>

    
    </div>
    </div>

    <?php
    // $the_query->the_post();
        // echo "<input type='hidden' id='location_$i' name='location_$i'
        // post_id='".get_the_ID()."' 
        // title='".get_the_title()."'
        // excerpt='".get_the_excerpt()."' 
        // value='".get_post_meta(get_the_ID(), $arr['acf'], true)."'
        // url='".get_permalink( get_the_ID())."'

        // >";
    echo "<input type='hidden' id='total_locations' name='total_location' value='".$i."'>";
    
} else {
    ?>
    <div style="text-align:center"> Aucun item trouvé</div>
    <?php
}
/* Restore original Post Data */
//wp_reset_postdata();
}