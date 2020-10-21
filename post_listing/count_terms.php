<?php

// count term use
function count_term_use ($post_type){

    global $wp;
    $url=home_url( $wp->request );
    
    ?>

    <div id="menu-tags">
    <div class="text-left pl-4"> <h3>Solutions par categories</h3></div>
    <div class="menu">
    <a class="dropdown-item" href="<?php echo $url;?>">Tous </a>
    <?php 
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
    ?>
    </div>
    </div>

    <?php
    
    }