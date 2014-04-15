<?php get_header(); ?>

<!-- content start -->
<div class="b my-page">
    <?php
        global $myLayout;
        $myLayout = new layout( 'single' , $post -> ID );
    ?>
    <div class="container <?php echo $myLayout -> containerClass; ?>">
        
        <?php $myLayout -> echoSidebar( ); ?>

        <div class='<?php echo $myLayout->contentClass( ); ?>'>

            <?php
                if( have_posts() ){
                    while( have_posts() ){
                        the_post();

                        echo '<div '; post_class(); echo'>';
                        
                        if( strlen( meta::get( $post -> ID , 'post-title' ) ) == 0  || meta::get( $post -> ID , 'post-title' ) === "1" ) {
                            echo '<h1 class="title">'. $post -> post_title .'</h1>';
                        }

                        get_template_part( 'cfg/templates/post/top-meta' );

                        thumbnail::singular( $post -> ID );

                        echo '<div class="single-content">';
                        the_content();
                        
                        wp_link_pages( array( 'before' => '<p>' . __( 'Pages:', "myThemes" ), 'after' => '</p>' ) );
                        
                        echo '<div class="clearfix"></div>';
                        
                        get_template_part( 'cfg/templates/post/bottom-meta' );
                        
                        echo '</div>';
                        
                        get_template_part( 'cfg/templates/author-box' );
                        
                        /* COMMENTS */
                        comments_template();
                        
                        echo '</div>';
                    }
                }
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!-- footer -->
<?php get_footer(); ?>