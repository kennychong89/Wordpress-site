<?php
    include dirname( __FILE__ ) . '/fw/main.php';
    
    if( !isset( $content_width ) ) {
        $content_width = 620; 
    }
    
    function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
    }

    add_action( 'after_setup_theme', array( 'myThemes' , 'setup' ) );
    add_action( 'wp_enqueue_scripts', array( 'myThemes' , 'init_scripts' ) );
    add_filter( 'wp_title', array( 'myThemes' , 'title' ) , 10, 2 );
    
    add_filter( 'user_contactmethods',  array( 'myThemes' , 'user_contact' ) );
    add_filter('the_excerpt_rss', array( 'myThemes' , 'rssThumbnail' ) );
    add_filter('the_content_feed', array( 'myThemes' , 'rssThumbnail' ) );
    add_filter('upload_mimes', 'cc_mime_types');
?>
