 <div class="author-box">
    
    <div class="author-avatar"> 
        <?php echo get_avatar( $post -> post_author , 50 ); ?>
    </div>
    
    <?php
        $firstName  = get_the_author_meta( 'first_name' , $post-> post_author );
        $lastName   = get_the_author_meta( 'last_name' , $post-> post_author );
        $printName  = get_the_author_meta( 'display_name' , $post-> post_author );
        $info       = get_the_author_meta( 'description' , $post-> post_author );
        
        $twitter    = get_the_author_meta( 'twitter' , $post-> post_author );
        $facebook   = get_the_author_meta( 'facebook' , $post-> post_author );
        $vimeo      = get_the_author_meta( 'vimeo' , $post-> post_author );
        $stumble    = get_the_author_meta( 'stumble' , $post-> post_author );
        $behance    = get_the_author_meta( 'behance' , $post-> post_author );
        $yahoo      = get_the_author_meta( 'yahoo' , $post-> post_author );
        
        if( strlen( $firstName . $lastName ) )
            $name = __( 'About' , 'myThemes' ) . ' ' . $firstName . ' ' . $lastName;
        else
            $name = __( 'About' , 'myThemes' ) . ' ' . $printName
    ?>
    
    <span class="author-name">
        <?php if( !is_author() ) : ?>
        <a href="<?php echo get_author_posts_url( $post -> post_author ); ?>" title="<?php echo $name ?>">
            <?php echo $name; ?>
        </a>
        <?php else : ?>
            <?php echo $name; ?>
        <?php endif; ?>
        
        
        <span class="social fr">

            <?php if( strlen( $twitter ) ): ?>
                <a href="https://twitter.com/<?php echo $twitter; ?>" class="mytheme-bkg">
                    <img src="<?php echo get_template_directory_uri() . '/media/images/twitter.png'?>" width="20">
                </a>
            <?php endif; ?>

            <?php if( strlen( $facebook ) ): ?>
                <a href="<?php echo $facebook; ?>" class="mytheme-bkg">
                    <img src="<?php echo get_template_directory_uri() . '/media/images/facebook.png'?>" width="20">
                </a>
            <?php endif; ?>

            <?php if( strlen( $vimeo ) ): ?>
                <a href="<?php echo $vimeo; ?>" class="mytheme-bkg">
                    <img src="<?php echo get_template_directory_uri() . '/media/images/vimeo.png'?>" width="20">
                </a>
            <?php endif; ?>

            <?php if( strlen( $stumble ) ): ?>
                <a href="<?php echo $stumble; ?>" class="mytheme-bkg">
                    <img src="<?php echo get_template_directory_uri() . '/media/images/stumble.png'?>" width="20">
                </a>
            <?php endif; ?>

            <?php if( strlen( $behance ) ): ?>
                <a href="<?php echo $behance; ?>" class="mytheme-bkg">
                    <img src="<?php echo get_template_directory_uri() . '/media/images/behance.png'?>" width="20">
                </a>
            <?php endif; ?>

            <?php if( strlen( $yahoo ) ): ?>
                <a href="<?php echo $yahoo; ?>" class="mytheme-bkg">
                    <img src="<?php echo get_template_directory_uri() . '/media/images/yahoo.png'?>" width="20">
                </a>
            <?php endif; ?>
            
        </span>
    </span>
    <p class="author-quote"><?php echo $info; ?></p>
    
    <div class="clearfix"></div>
</div>