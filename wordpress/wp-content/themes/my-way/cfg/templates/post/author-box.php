<?php
/* ONLY ON SINGULAR ( PAGE OR SINGLE POST ) */
if( is_singular() ){

    echo '<div class="author-box">';

    if( is_user_logged_in() && $post -> post_author == get_current_user_id() ){

        /* ONLY FOR CURRENT AUTHORS */
        echo '<ul class="author-info">';

        /* AUTHOR OF THIS POST */
        echo '<li class="post-author">';
        _e( 'By' , 'myThemes' );
        echo '<a href="' . get_author_posts_url( $post-> post_author ) . '" title="' . esc_attr( get_the_author_meta( 'display_name' , $post-> post_author ) ) . '">';
        _e( 'me' , 'myThemes' );
        echo '</a>';
        echo '</li>';
        echo '</ul>';
    }
    else{
        /* OTHERS AUTHOR */
        echo '<ul class="author-info">';
        echo '<li class="post-author">';
        _e( 'By' , 'myThemes' );
        echo '<a href="' . get_author_posts_url( $post-> post_author ) . '" title="' . esc_attr( get_the_author_meta( 'display_name' , $post-> post_author ) ) . '">';
        echo get_the_author_meta( 'display_name' , $post-> post_author );
        echo '</a>';
        echo '</li>';
        echo '</ul>';
    }

    echo '<div class="author-description">';
    echo '<p>';
    echo '<a href="' . get_author_posts_url( $post -> post_author) . '">';
    $description = get_the_author_meta( 'description' , $post -> post_author );
    if( $description != '' ){
        echo '<span class="author-description">' . $description . '</span>';
    }
    echo '</a>';
    echo '</p>';
    echo '</div>';

    echo '</div>';
}
?>