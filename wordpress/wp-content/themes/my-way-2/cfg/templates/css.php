<?php
/*////////////////////////////////////////////////////////////////////////////*/
    /* SET THEME COLOR */
    if( isset( $_COOKIE[ 'mytheme-color-css1' ] ) && !empty( $_COOKIE[ 'mytheme-color-css1' ] ) ){
        $color = $_COOKIE[ 'mytheme-color-css1' ];
    }else{
        $color = myThemes::get( 'theme-color' );
    }
?>

<style id="mytheme-color-css">

    /* COLOR */
    a,
    body .mytheme-color,
    body .mytheme-color-hover:hover,
    body div.b.my-menu div.container div.grid_3_4 > ul li:hover > a,
    body div.b.my-menu div.container div.grid_3_4 > div > ul li:hover > a,
    body .mytheme-color-link-hover:hover a{
        color: <?php echo $color; ?> !important;
    }
    
    /* BACKGROUND  */
    body .mytheme-bkg,
    body .mytheme-bkg-hover:hover,
    body .mytheme-bkg-link-hover a:hover,
    body .mytheme-bkg-icon-hover:hover .icon,
    body .pagination .current,
    body div.bbp-pagination-links span.page-numbers.current,
    div.wpcf7 p input[type="submit"],
    body div#bbpress-forums ul.bbp-forums li.bbp-header,
    body div#bbpress-forums ul.bbp-topics li.bbp-header,
    body div#bbpress-forums ul.bbp-forums li.bbp-footer,
    body div#bbpress-forums ul.bbp-topics li.bbp-footer,
    body div#bbpress-forums ul.forums.bbp-replies li.bbp-header,
    body div#bbpress-forums ul.forums.bbp-replies li.bbp-footer{
        background-color: <?php echo $color; ?>;
    }
    
    body div.hentry ul.projects-categories li.mytheme-bkg{
        background-color: <?php echo $color; ?> !important;
    }
    
    /* BORDER */
    body .mytheme-border-color,
    div.buddypress .activity-inner,
    div.hentry div#bbpress-forums .bbp-forums-list {
        border-color: <?php echo $color; ?> !important;
    }
 </style>
 <style>
    
    /* LOGO */
    div.b.my-menu div.logo{
        margin-top: <?php echo myThemes::get( 'logo-top' ); ?>px;
        margin-left: <?php echo myThemes::get( 'logo-left' ); ?>px;
        <?php
            if( myThemes::get( 'logo-top' ) < 0 ){
                ?> margin-bottom: <?php echo (-1) * (int)myThemes::get( 'logo-top' ); ?>px;<?php
            }
        ?>
        <?php
            if( myThemes::get( 'logo-left' ) < 0 ){
                ?> margin-right: <?php echo (-1) * (int)myThemes::get( 'logo-left' ); ?>px;<?php
            }
        ?>
    }
    
    div.b.footer-texture{
        background-image: url( '<?php echo get_template_directory_uri() . '/media/images/texture/' . myThemes::get( 'footer-texture' )?>' );
        background-color: <?php echo myThemes::get( 'footer-color' ); ?>;
    }
    
    /* BACKGROUND IMAGE *//* WP functions */
    <?php if( myThemes::get( 'image' ) ) : ?>
        body{
            background-image:url('<?php echo myThemes::get( 'image' ); ?>');
            background-position: <?php echo myThemes::get( 'horizontal-position' ); ?> <?php echo myThemes::get( 'vertical-position' ); ?>;
            background-repeat: <?php echo myThemes::get( 'repeat' ); ?>
        }
    <?php endif; ?>
        
    <?php if( myThemes::get( 'body-color' ) ) : ?>
        body{
            
            background-color: <?php echo myThemes::get( 'body-color' ); ?>;
        }
    <?php endif; ?>
    
    /* CUSTOM CSS */
    <?php echo myThemes::get( 'css' );  ?>
</style>