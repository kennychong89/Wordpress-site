<?php
/*
	myThem.es Theme Updater Class
	http://updates.mythem.es/
	v1.0
	
	Example Usage:
	
	include_once( 'mythemes_theme_updates.php' );

 */

if( !class_exists( 'myThemesThemeUpdates_z8o8irlh6povnd0n' ) ) {
	class myThemesThemeUpdates_z8o8irlh6povnd0n {
		var $version = '0.1';
		var $api_url = 'http://updates.mythem.es/api/1/theme/check';
		
		var $key = '';
		var $slug = '';
	
		function __construct( $theme_slug, $license = '' ) {
			$this_class = get_class( $this );
			
			$this->slug = $theme_slug;
			$this->key = substr( $this_class, strpos( $this_class, '_' ) + 1 );
			
			add_filter( 'pre_set_site_transient_update_themes', array( &$this, 'check_for_update' ) );
			
			// This is for testing only!
			//set_site_transient( 'update_themes', null );
		}
		
		function check_for_update( $trans ) {
			if( empty( $trans->checked ) ) 
				return $trans;
				
			$request_args = array(
				'slug' 		=> $this->slug,
				'key' 		=> $this->key,
				'version' 	=> $trans->checked[ $this->slug ]
			);
			
			$request_string = $this->prepare_request( $request_args );
			$raw_response = wp_remote_post( $this->api_url, $request_string );
			
			$response = null;
			if( !is_wp_error( $raw_response ) && 
				( $raw_response[ 'response' ][ 'code' ] == 200 ) )
			{
				$response = unserialize( $raw_response[ 'body' ] );
			}
			
			if( !empty( $response ) ) {
				// Feed the update data into WP updater
				$trans->response[ $this->slug ] = $response;
			}
			
			return $trans;
		}
	
		function prepare_request( $args ) {
			global $wp_version;
			
			return array( 
				'body' => array( 
					'request' => serialize( $args ),
				),
				'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url( )
			);
		}
	}
	
	new myThemesThemeUpdates_z8o8irlh6povnd0n( basename( get_template_directory( ) ) );
	
}

?>