<?php get_header(); ?>
    <div class="b my-page">
        <?php
            global $myLayout;        
            $myLayout = new layout( 'tag' );
        ?>
        <div class="container my-page <?php echo $myLayout -> containerClass; ?>">
            
            <?php $myLayout -> echoSidebar( ); ?>
            
            <div class="<?php echo $myLayout -> contentClass( ); ?>">

                <h1 class="title"><?php _e( 'Search results for' , 'myThemes' ); ?> "<?php echo get_query_var( 's' )?>"</h1>
                <div class="blogging">
                
                    <?php
                        if( have_posts() ){
                            while( have_posts() ){
                                the_post();
                                get_template_part( 'cfg/templates/view/blog' );
                            }
                        }
                    ?>
                </div>
                <?php get_template_part( 'cfg/templates/pagination' ); ?>
                
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

<?php get_footer(); ?>