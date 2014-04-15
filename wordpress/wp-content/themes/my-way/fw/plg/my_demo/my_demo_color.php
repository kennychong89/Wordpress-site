<?php
class my_demo_color
{
    static function run()
    {
        if( !is_admin() ){
            wp_register_style( 'mytheme-demo-css' , get_template_directory_uri( ) . '/fw/plg/my_demo/my_demo.css' );
            
            wp_enqueue_style( 'mytheme-demo-css' );

            wp_register_script( 'cookie' , get_template_directory_uri() . '/media/js/jquery.cookie.js' );

            wp_enqueue_script( 'cookie' );

            wp_register_script( 'mytheme-demo-js', get_template_directory_uri( ) . '/fw/plg/my_demo/my_demo.js' );
            wp_enqueue_script( 'mytheme-demo-js' );

            wp_enqueue_style( 'farbtastic' );

            wp_register_script( 'farbtastic' , admin_url() . '/js/farbtastic.js' );
            wp_register_script( 'fields' , get_template_directory_uri() . '/media/admin/js/fields.js' );

            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'farbtastic' );
            wp_enqueue_script( 'fields' );
        }
        
        if( isset( $_COOKIE[ 'mytheme-color-css' ] ) && !empty( $_COOKIE[ 'mytheme-color-css' ] ) ){
            $color = $_COOKIE[ 'mytheme-color-css' ];
        }else{
            $color = myThemes::get( 'general-color' );
        }
    
        echo '<div class="mytheme_demo_panel" style="display:none;">';
        
        echo '<div class="mytheme_demo_trigger mytheme-bkg mytheme-bkg-dark-hover">';
        echo '<a href="javascript:void(null);"></a></div>';
        
        echo '<div id="my-template-mytheme-general-color" class="inline-type">';
        
        echo '<div class="label">';
        echo '<label for="my-field-mytheme-general-color">Set Color</label>';
        echo '</div>';
        
        echo '<div class="input">';
        echo '<input rel="function(){ owerflowStyle(); }"type="text" id="my-field-mytheme-general-color" class="my-field my-field-pickColor " name="mytheme-general-color" op_name="mytheme-general-color" value="' . $color. '">';
        echo '<a href="javascript:void(0);" class="pickcolor mytheme-bkg hide-if-no-js" id="link-pick-mytheme-general-color"></a>';
        echo '<div id="color-panel-mytheme-general-color" class="color-panel" style="display: none; "></div>';
        echo '</div>';
        
        echo '<div class="clear"></div>';
        
        echo '</div>';
        
        echo '</div>';
    }
}
?>