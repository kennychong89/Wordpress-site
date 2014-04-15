<?php
/* THEME OPTIONS */
$sett = & acfg::$pages[ 'mythemes-general' ][ 'content' ];

{   /* GENERAL SETTINGS */

    $sett[ 'title-general' ] = array(
        'type' => array(
            'template' => 'code'
        ),
        'title' => __( 'General Settings' , 'myThemes' )
    );

    $sett[ 'theme-color' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'pickColor'
        ),
        'label' => __( 'Select custom color for your site' , 'myThemes' )
    );

    $icon = pathinfo( myThemes::pget( 'favicon' ) );
    if( strlen( myThemes::pget( 'favicon' ) ) && $icon[ 'extension' ] !== 'ico' ){
        $icon_hint = '<span style="color:#cc0000;">' . __( 'Error, please select "ico" type media file' , 'myThemes' ) . '</span>';
    }else{
        $icon_hint = __( "Please select 'ico' type media file. Make sure you allow uploading 'ico' type in General Settings -> Upload file types." , 'myThemes' );
    }

    $sett[ 'favicon' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'upload'
        ),
        'label' => __( 'Upload your custom favicon' , 'myThemes' ),
        'hint' => $icon_hint
    );

    $sett[ 'logo' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'upload'
        ),
        'label' => __( 'Upload your custom logo' , 'myThemes' )
    );

    $sett[ 'logo-top' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text'
        ),
        'label' => __( 'Logo top margin ( px )' , 'myThemes' )
    );

    $sett[ 'logo-left' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text'
        ),
        'label' => __( 'Logo left margin ( px )' , 'myThemes' )
    );
    
    $sett[ 'default-content' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'logic'
        ),
        'label' => __( 'Hide default content from sidebar' , 'myThemes' )
    );
}

{   /* HEADER SETTINGS */

    $sett[ 'title-header' ] = array(
        'type' => array(
            'template' => 'code'
        ),
        'title' => __( 'Header Settings' , 'myThemes' )
    );
    
    $sett[ 'use-demo' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'logic'
        ),
        'label' => __( 'Use Demo color Piker' , 'myThemes' )
    );

    $sett[ 'header-social' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'logic'
        ),
        'label' => __( 'Use social icons in right side of header' , 'myThemes' ),
        'hint' => __( 'if disable, you can use only text ( ex: phone number )' , 'myThemes' ),
        'action'=> "{ 'f' : '.header-textarea' , 't' : '-' }"
    );

    if( !myThemes::pget( 'header-social' ) ){
        $textClass = 'header-textarea';
    }else{
        $textClass = 'header-textarea hidden';
    }

    $sett[ 'header-text' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'textarea',
            'validator' => 'noesc'
        ),
        'templateClass' => $textClass,
        'label' => __( 'Text for right side of header' , 'myThemes' ),
        'hint' => __( 'you can use HTML tags' , 'myThemes' )
    );
}



