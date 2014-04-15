<?php
/// ////////////////////////////////////////////////////////////////////////////
// Gallery
/*
[gallery ids='1,23,45' columns='4']
*/
class my_sc_gallery{
    static $min = 0;
    static function run( $_attr, $_content = null )
    {
        global $myLayout, $post;
        
        $attr = shortcode_atts( array(
            'order'     => 'ASC',
            'orderby'   => 'menu_order ID',
            'id'        => $post -> ID,
            'ids'       => '',
            'itemtag'   => 'dl',
            'icontag'   => 'dt',
            'captiontag'=> 'dd',
            'columns'   => 3,
            'size'      => 'thumbnail',
            'include'   => '',
            'exclude'   => ''
	) , $_attr );
        
        $cols = $attr[ 'columns' ];
        $ids = array();
        
        if( empty( $attr[ 'ids' ] ) ){
            
            $id         = intval( $attr[ 'id' ] );
            $orderby    = $attr[ 'order' ];
            $order      = $attr[ 'order' ];
            $include    = $attr[ 'include' ];
            $exclude    = $attr[ 'exclude' ];
            
            if ( 'RAND' == $attr[ 'order' ] ) {
		$orderby = 'none';
            }
            
            if ( !empty( $include ) ) {
		$attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
            } elseif ( !empty( $exclude ) ) {
                $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
            } else {
                $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
            }
            
            foreach ( $attachments as $key => $val ) {
                $ids[ ] = $val -> ID ;
            }       
        }else{
            $ids = explode( ',' , $attr[ 'ids' ] );
        }
        
        $thumb = (int)( ( $myLayout -> width - $cols + 1 ) / $cols );
        $width = ( $thumb + 1 ) * $cols - 1 ;
        
        $result  = '<div class="mythemes_sc_gallery" style="width: ' . $width. 'px;">';
        
        $min = 0;
        $i = 0;
        foreach( $ids as $id ){
            $full = wp_get_attachment_image_src( $id , 'full' );
            
            if( (int)$full[ 1 ] == 0 ){
                return;
            }
            
            $height = (int) ( $thumb * $full[ 2 ] / $full[ 1 ] ) ;
            if( $min == 0 || $min > $height ) {
                $min = $height;
            }
        }
            
        foreach( $ids as $id ){
            $i++;
            
            $p = get_post( $id );
            if( $i % $cols == 1 || $cols == 1 ){
                $result .= '<div class="mythemes_sc_gallery_line">';
            }
            
            $media = wp_get_attachment_image_src( $id , array( $thumb , $thumb ) );
            
            $full = wp_get_attachment_image_src( $id , 'full' );
            
            $result .= '<div class="mythemes_sc_gallery_item" style="width:' . $thumb .'px; height: ' .  $min . 'px;">';
            $result .= '<a href="' . $full[ 0 ] . '" rel="prettyPhoto[pp_gal]" title="' . $p -> post_excerpt . '">';
            $result .= '<div class="zoom"></div>';
            $result .= '<img src="' . $media[ 0 ] . '" alt="' . $p -> post_title . '" width="' . $thumb . '">';
            $result .= '</a>';
            $result .= '</div>';
            
            if( $i % $cols == 0 ){
                $result .= '<div class="clearfix"></div>';
                $result .= '</div>';
                $i = 0;
            }
        }
        
        if( $i % $cols > 0 ){
            $result .= '<div class="clearfix"></div>';
            $result .= '</div>';
        }
        $result .= '</div>';
        
        return $result;
    }
}
?>