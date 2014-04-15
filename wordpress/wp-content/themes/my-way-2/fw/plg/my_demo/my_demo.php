<?php

/* //////////////////////////////////////////////////////////////////////////////
 * Description of my_color :
 *
 * @author myThemes
 * /////////////////////////////////////////////////////////////////////////////
 */

function _mytheme_autoload_my_demo( $classname ) {
    my_demo::load( $classname );
}

class my_demo {

    static $first_run = true;
    static $demo = array();
    
    static function init() {
        $currDir = dirname( __FILE__ );
        $data = include $currDir . '/demo.php';
        
        foreach( $data as $k ){
            self::$demo[ "my_demo_{$k}" ] = $currDir . "/my_demo_{$k}.php";
            
        }
        
        self::run();
    }

    static function load( $classname ) {
        if ( isset( self::$demo[ $classname ] ) ) {
            include_once( self::$demo[ $classname ] );
        }
    }

    static function run( ) {
        if (self::$first_run) {
            self::$first_run = false;

            /* set autoload function */
            spl_autoload_register('_mytheme_autoload_my_demo');
        }
    }

}

my_demo::init();
?>