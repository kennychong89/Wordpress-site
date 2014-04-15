<?php
    class myThemes{
        
        /* READ ADMIN SETTINGS */
        static function get( $optName , $strip = false )
        {
            return sett::get( 'mythemes-' . $optName , $strip );
        }
        
        static function pget( $optName , $strip = false )
        {
            if( isset( $_POST[ 'mythemes-' . $optName ] ) ){
                return $_POST[ 'mythemes-' . $optName ]; 
            }
            else{
                return sett::get( 'mythemes-' . $optName , $strip );
            }
        }
        
        /* READ THEME SETTINGS */
        static function cfg( $sett )
        {
            $result = '';
            $file = get_template_directory() . '/cfg/static.php';
            
            if( file_exists( $file ) ){
                include $file;
                
                if( isset( $cfg[ $sett ] ) ){
                    $result = $cfg[ $sett ];
                }
            }
            
            return $result;
        }
       
        
        /* INIT FILTERS */
        static function init_filters()
        {
            $filters = self::cfg( 'filters' );
            if( !empty( $filters ) && is_array( $filters ) ){
                foreach( $filters as $filter => & $d ){
                    add_filter( $filter , $d );
                }
            }
        }
        
        /* INIT ACTIONS */
        static function init_actions()
        {
            $actions = self::cfg( 'actions' );
            if( !empty( $actions ) && is_array( $actions ) ){
                foreach( $actions as $action => & $d ){
                    add_action( $action , $d );
                }
            }
        }
        
        /* INIT SCRIPTS */
        static function init_scripts()
        {
            wp_enqueue_script( 'jquery' );

            wp_enqueue_script( 'functions' , get_template_directory_uri() . '/media/js/functions.js' );
            wp_register_script( 'menu' , get_template_directory_uri() . '/media/js/menu.js' );

            wp_enqueue_script(
                'js-pretty-photo',
                get_template_directory_uri( ) . '/media/js/jquery.prettyPhoto.js'
            );

            wp_enqueue_script(
                'settings-pretty-photo',
                get_template_directory_uri( ) . '/media/js/settings.prettyPhoto.js'
            );

            wp_enqueue_style(
                'css-pretty-photo',
                get_template_directory_uri( ) . '/media/css/prettyPhoto.css'
            );

            /* INCLUDE FOR REPLY COMMENTS */
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
                    wp_enqueue_script( 'comment-reply' );
            
            
            
            /* INCLUDE STYLE.CSS */
            wp_enqueue_style( 'mythemes-style', get_stylesheet_uri() );
        }
        
        /* REGISTER THEME MENUS */
        static function reg_menus( )
        {
            register_nav_menus( self::cfg( 'menus' ) );
        }
        
        /* REGISTER THEME SIDEBARS */
        static function reg_sidebars( )
        {
            $sidebars = self::cfg( 'sidebars' );

            if( !empty( $sidebars ) && is_array( $sidebars ) ){
                foreach( $sidebars as $sidebar ){
                    register_sidebar( $sidebar );
                }
            }
            
            /* CUSTOM SIDEBARS */
            $custom = sett::get( self::cfg( 'custom-sidebars' ) );
            if( !empty( $custom ) && is_array( $custom ) ){
                foreach( $custom as $s ){
                    $sidebars[0][ 'name' ] = $s;
                    $sidebars[0][ 'id' ] = strtolower( str_replace( ' ' , '-' , $s ) );
                    $sidebars[0][ 'description' ] = __( 'Additional custom sidebar' , 'myThemes' );
                    register_sidebar( $sidebars[ 0 ] );
                }
            }
        }
        
        static function sidebars()
        {
            $sidebars = array( 'main-sidebar' => __( 'Main sidebar' , 'myThemes' ) );
            $custom = sett::get( self::cfg( 'custom-sidebars' ) );
            if( !empty( $custom ) ){
                foreach( $custom as $s ){
                    $sidebars[ strtolower( str_replace( ' ' , '-' , $s ) ) ] = $s;
                }
            }
            return $sidebars;
        }
        
        static function postFormats( $classes = '' )
        {
            $formats = self::cfg( 'formats' );
            
            if( !empty( $formats ) && is_array( $formats ) ){
                
                $result = !empty( $classes ) ?  '<ul class="' . $classes . '">' : '<ul class="navigation">';
                
                foreach( $formats as $format => &$d ){                    
                    if( $format == 'standard' || myTheme::get( 'formats-' . $format ) ){
                        $result .= '<li id="' . $d[ 'id' ] . '"><a href="#tab-' . $d['id'] . '" title="' . $d[ 'description' ] . '">' . $d[ 'title' ]  . '</a></li>';
                    }
                }
                
                $result .= '</ul>';
                
                echo $result;
            }
        }
        static function setup()
        {   
            load_theme_textdomain( 'myThemes' );
            load_theme_textdomain( 'myThemes' , get_template_directory() . '/media/languages' );
    
            if ( function_exists( 'load_child_theme_textdomain' ) ){
                load_child_theme_textdomain( 'myThemes' );
            }
            add_editor_style();

            add_theme_support( 'custom-background', array(
                    'default-color' => 'fafafa',
                    'default-image' => ''
            ) );
	
            add_theme_support( 'automatic-feed-links' );

            add_theme_support( 'post-thumbnails' );
            set_post_thumbnail_size( 630, 9999 );
            
            add_filter( 'wp_head' , array( 'myThemes' , 'custom_style' ) );
        }
        
        static function custom_style()
        {
             /* SET THEME COLOR */
            if( isset( $_COOKIE[ 'mytheme-color-css1' ] ) && !empty( $_COOKIE[ 'mytheme-color-css1' ] ) ){
                $color = $_COOKIE[ 'mytheme-color-css1' ];
            }else{
                $color = myThemes::get( 'theme-color' );
            }
?>

            <style id="mytheme-color-css">

                /* COLOR */
                body{
                    
                }
                
                a,
                body .mytheme-color,
                body .mytheme-color-hover:hover,
                body div.b.my-menu div.container div.grid_3_4 > ul li:hover > a,
                body div.b.my-menu div.container div.grid_3_4 > div > ul li:hover > a,
                body .mytheme-color-link-hover:hover a{
                    color: <?php echo $color; ?>;
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
                div.b.my-menu div.container div.grid_3_4 > ul ul > li:first-child,
                div.b.my-menu div.container div.grid_3_4 > div > ul ul > li:first-child{
                    border-top: 3px solid <?php echo $color; ?>;
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
                    <?php
                        $logo = myThemes::get( 'logo' );
                        if( strlen( $logo ) ){
                    ?>
                            position: absolute;
                    <?php
                        }
                    ?>
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
<?php
        }
        
        static function user_contact( $user_contact )
        {
            $user_contact['twitter']   = __( 'Twitter Username' , 'myThemes' );
            $user_contact['facebook']  = __( 'Facebook page or profile ( url )' , 'myThemes' );
            $user_contact['vimeo']     = __( 'Vimeo profile url' , 'myThemes' );
            $user_contact['stumble']   = __( 'Stumble profile url' , 'myThemes' );
            $user_contact['behance']   = __( 'Behance profile url' , 'myThemes' );
            $user_contact['yahoo']     = __( 'Yahoo profile url' , 'myThemes' );

            return $user_contact;
        }
        
        static function rssThumbnail( $content )
        {
            global $post;
            if ( has_post_thumbnail( $post->ID ) ){
                $content = '' . get_the_post_thumbnail( $post -> ID, 'small-thumb' , array( 'style' => 'float:left; margin:0 15px 15px 0;' ) ) . '' . $content;
            }
            return $content;
        }
        
        static function gravatar( $authorID , $size, $default = '' )
        {
            if( get_user_meta( $authorID , 'avatar' , true ) == -1 ){
                $result = '<img src="' . $default . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
            }else{
                if(  get_user_meta( $authorID , 'avatar' , true ) > 0 ){
                    $avatar_info = wp_get_attachment_image_src( get_user_meta( $authorID , 'avatar' , true ) , array( $size , $size ) );
                    $result = '<img src="' . $avatar_info[0] . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
                }else{
                    $result = get_avatar( $authorID , $size , $default );
                }
            }
            
            return $result;
        }
        
        
        static function comment( $comment, $args, $depth )
        {
            $GLOBALS['comment'] = $comment;
            switch ( $comment -> comment_type ) {
                case '' : {
                    echo '<li '; comment_class(); echo' id="li-comment-'; comment_ID(); echo '">';
                    echo '<div id="comment-'; comment_ID(); echo '" class="comment-box">';

                    echo '<div class="comment-avatar">';
                    echo get_avatar( $comment, 50 );
                    echo '</div>';

                    echo '<span class="comment-user">';
                    echo get_comment_author_link( $comment -> comment_ID );
                    echo '</span>';

                    echo '<span class="comment-meta">';

                    echo printf( '%1$s ' , get_comment_date() );
                    echo ' // ';
                    comment_reply_link(  array_merge(  $args , array( 
                        'depth' => $depth, 
                        'max_depth' => $args['max_depth'] 
                    )));

                    echo '</span>';

                    echo '<p class="comment-quote">';
                    if ( $comment -> comment_approved == '0' ) {
                        echo '<em class="comment-awaiting-moderation">';
                        _e( 'Your comment is awaiting moderation.' , 'myThemes' );
                        echo '</em>';
                    }
                    
                    echo get_comment_text();            
                    echo '</p>';

                    echo '<div class="clearfix"></div>';

                    echo '</div>';
                    echo '</li>';
                    break;
                }	
                case 'pingback'  :{
                }
                case 'trackback' : {
                    break;
                }
            }
        }
        
        /* RETURN NUMBER OFF CURRENT BLOG PAGE */
        static function pagination()
        {
            global $wp_query;
            if( (int) get_query_var('paged') > 0 ){
                $paged = get_query_var('paged');
            }else{
                if( (int) get_query_var('page') > 0 ){
                    $paged = get_query_var('page');
                }else{
                    $paged = 1;
                }
            }
            
            return $paged;
        }
        
        /* DISPLAY BLOG TITLE */
        static function title( $title, $sep )
        {
            global $paged, $page;

            if ( is_feed() )
		return $title;

            /*/ Add the site name. */
            $title .= get_bloginfo( 'name' );

            /*/ Add the site description for the home/front page. */
            $site_description = get_bloginfo( 'description', 'display' );
            if ( $site_description && ( is_home() || is_front_page() ) )
                $title = "$title $sep $site_description";

            /*/ Add a page number if necessary. */
            if ( $paged >= 2 || $page >= 2 )
                $title = "$title $sep " . sprintf( __( 'Page %s', 'myThemes' ), max( $paged, $page ) );

            return $title;
        }
        
        static function favicon( $settings = 'favicon' )
        {
            if( myThemes::get( $settings ) ){
                echo '<link rel="shortcut icon" href="' . myThemes::get( $settings ) . '"/>';
            }
            else{
                if( file_exists(  get_template_directory() . '/favicon.ico' ) )
                    echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/favicon.ico"/>';
            }
        }
        
        static function ajaxurl()
        {
            echo '<script>';
            echo "var ajaxurl = '" . admin_url( '/admin-ajax.php' ) . "'";
            echo '</script>';
        }
        
        static function group()
        {
            return "myThemes";
        }
        
        static function name()
        {
            $theme = wp_get_theme();
            return $theme -> title;
        }
        
        static function version()
        {
            $theme = wp_get_theme();
            return $theme -> version;
        }
        
        static function size( $id )
        {
            return '1/' . $id;
        }
        
        static function breadcrumbs()
        {
            
            $delimiter = '';
            $home = __( 'Home' , 'myThemes' );

            $before = '<li>';
            $beforecurrent = '<li><span class="mytheme-bkg"></span>';
            $after = '</li>';
            
            echo '<div class="b breadcrumbs">';
            echo '<div class="container">';
                
            if (  ( !is_front_page() || is_paged() ) && get_post_type() !== 'forum' && get_post_type() !== 'topic' ) {
                
                
                echo '<ul class="my-breadcrumbs navigation">';
                
                global $post;
                $homeLink = home_url();
                echo '<li><a href="' . $homeLink . '">' . $home . '</a> </li>' . $delimiter . ' ';

                if ( is_category() ) {
                    global $wp_query;
                    $cat_obj = $wp_query -> get_queried_object();
                    $thisCat = $cat_obj -> term_id;
                    $thisCat = get_category( $thisCat );
                    $parentCat = get_category($thisCat -> parent);
                    if ( $thisCat -> parent != 0 )
                        echo( $before . get_category_parents( $parentCat , true , ' ' . '</li><li>' . ' ' ) . $after );
                    
                    echo $beforecurrent . __( 'Archive by category' , 'myThemes' ) . ' "' . single_cat_title( '' , false ) . '"' . $after;

                } elseif ( is_day() ) {
                    echo $before . '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time('Y') . '</a> ' . $after . $delimiter . ' ';
                    echo $before . '<a href="' . get_month_link( get_the_time( 'Y' ) , get_the_time( 'm' ) ) . '">' . get_the_time('F') . '</a> ' . $after . $delimiter . ' ';
                    echo $beforecurrent . get_the_time( 'd' ) . $after;

                } elseif ( is_month() ) {
                    echo $before . '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> '. $after . $delimiter . ' ';
                    echo $beforecurrent . get_the_time( 'F' ) . $after;
                } elseif ( is_year() ) {
                    echo $beforecurrent . get_the_time( 'Y' ) . $after;
                } elseif ( is_single() && !is_attachment() ) {
                    echo $beforecurrent . get_the_title() . $after;
                } elseif ( is_attachment() ) {
                    $parent = get_post( $post -> post_parent );
                    echo $before . '<a href="' . get_permalink($parent) . '">' . $parent -> post_title . '</a> ' . $after . $delimiter . ' ';
                    echo $beforecurrent . get_the_title() . $after;
                } elseif ( is_page() && !$post -> post_parent ) {
                    if( get_query_var( 'paged' ) ){
                        echo $before;
                    }else{
                        echo $beforecurrent;
                    }
                    echo get_the_title() . $after;
                } elseif ( is_page() && $post -> post_parent ) {
                    $parent_id  = $post -> post_parent; 
                    $breadcrumbs = array();
                    while ( $parent_id ) {
                        $page = get_page($parent_id);
                        $breadcrumbs[] = $before . '<a href="' . get_permalink( $page -> ID ) . '">' . get_the_title( $page -> ID ) . '</a>' . $after;
                        $parent_id  = $page->post_parent;
                    }
                    
                    $breadcrumbs = array_reverse( $breadcrumbs );
                    foreach ( $breadcrumbs as $crumb )
                        echo $crumb . ' ' . $delimiter . ' ';
                    
                    echo $beforecurrent . get_the_title() . $after;

                } elseif ( is_search() ) {
                    if ( get_query_var( 'paged' ) )
                        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
                            echo $before;
                        else
                            echo $beforecurrent;
                    else
                        echo $beforecurrent;
                        
                    echo __( 'Search results for' , 'myThemes' ) . ' "' . get_search_query() . '" ' . $after;

                } elseif ( is_tag() ) {
                    echo $beforecurrent . __( 'Posts tagged' , 'myThemes' ) . ' "' . single_tag_title( '' , false ) . '"' . $after;

                } elseif ( is_author() ) {
                    global $author;
                    $userdata = get_userdata( $author );
                    echo $beforecurrent . __( 'Articles posted by ' , 'myThemes' ) . $userdata -> display_name . $after;

                } elseif ( is_404() ) {
                    echo $beforecurrent . __( 'Error 404' , 'myThemes' ) . $after;
                }
                
                if( is_home() ){
                    if( (int)get_option( 'page_for_posts' ) ){
                        $p = get_post( get_option( 'page_for_posts' ) );
                        if ( get_query_var( 'paged' ) ) {
                            echo $before;
                        }else{
                            echo $beforecurrent;
                        }
                        echo $p -> post_title . $after;
                    }else{
                        if ( get_query_var( 'paged' ) ) {
                            echo $before;
                        }else{
                            echo $beforecurrent;
                        }
                        echo __( 'Blog' , 'myThemes' ) . $after;
                    }
                }

                if ( get_query_var( 'paged' ) ) {
                    echo $beforecurrent;
                    
                    echo __( 'Page' , 'myThemes' ) . ' ' . get_query_var( 'paged' );
                    
                    echo $after;
                }
                echo '</ul>';
            }
            
            echo '</div>';
            echo '</div>';
        }
    }
?>