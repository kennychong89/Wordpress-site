<?php
echo '<div class="meta-top">';
echo '<ul class="meta">';

/* POST AUTHOR */
echo '<li class="mytheme-post-author"><a href="' . get_author_posts_url( $post-> post_author ) . '">' . get_the_author_meta( 'display_name' , $post-> post_author ) . '</a></li>';

/* POST TIME */
echo '<li class="mytheme-post-time">';
the_time( get_option( 'date_format' ) );
echo ' ' . __( 'at' , 'myThemes' ) . ' ';
the_time( get_option( 'time_format' ) );
echo '</li>';

/* LINK POST EDIT */
edit_post_link( __( 'Edit', 'myThemes' ) , '<li class="mytheme-post-edit">', '</li>' );

/* POST COMMENTS */
if ( comments_open() ){
    echo '<li class="mytheme-post-comments" title="' . get_comments_number( $post -> ID ) . __( 'Comments' , 'myThemes' ) . '">';
    echo '<a href="' . get_comments_link( $post -> ID ) . '"> ' . get_comments_number( $post -> ID ) . ' ' . __( 'Comment(s)' , 'myThemes' ) . '</a>';
    echo '</li>';
}

echo '</ul>';
echo '<div class="clearfix"></div>';
echo '</div>';
?>