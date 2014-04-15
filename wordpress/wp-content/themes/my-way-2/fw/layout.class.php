<?php
/*
    Version : 0.0.2
 */

class layout {
    public $layout = '';
    public $sidebars = '';
    public $sidebarsNr = '';
    public $contentClass = '';
    public $itemid = '';
    public $template = '';
    public $containerClass = '';
    public $width = 940;
	
    function _get( $setting, $template, $itemId ) {
        
        /* ONLYR FOR CATEGORY TEMPLATE */
        $rett = '';
        $id = $itemId;
        $temp = $template;
			
        switch( $template ){
			
            case 'front-page':
            case 'single':
            case 'page':
                $rett = meta::get( $itemId , 'post-' . $setting );
                
                if( $rett ) break;
                $rett = myThemes::get( $template . '-' . $setting  );
                
                if( $rett ) break;
                $rett = myThemes::get( $setting  );
            default: {		
                $rett = myThemes::get( $setting  );
                break;
            }
        }
		
        return $rett;
    }

    function layout( $template, $itemId = 0 )
    {   
        $this -> itemid = $itemId;
        $this -> template = $template;
        
        $this -> layout = $this -> _get( 'layout' , $template, $itemId );
        
        if( $this -> layout == 'left' || $this -> layout == 'right' ){
            $this -> contentClass = 'grid_a';
            $this -> containerClass = 'm';
            $this -> width = 690;
            return;
        }
        
        $d = explode( '+', $this -> layout );

        $gridSize = ( int )$d[ 0 ];
        $sCount = 0;
        for( $i = 1; $i < count( $d ); $i++ ) {
            if( $d[ $i ] != 'content' ) {
                $sCount++;
            }
        }
		
        if( ( $gridSize - $sCount ) > 1  )
            $this->contentClass = 'm grid_' . ( $gridSize - $sCount ) . '_' . $gridSize;
        else
            $this->contentClass = 'm grid_' . $gridSize;
        
        $this->sidebarsNr = $sCount;
        
        if( $gridSize - $sCount )
            $size = ( $gridSize - $sCount ) . '/' . $gridSize;
        else
            $size = 1;
    }
	
    function echoSidebar( )
    {       
        
        $sidebar = $this -> _get( 'sidebar', $this -> template, $this -> itemid );
        
        if( $this -> layout == 'left' || $this -> layout == 'right' ){
            echo "<div class='grid_b f{$this->layout[0]}'>";
            
            ob_start();
            
                dynamic_sidebar( $sidebar );
                
            $content = ob_get_clean();
            
            if( empty( $content ) && !myThemes::get( 'default-content' ) ){
                echo '<div id="search" class="content-widget widget_search">';
                
                echo '<form action="' . esc_url( home_url() ) . '/" method="get" id="searchform">';
                echo '<fieldset>';
                
                echo '<div id="searchbox">';
                echo '<input class="input" name="s" type="text" id="keywords" value="' . __( 'type here...' , 'myThemes' ) . '" onfocus="if (this.value == \'' . __( 'type here...' , 'myThemes' ) . '\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'' . __( 'type here...' , 'myThemes' ) . '\';}">';
                echo '<input type="submit" class="mytheme-bkg mytheme-bkg-dark-hover" value="">';
                echo '</div>';
                
                echo '</fieldset>';
                echo '</form>';
                
                echo '</div>';
                
                $tags = get_tags();
                
                if( !empty( $tags ) ){
                    
                    echo '<div id="tag_cloud" class="content-widget widget_tag_cloud">';
                    echo '<h4 class="sidebartitle mytheme-bkg"><span>' . __( 'Tags' , 'myThemes' ) . '</span></h4>';
                    echo '<div class="tagcloud">';
                    
                    foreach ( $tags as $tag ) {
                        echo '<a href="' . get_tag_link( $tag -> term_id ) . '" title="' . $tag -> name . ' ' . __( 'Tag' , 'myThemes' ) . '" class="' . $tag -> slug . '">';
                        echo $tag->name . '</a>';
                    }
                    
                    echo '</div>';
                    echo '</div>';
                }
                
                $categories = get_categories( );
                
                if( !empty( $categories ) ){
                
                    echo '<div id="categories" class="content-widget widget_categories">';
                    echo '<h4 class="sidebartitle mytheme-bkg"><span>' . __( 'Categories' , 'myThemes' ) . '</span></h4>';
                    echo '<ul>';
                    foreach( $categories as $c ){
                        echo '<li class="cat-item cat-item-' . $c -> term_id . '">';
                        echo '<a href="' . get_category_link( $c -> term_id ) . '" title="' . __( 'View all posts filed under' , 'myThemes' ) . ' ' . $c -> name . '">' . $c -> name . '</a>';
                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                }
                
                echo '<div id="my_wdg_flickr" class="content-widget widget_flickr">';
                echo '<h4 class="sidebartitle mytheme-bkg"><span>' . __( 'Flickr Photogallery' , 'myThemes' ) . '</span></h4>';
                echo '<div class="flickr">';
                echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=9&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=76308456@N06"></script>';
                echo '<div class="clearfix"></div>';
                echo '</div>';
                echo '</div>';
                
                echo '<div id="my_wdg_newsletter" class="content-widget widget_newsletter">';
                echo '<h4 class="sidebartitle mytheme-bkg"><span>' . __( 'Subscribe Newsletter' , 'myThemes' ) . '</span></h4>';
                echo '<span class="description">subscribe with FeedBurner</span>';
                echo '<form class="subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="javascript:utils.feedburner( \'mythem_es\' );">';
                echo '<fieldset>';
                echo '<input type="text" class="text" name="email" value="' . __( 'E-mail' , 'myThemes' ) . '" onfocus="if (this.value == \'' . __( 'E-mail' , 'myThemes' ) . '\') {this.value = \'\';}" onblur="if (this.value == \'\' ) { this.value = \'' . __( 'E-mail' , 'myThemes' ) . '\';}"><span class="email"></span>';
                echo '<input type="hidden" value="mythem_es" name="uri">';
                echo '<input type="hidden" name="loc" value="en_US">';
                echo '<input type="submit" class="mytheme-bkg mytheme-bkg-dark-hover" value="">';
                echo '</fieldset>';
                echo '</form>';
                echo '</div>';
            }
            else{
                echo $content;
            }
            
            echo "<div class='clearfix'></div>";
            echo "</div>";
            return;
        }
        
        $d = explode( '+', $this -> layout );
        
        $sidebarClass = 'grid_1_' . ( ( int )$d[ 0 ] );
        $leftSidebar = 'fl';
        $sCount = 0;
        
        for( $i = 1; $i < count( $d ); $i++ ) {
            if( $d[ $i ] == 'content' ) {
                $leftSidebar = 'fr';
                continue;
            }

            echo "<div class='$sidebarClass $leftSidebar'>";
                dynamic_sidebar( $sidebar );
            echo "<div class='clearfix'></div>";
            echo "</div>";
        }
    }
	
    function contentClass( ) {
        return $this->contentClass;
    }
    
    function countSidebars( $layout )
    {
        return count( explode( '+', $layout ) ) - 2;
    }
}
?>