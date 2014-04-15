var shcode = '';
function tiny_plugin( ) {
    tools.popBox2( '#my-shcode-box' );
}

function insert( sc ){
    if( sc == 'button' )
        shcode = "[button color='" + params( sc , '.my-sc-button-color' ) + 
        "' background='" + params( sc , 'div.input .my-sc-button-background' ) + 
        "' size='" + params( sc , '#my-sc-button-size' ) + 
        "' src='" + params( sc , '#my-sc-button-src' ) + 
        "' icon='" + params( sc , '#my-sc-button-icon' ) + "']" +
        params( sc , '#my-sc-button-content' ) + "[/button]";
    
    return shcode;
}
 
function params( sc , param ){
    var result;
    jQuery(function(){
        var obj = jQuery( 'div.my-sc-' + sc + '-settings' );
        result = jQuery( param , obj ).val();
    });
    
    return result;
}

(function() {
    tinymce.create( 'tinymce.plugins.tinyplugin' , {
        init : function( ed, url ){
            ed.addButton( 'tinyplugin', {
            title : 'myThemes Shortcodes',
                onclick : function() {
                    ed.execCommand( 'mceInsertContent' , false, tiny_plugin() );
                },
                image: url + "/../images/shcode.png"
            });
        }
    });
 
    tinymce.PluginManager.add( 'tinyplugin' , tinymce.plugins.tinyplugin );
 
})();