{   /* LAYOUT SETTINGS */ 

    $sett[ 'title-layout' ] = array(
        'type' => array(
            'template' => 'code'
        ),
        'title' => __( 'Layout Settings' , 'myThemes' )
    );

    $sett[ 'layout' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'imageSelect'
        ),
        'values' => array(
            'right'  => get_template_directory_uri() . '/media/images/left.layout.png',
            'left' => get_template_directory_uri() . '/media/images/right.layout.png',
            '1+content'  => get_template_directory_uri() . '/media/images/full.layout.png'
        ),
        'coll' => 3,
        'label' => __( 'Default layout' , 'myThemes' ),
        'hint' => __( 'If not is set custom layout, will be used default layout.' , 'myThemes' ),
        'action' => "[ 'hs' , { '1+content' : '.layout-sidebar' } ]"
    );

    $values = array_merge( array(
        'main-sidebar' => __( 'Main Sidebar' , 'myThemes' ),
        'second-sidebar' => __( 'Front Page Sidebar' , 'myThemes' ),
        'third-sidebar' => __( 'Post Sidebar' , 'myThemes' ),
        'fourth-sidebar' => __( 'Additional Sidebar' , 'myThemes' ),
    ) );

    if( myThemes::pget( 'layout' ) == '1+content' ){
        $sidebarClass = 'layout-sidebar hidden';
    }else{
        $sidebarClass = 'layout-sidebar';
    }

    $sett[ 'sidebar' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'select'
        ),
        'templateClass' => $sidebarClass,
        'values' => $values,
        'label' => __( 'Default sidebar' , 'myThemes' ),
    );
    
    $sett[ 'front-page-layout' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'imageSelect'
        ),
        'values' => array(
            'right'  => get_template_directory_uri() . '/media/images/left.layout.png',
            'left' => get_template_directory_uri() . '/media/images/right.layout.png',
            '1+content'  => get_template_directory_uri() . '/media/images/full.layout.png'
        ),
        'coll' => 3,
        'label' => __( 'Front page layout' , 'myThemes' ),
        'hint' => __( 'If not is set front page layout, will be used default layout.' , 'myThemes' ),
        'action' => "[ 'hs' , { '1+content' : '.front-page-sidebar' } ]"
    );

    if( myThemes::pget( 'front-page-layout' ) == '1+content' ){
        $sidebarClass = 'front-page-sidebar hidden';
    }else{
        $sidebarClass = 'front-page-sidebar';
    }

    $sett[ 'front-page-sidebar' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'select'
        ),
        'templateClass' => $sidebarClass,
        'values' => $values,
        'label' => __( 'Front page sidebar' , 'myThemes' ),
    );
    
    $sett[ 'single-layout' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'imageSelect'
        ),
        'values' => array(
            'right'  => get_template_directory_uri() . '/media/images/left.layout.png',
            'left' => get_template_directory_uri() . '/media/images/right.layout.png',
            '1+content'  => get_template_directory_uri() . '/media/images/full.layout.png'
        ),
        'coll' => 3,
        'label' => __( 'Single post layout' , 'myThemes' ),
        'hint' => __( 'If not is set single post layout, will be used default layout.' , 'myThemes' ),
        'action' => "[ 'hs' , { '1+content' : '.single-sidebar' } ]"
    );

    if( myThemes::pget( 'single-layout' ) == '1+content' ){
        $sidebarClass = 'single-sidebar hidden';
    }else{
        $sidebarClass = 'single-sidebar';
    }

    $sett[ 'single-sidebar' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'select'
        ),
        'templateClass' => $sidebarClass,
        'values' => $values,
        'label' => __( 'Single post sidebar' , 'myThemes' ),
    );
    
    $sett[ 'page-layout' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'imageSelect'
        ),
        'values' => array(
            'right'  => get_template_directory_uri() . '/media/images/left.layout.png',
            'left' => get_template_directory_uri() . '/media/images/right.layout.png',
            '1+content'  => get_template_directory_uri() . '/media/images/full.layout.png'
        ),
        'coll' => 3,
        'label' => __( 'Single page layout' , 'myThemes' ),
        'hint' => __( 'If not is set single page layout, will be used default layout.' , 'myThemes' ),
        'action' => "[ 'hs' , { '1+content' : '.page-sidebar' } ]"
    );

    if( myThemes::pget( 'page-layout' ) == '1+content' ){
        $sidebarClass = 'page-sidebar hidden';
    }else{
        $sidebarClass = 'page-sidebar';
    }

    $sett[ 'page-sidebar' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'select'
        ),
        'templateClass' => $sidebarClass,
        'values' => $values,
        'label' => __( 'Single page sidebar' , 'myThemes' ),
    );
}



{   /* SOCIAL SETTINGS */
    
    $sett[ 'title-social' ] = array(
        'type' => array(
            'template' => 'code'
        ),
        'title' => __( 'Social Settings' , 'myThemes' )
    );

    $sett[ 'twitter' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text'
        ),
        'label' => __( 'Set twitter profile page URL' , 'myThemes' )
    );

    $sett[ 'vimeo' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text'
        ),
        'label' => __( 'Set vimeo profile page URL' , 'myThemes' )
    );

    $sett[ 'stumble' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text'
        ),
        'label' => __( 'Set stumble profile page URL' , 'myThemes' )
    );

    $sett[ 'behance' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text'
        ),
        'label' => __( 'Set behance profile page URL' , 'myThemes' )
    );

    $sett[ 'yahoo' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text'
        ),
        'label' => __( 'Set yahoo profile page URL' , 'myThemes' )
    );

    $sett[ 'fb-profile' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text'
        ),
        'label' => __( 'Set facebook user profile or page URL' , 'myThemes' )
    );

    $sett[ 'rss' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'logic'
        ),
        'label' => __( 'Use RSS feed on your site' , 'myThemes' )
    );
}



{   /* OTHERS SETTINGS */
    
    $sett[ 'title-others' ] = array(
        'type' => array(
            'template' => 'code'
        ),
        'title' => __( 'Others Settings' , 'myThemes' )
    );

    $sett[ 'css' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'textarea',
            'validator' => 'noesc'
        ),
        'label' => __( 'Add custom css' , 'myThemes' )
    );
}
?>