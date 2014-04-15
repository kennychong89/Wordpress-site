<?php get_header(); ?>
    <div class="b my-page">
        <?php
            $myLayout = new layout( '404' );
        ?>
        <div class="container <?php echo $myLayout -> containerClass; ?>">
            <?php
                $myLayout -> echoSidebar( );
            ?>
            
            <div class='<?php echo $myLayout -> contentClass( ); ?>'>
                
                <h1 class="title"><?php _e( 'Not found results'  , 'myThemes' ) ?></h1>
                
                <div class="blogging">
                    <div class="hentry">
                        <p><?php _e( 'We apologize but this page, post or resource does not exist or can not be found. Perhaps it is necessary to change the call method to this page, post or resource.' , 'myThemes' ) ?></p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
	
<?php get_footer(); ?>