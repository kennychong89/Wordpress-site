<?php
class mytheme_admin {

    static function pageHeader( $pageSlug )
    {
        echo '<div class="mytheme-admin-header">';
        echo '<span class="theme"><strong>' . myThemes::name() . '</strong> ' . __( 'Version' , 'myThemes' ) . ': ' . myThemes::version() . '</span>';
        echo '<a href="http://mythem.es" target="_blank" title="Affordable WordPress Themes For Your Website or Blog"><img src="' . MYTHEMES_DEV_LOGO . '" /></a>';
        echo '<p><a href="http://mythem.es" target="_blank" title="Affordable WordPress Themes For Your Website or Blog">Affordable WordPress Themes For Your Website or Blog</a></p>';
        echo '</div>';

        echo '<table class="admin-body">';
        echo '<tr>'; /*
        echo '<td class="admin-menu">';
        echo '<ul>';

        $current_title = '';

        foreach( acfg::$pages as $slug => &$d ) {
            $title = $d[ 'menu' ][ 'label' ];
            $class = '';

            if( $slug == $pageSlug ) {	
                $class = 'current';
                $subClass = $slug;
                $current_title = $title;
            }
            else{
                $subClass = $slug . ' hidden';
            }

            echo '<li class="' . $class . '">';

            if( isset( $d[ 'subpages' ] ) ){

                echo '<a href="javascript:(function(){jQuery( \'ul.' . $slug . '\' ).toggle( \'slow\' ); })()">' . $title . '</a>';
                echo '<ul class="' . $subClass . '">';
                foreach( $d[ 'subpages' ] as $subpage => & $s ){
                    echo '<li><a href="?page=' . $slug . '&subpage=' . $subpage . '">' . $s[ 'menu' ][ 'label' ] . '</a></li>';
                }
                echo '</ul>';
            }else{
                echo '<a href="?page=' . $slug . '">' . $title . '</a>';
            }

            echo '</li>';
        }

        echo '</ul>';
        echo '</td>'; */
    }

    static function pageContent( $pageSlug )
    {
        $cfgs = & acfg::$pages[ $pageSlug ];
        
        $file = str_replace( 'mythemes-' , '' , $pageSlug );
            
        $sett_    = get_template_directory() . '/cfg/admin/settings';
        $sett_dir = $sett_ . '/' . $file;
        
        if( file_exists( $sett_dir . '.php' ) ){
            include $sett_dir . '.php';
        }
        
        $st = $cfgs[ 'content' ];
        
        if( !empty( $_POST ) ){
            foreach( $_POST as $key => & $d ){
                if( substr( $key , 0 , 9 ) == 'mythemes-' ){
                    $fName = str_replace( 'mythemes-' , '' ,  $key );
                    
                    $validator = '';
                    if( isset( $_POST[ $key ] ) && isset( $st[ $fName ] ) )
                        $validator = ahtml::validator( $_POST[ $key ] , ahtml::getValidator( $st[ $fName ] ) );
                    
                    set_theme_mod( $key , $validator );
                }
            }
        }
        
        $rett = '<td class="admin-content">';
			
        {   /* PAGE TITLE */
            
            $rett .= '<div class="title">';
				
            if( isset( $cfgs[ 'title' ] ) ) {
                $rett .= '<h2>' . $cfgs[ 'title' ] . '</h2>';
            }

            if( isset( $cfgs[ 'description' ] ) ){
                $rett .= '<p>' . $cfgs[ 'description' ] . '</p>';
            }

            $rett .= '</div>';
        }
			
        /* SUBMIT FORM */
        if( !isset( $cfgs[ 'update' ] ) || ( isset( $cfgs[ 'update' ] ) && $cfgs['update'] ) ){
            $rett .= '<form method="post">';
        }
			
        settings_fields( 'mythemes' );
        $content = $cfgs[ 'content' ];
			
        if( isset( $content ) && !empty( $content ) ) {
            foreach( $content  as $fieldName => $sett ) {
                $sett[ 'pageSlug' ]     = $pageSlug;
                $sett[ 'fieldName' ]    = $fieldName;
                $sett[ 'value' ]        = sett::get( 'mythemes-' . $fieldName );
                $rett .= ahtml::template( $sett );
            }
        }
			
        {   /* SUBMIT BUTTON */
            if( !isset( $cfgs[ 'update' ] ) || ( isset( $cfgs[ 'update' ] ) && $cfgs['update'] ) ){
                $rett .= '<div class="standart-generic-field submit top_delimiter">';
                $rett .= '<div class="field">';
                $rett .= '<input type="submit" class="button button-primary my-submit button-hero" value="' . __( 'Update Settings' , "myThemes" ) . '"/>';
                $rett .= '</div>';
                $rett .= '</div>';
                $rett .= '</form>';
            }
        }
            
        $rett .= '</td>';
        $rett .= '<td class="mythemes-credits">';
        $rett .= '<div class="title">';
        $rett .= '<h3>myThem.es Links</h3>';
        $rett .= '</div>';
        $rett .= '<ul style="margin-top: -5px;">';
        $rett .= '<li><a target="_blank" href="http://mythem.es/" title="myThem.es - HTML5, CSS3, creative design and premium WordPress themes">Home Page</a></li>';
        $rett .= '<li><a target="_blank" href="http://mythem.es/contact/" title="Contact myThem.es directly">Contact</a></li>';
        $rett .= '<li><a target="_blank" href="http://mythem.es/forums/topic/general-about-customizations/" title="myThem.es customizations and services">Customization</a></li>';
        $rett .= '</ul>';
        $rett .= '<ul class="with-border">';
        $rett .= '<li><a target="_blank" href="http://mythem.es/item/my-way-premium/my-way-free/" title="my Way WordPress theme details">my Way - Theme Details</a></li>';
        $rett .= '<li><a target="_blank" href="http://mythem.es/forums/forum/themes/my-way/my-way-free/" title="my Way support forum">my Way - Theme Support</a></li>';
        $rett .= '</ul>';
        $rett .= '<ul class="with-border">';
        $rett .= '<li><a target="_blank" href="http://facebook.com/myThemes" title="Follow myThem.es on Facebook">Follow us on Facebook</a></li>';
        $rett .= '<li><a target="_blank" href="http://twitter.com/my_themes" title="Follow myThem.es on Twitter">Follow us on Twitter</a></li>';
        $rett .= '</ul>';
        $rett .= '<ul class="with-border">';
        $rett .= '<li><a target="_blank" href="http://mythem.es/item/my-way-premium/" title="my Way premium wordpress theme"><strong>my Way Premium Version</strong></a></li>';
        $rett .= '</ul>';
        $rett .= '</td>';
        $rett .= '</tr>';
        $rett .= '</table>';
        
        return $rett;
    }
    
