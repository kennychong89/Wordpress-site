<?php
echo '<div class="meta-bottom">';

/* CATEGORIES *///the_categories
$categories = wp_get_post_terms( $post -> ID , 'category' );
if( !empty( $categories ) ){
    echo '<ul class="post-categories meta fl">';
    echo '<li class="category">' . __( 'Posted in' , 'myThemes' ) .   '</li>';
    foreach ( $categories as $category ) {
        $cat = get_category( $category );
        echo '<li class="list-category">';
        echo '<a href="' . get_category_link( $category ) . '" title="' . esc_attr__( 'Category' , 'myThemes' ) . ' : ' . $cat -> name . '" >' . $cat -> name . '</a>';
        echo '</li>';
    }

    echo '</ul>';
}

/* TAGS  */
the_tags( '<ul class="post-tags meta fl"><li class="tag">' . __( 'Tags' , 'myThemes' ) .   ': </li><li class="list-tag">','</li><li class="list-tag">','</li></ul>' );

echo '<div class="clearfix clear"></div>';
echo '</div>';
?>