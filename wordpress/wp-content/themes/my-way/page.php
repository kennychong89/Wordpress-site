<?php get_header(); ?>
<div class="b my-page">
    
    <?php
        global $myLayout;
        $myLayout = new layout( 'page' , $post -> ID );
    ?>
    <div class="container <?php echo $myLayout -> containerClass; ?>">
        <?php
            $myLayout -> echoSidebar( );
        ?>
        <div class="<?php echo $myLayout -> contentClass( ); ?>">

            <?php
                if( have_posts() ){
                    while( have_posts() ){
                        the_post();

                        echo '<div '; post_class(); echo'>';
                        if( strlen( meta::get( $post -> ID , 'post-title' ) ) == 0  || meta::get( $post -> ID , 'post-title' ) === "1" ) {
                            if( !(get_post_type() == 'forum' || get_post_type() == 'topic' ) ){
                                echo '<h1 class="title">' ;
                                the_title();
                                echo '</h1>';
                            }
                        }

                        thumbnail::singular( $post -> ID );

                        echo '<div class="single-content">';
                        the_content();
                        echo '<div class="clearfix"></div>';
                        echo '</div>';

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