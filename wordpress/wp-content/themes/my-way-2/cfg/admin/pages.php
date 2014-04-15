<?php
    $pages = & acfg::$pages;
    
    $pages = array(
        /* MAIN PAGE */
        'mythemes-general' => array(
            'menu' => array(
                'settings' => 'myThemes',
                'label' => __( 'Theme Options' , 'myThemes' ) ,
                'ico'	=> MYTHEMES_DEV_ICON
            ),
            'title' => __( 'Theme Options' , 'myThemes' ),
            'description' => '',
            'content' => array(),
        ),
    );
?>