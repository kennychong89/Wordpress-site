<?php get_header(); ?>
    <div class="b my-page">
        <?php
            global $myLayout;        
            $myLayout = new layout( 'category' );
        ?>
        <div class="container <?php echo $myLayout -> containerClass; ?>">
            
            <?php $myLayout -> echoSidebar( ); ?>
            
            <div class="<?php echo $myLayout -> contentClass( ); ?>">

                <h1 class="title">
                    <?php
                        if ( is_day() ) {
                            echo __( 'Daily archives' , 'myThemes' ) . ' "' . get_the_date();
                        }else if ( is_month() ) {
                            echo __( 'Monthly archives' , 'myThemes' ) . ' "' . get_the_date( 'F Y' ) . '"';
                        }else if ( is_year() ) {
                            echo __( 'Yearly archives' , 'myThemes' ) . ' "' . get_the_date( 'Y' ) . '"';
                        }else {
                            echo __( 'Blog archives' , 'myThemes' );
                        }
                    ?>
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
                </div>
                <?php get_template_part( 'cfg/templates/pagination' ); ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

<?php get_footer(); ?>