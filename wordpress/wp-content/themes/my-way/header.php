<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>"/>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
            <?php myThemes::favicon(); ?>
        <?php wp_head(); ?>
    </head>

    <body <?php body_class( ); ?>>
        
        <div class="b header">
            <div class="b header-texture">
                <div class="b header-mask">
                    <!-- top menu -->
                    <div class="b topper">
                        <div class="container m mytheme-bkg">
                            <div class="grid_1_2">
                                <?php
                                    $location = get_nav_menu_locations();
                                    if( isset( $location[ 'topper' ] ) && $location[ 'topper' ] > 0 )
                                        wp_nav_menu( array( 'theme_location' => 'topper' ) );
                                ?>
                            </div>
                            <div class="grid_1_2 fr">
                                <?php
                                    if( myThemes::get( 'header-social' ) ){
                                ?>
                                        <span class="header-social-icons">

                                            <?php if( myThemes::get( 'twitter' ) ): ?>
                                                <a href="<?php echo myThemes::get( 'twitter' ); ?>">
                                                    <img src="<?php echo get_template_directory_uri() . '/media/images/twitter.png'?>" width="20">
                                                </a>
                                            <?php endif; ?>

                                            <?php if( myThemes::get( 'fb-profile' ) ): ?>
                                                <a href="<?php echo myThemes::get( 'fb-profile' ); ?>">
                                                    <img src="<?php echo get_template_directory_uri() . '/media/images/facebook.png'?>" width="20">
                                                </a>
                                            <?php endif; ?>

                                            <?php if( myThemes::get( 'vimeo' ) ): ?>
                                                <a href="<?php echo myThemes::get( 'vimeo' ); ?>">
                                                    <img src="<?php echo get_template_directory_uri() . '/media/images/vimeo.png'?>" width="20">
                                                </a>
                                            <?php endif; ?>

                                            <?php if( myThemes::get( 'stumble' ) ): ?>
                                                <a href="<?php echo myThemes::get( 'stumble' ); ?>">
                                                    <img src="<?php echo get_template_directory_uri() . '/media/images/stumble.png'?>" width="20">
                                                </a>
                                            <?php endif; ?>

                                            <?php if( myThemes::get( 'behance' ) ): ?>
                                                <a href="<?php echo myThemes::get( 'behance' ); ?>">
                                                    <img src="<?php echo get_template_directory_uri() . '/media/images/behance.png'?>" width="20">
                                                </a>
                                            <?php endif; ?>

                                            <?php if( myThemes::get( 'yahoo' ) ): ?>
                                                <a href="<?php echo myThemes::get( 'yahoo' ); ?>">
                                                    <img src="<?php echo get_template_directory_uri() . '/media/images/yahoo.png'?>" width="20">
                                                </a>
                                            <?php endif; ?>

                                            <?php if( myThemes::get( 'rss' ) ): ?>
                                                <a href="<?php bloginfo( 'rss2_url' ); ?>">
                                                    <img src="<?php echo get_template_directory_uri() . '/media/images/rss.png'?>" width="20">
                                                </a>
                                            <?php endif; ?>
                                        </span>
                                <?php
                                    }else{
                                        echo '<div class="text-header-right">';
                                        echo myThemes::get( 'header-text' , true );
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                     <!-- DEMO RUN -->
                    <?php
                        if( class_exists( 'my_demo_color' ) && myThemes::get( 'use-demo' ) )
                            my_demo_color::run();
                    ?>
                     
                    <!-- menu -->
                    <div class="b my-menu">
                        <div class="container m">
                            <div class="grid_1_4">
                                <div class="logo">
                                <?php
                                    $logo = myThemes::get( 'logo' );

                                    if( strlen( $logo ) ){
                                        echo '<a href="' . home_url() . '" title="' . get_option( 'blogname' ) . ' > ' . get_option( 'blogdescription' ) .  '"><img src="' . $logo . '" /></a>';
                                    }else{
                                        echo '<h1><a  class="mytheme-color-hover" href="' . home_url() . '" title="' . get_option( 'blogname' ) . ' > ' . get_option( 'blogdescription' ) .  '">' . get_option( 'blogname' ) . '</a></h1>';
                                        echo '<p>' . get_option( 'blogdescription' ) . '</p>';
                                    }
                                ?>
                                </div>
                            </div>
                            <div class="grid_3_4 fr m">
				<?php
                                    wp_nav_menu( array( 'theme_location' => 'header' , 'container' => 'div' , 'menu_class' => 'my-menu-list' ) );
                                ?>
	                     </div>
			     <div class="clearfix"></div>	 
                        </div>  
			
			
			<?php
				if (is_front_page() || is_home()) {
					echo '<div class="container m test">';
							echo '<div class="grid_4_4">';
    								echo do_shortcode("[metaslider id=44]"); //replace 123 with slider ID
							echo '</div>';
						echo '<div class="clearfix"></div>';
					echo '</div>';
				}
			?>
                    </div> 
		    
		    
		    <div class="clearfix"></div>
                    <div class="container mytheme-border-bottom mytheme-border-color">
				
                </div>
            </div>
            
        </div>
        
        <?php myThemes::breadcrumbs(); ?>
    </div>