<?php
    class thumbnail{

        
        static $currSize;
        
        static function blogView( $template  , $post , $catID = null )
        {
            global $myLayout;
            
            if( has_post_thumbnail( $post->ID ) ) {
				
                $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full'  );
				
                echo '<div class="blog-view-thumbnail post-thumbnail">';
                echo '<a href="' . $src[ 0 ] .'" rel="prettyPhoto">';
                echo '<div class="zoom"></div>';
                echo get_the_post_thumbnail( $post -> ID , array( $myLayout -> width - 20 , 9999 ) );
                echo '</a>';
                echo '</div><div class="clearfix"></div>';
				
            }
        }
        
        static function singular( $postID )
        {
            global $myLayout;
            
            if( has_post_thumbnail( $postID ) ) {
                $src = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'full' );
				
                echo '<div class="post-thumbnail">';
                echo '<div class="zoom"></div>';
                echo '<a href="' . $src[ 0 ] .'" rel="prettyPhoto">';
                echo get_the_post_thumbnail( $postID , array( $myLayout -> width - 20 , 9999 )    );
                echo '</a>';
                echo '</div><div class="clearfix"></div>';
            }
        }
    }
?>