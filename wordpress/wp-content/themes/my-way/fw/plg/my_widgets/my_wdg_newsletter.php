<?php
class my_wdg_newsletter extends WP_Widget {
    
	function my_wdg_newsletter() {
        
        /* INIT CONSTRUCTOR */
        $widget_ops = array(
            'classname' => 'widget_newsletter', 
            'description' => __( 'Google FeedBurner Newsletter' , 'myThemes' ) 
        );
        
	$this -> WP_Widget( 'my_wdg_newsletter' , myThemes::group() . ' : ' . __( 'Newsletter' , 'myThemes' ) , $widget_ops );
    }

    function widget( $args, $instance )
    {
        /* PRINT THE WIDGET */
	extract( $args , EXTR_SKIP );
        
        $title  = !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $ID  = !empty( $instance[ 'ID' ] ) ? $instance[ 'ID' ] : '';
            
        if( !empty( $ID ) ) {
            
            echo $before_widget;
            
            if( !empty( $title ) ){
                echo $before_title;
                echo $title;
                echo $after_title;
            }
            
            echo '<span class="description">' . __( 'subscribe with FeedBurner' , 'myThemes' ) . '</span>';
    ?>   
            <form class="subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="javascript:utils.feedburner( '<?php echo $ID; ?>' );">
                <fieldset>
                    <input type="text" class="text" name="email" value="<?php esc_attr_e( 'E-mail' , "myThemes" ); ?>" onfocus="if (this.value == '<?php esc_attr_e( 'E-mail' , "myThemes" ); ?>') {this.value = '';}" onblur="if (this.value == '' ) { this.value = '<?php esc_attr_e( 'E-mail' , "myThemes" ); ?>';}"><span class="email"></span>
                    <input type="hidden" value="<?php echo $ID; ?>" name="uri">
                    <input type="hidden" name="loc" value="en_US">
                    <input type="submit" class="mytheme-bkg mytheme-bkg-dark-hover" value="">
                </fieldset>
            </form>
    <?php        
            echo $after_widget;
        }
    }

    function update( $new_instance, $old_instance )
    {
        $instance[ 'title' ]    = esc_attr( $new_instance[ 'title' ] );
        $instance[ 'ID' ]       = esc_attr( $new_instance[ 'ID' ] );
        return $instance;
    }

    function form( $instance )
    {
        /* PRINT WIDGET FORM */
        $instance = wp_parse_args( (array) $instance, array(
            'title' => '',
            'ID' => '',
        ));
        
        $title     = $instance[ 'title' ];
        $ID     = $instance[ 'ID' ];
        
        echo '<p>';
        echo '<label for="' . $this -> get_field_id( 'title' ) . '">' . __( 'Title' , 'myThemes' );
        echo '<input type="text" class="widefat" id="' . $this -> get_field_id( 'title' ) . '" name="' . $this -> get_field_name( 'title' ) . '" value="' . $title . '"/>';
        echo '</label>';
        echo '</p>';
        
        echo '<p>';
        echo '<label for="' . $this -> get_field_id( 'ID' ) . '">' . __( 'Google FeedBurner ID' , 'myThemes' );
        echo '<input type="text" class="widefat" id="' . $this -> get_field_id( 'ID' ) . '" name="' . $this -> get_field_name( 'ID' ) . '" value="' . $ID . '">';
        echo '</label>';
        echo '</p>';
    }
}
?>