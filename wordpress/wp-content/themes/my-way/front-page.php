<?php get_header(); ?>


<?php
    if( get_option( 'show_on_front' ) == 'page' ){
        $wp_query = new WP_Query( array( 'p' => get_option( 'page_on_front' ) , 'post_type' => 'page' ) );
        
        global $myLayout;
        $myLayout = new layout( 'front-page' );

        echo '<div class="b front-page my-page">';
        echo '<div class="container ' . $myLayout -> containerClass . '">';
        
        echo $myLayout -> echoSidebar( );
        echo '<div class="' . $myLayout -> contentClass( ) . '">';
                
        if( count( $wp_query -> posts ) ){
            foreach( $wp_query -> posts as $post ){
                
                $wp_query -> the_post();
                
                echo '<div '; post_class(); echo'>';
                
                if( strlen( meta::get( $post -> ID , 'post-title' ) ) == 0  || meta::get( $post -> ID , 'post-title' ) ) {
                    echo '<h1 class="title">' ;
                    the_title();
                    echo '</h1>';
                }
                
                the_content();
                
                echo '</div>';
            }
        }else{
            echo '<p>' . __( 'Error, sorry not fount page' , 'myThemes' ) . '</p>';
        }
        
        echo '</div>';
        echo '<div class="clearfix"></div>';
        echo '</div>';
        echo '</div>';
        
    }else{
?>
        <div class="b my-page">
        <?php
            global $myLayout;
            $myLayout = new layout( 'front-page' );
        ?>
        <div class="container <?php echo $myLayout -> containerClass; ?>">
            
            <?php
                $myLayout -> echoSidebar( );
            ?>
            
            <div class="<?php echo $myLayout -> contentClass( ); ?>">
                
                <h1 class="title">
                    <span><?php _e( 'Blogging page' , 'myThemes' ); ?></span>
                </h1>

                <div class="blogging">
                
                    <?php
                        if( have_posts() ){
                            while( have_posts() ){
                                the_post();
                                get_template_part( 'cfg/templates/view/blog' );
                            }
                        }
                    ?>

		    
				<?php
					if (is_front_page() || is_home()) {
    						echo do_shortcode("[metaslider id=37]"); //replace 123 with slider ID
					}
				?>
                </div>
                <?php get_template_part( 'cfg/templates/pagination' ); ?>
            </div>
            <div class="clearfix"></div>
        </div>
        </div>
<?php
    }
?>

<!-- footer -->
<?php get_footer(); ?>