    static function echoPage( )
    {

        if( !isset( $_GET ) || !isset( $_GET[ 'page' ] ) ){
            wp_die( 'Invalid page name', 'myThemes' );
            return;
        }

        $pageSlug = $_GET[ 'page' ];

        /* NOTIFICATION */
        if( isset( $_GET[ 'settings-updated' ] ) && $_GET[ 'settings-updated' ] == 'true' ){
            echo '<div class="updated settings-error myTheme" id="setting-error-settings_updated">';
            echo '<p>' . __( 'options has been updated successfully' , 'myThemes' ) . '</p>';
            echo '</div>';
        }

        echo '<div class="admin-page">';
        echo self::pageHeader( $pageSlug );
        echo self::pageContent( $pageSlug );
        echo '</div>';
    }
    
    static function init_mainMenu( ) 
    {
        $parent = '';
        $pageCB = array( 'mytheme_admin', 'echoPage' );
        foreach( acfg::$pages as $pageSlug => $d ) {	
            if( isset( $d[ 'menu' ] ) ) {
                $m = $d[ 'menu' ];
                if( strlen( $parent ) == 0 ) {
                    add_theme_page(
                        $m[ 'label' ]                                           /* page_title   */
                        , $m[ 'label' ]                                         /* menu_title   */
                        , 'administrator'                                       /* capability   */
                        , $pageSlug                                             /* menu_slug    */
                        , $pageCB                                               /* function     */
                        , $m[ 'ico' ]                                           /* icon_url     */
                    );
                    $parent = $pageSlug;
                }
                else {
                    add_theme_page(
                        "mythemes" . "&nbsp;&raquo;&nbsp;" . $m[ 'label' ]	/* page_title   */
                        , $m[ 'label' ]                                         /* menu_title   */
                        , 'administrator'                                       /* capability   */
                        , $pageSlug                                             /* menu_slug    */
                        , $pageCB                                               /* function     */
                    );
                }
            }
        }
    }

    static function save( $exclude = array() )
    {
        if( !isset( $_POST ) || empty( $_POST ) )
            return null;

        foreach( $_POST as $sett => $value )
            if( substr( $sett , 0 , 8 ) == 'mytheme-' && !in_array( $sett , $exclude ) )
                sett::set( $sett , $value );
    }

    static function load_css(){
        if( is_admin() ){
            
            if( strlen( str_replace( '/wp-admin/themes.php' , '' , $_SERVER[ 'SCRIPT_NAME'] ) ) < strlen( $_SERVER[ 'SCRIPT_NAME'] ) )
                wp_enqueue_media();
            
            wp_enqueue_style( 'farbtastic' );
            wp_enqueue_style( 'ui-lightness' );
            wp_enqueue_style( 'thickbox' );

            wp_register_style( 'admin' ,  get_template_directory_uri() . '/media/admin/css/admin.css' );
            wp_register_style( 'ahtml' ,  get_template_directory_uri() . '/media/admin/css/ahtml.css' );

            wp_register_style( 'template' ,  get_template_directory_uri() . '/media/admin/css/template.css' );

            wp_enqueue_style( 'admin' );
            wp_enqueue_style( 'ahtml' );
            wp_enqueue_style( 'template' );
        }
    }

    static function load_js(){
        if( is_admin( ) ){
            wp_register_script( 'autocomplete' , get_template_directory_uri() . '/media/admin/js/autocomplete.js' , array( 'jquery' , 'media-upload' , 'thickbox' ) );
            wp_register_script( 'fields' ,  get_template_directory_uri() . '/media/admin/js/fields.js' ) ;
            wp_register_script( 'tools' ,  get_template_directory_uri() . '/media/admin/js/tools.js' ) ;

            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'thickbox' );

            {   /* INCLUDE FARBTASTIC JS */
                $siteurl = get_option( 'siteurl' );

                if( !empty($siteurl) ){
                    $farbtastic_url = rtrim( $siteurl , '/') . '/wp-admin/js/farbtastic.js' ;
                }else{
                    $farbtastic_url = home_url('/wp-admin/js/farbtastic.js');
                }

                wp_register_script( 'my-farbtastic' , $farbtastic_url );                
                wp_enqueue_script( 'my-farbtastic' );
            }

            wp_enqueue_script( 'autocomplete' );
            wp_enqueue_script( 'fields' );
            wp_enqueue_script( 'tools' );
        }
    }
};

add_action( 'admin_menu' , array( 'mytheme_admin', 'init_mainMenu' ) );
add_action( 'init' , array( 'mytheme_admin' , 'load_js' ) );
add_action( 'init' , array( 'mytheme_admin' , 'load_css' ) );
?>