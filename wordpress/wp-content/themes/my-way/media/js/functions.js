/* LOCAL COMMENTS */
jQuery(function(){
    jQuery( 'a.comment-reply-link' ).click(function(){
        var width1 = parseInt( jQuery( this ).parent().parent().width() ) - 164;
        jQuery( 'p.comment-form-comment.textarea.user-logged-in textarea' ).css( { 'width' : width1 + 'px' } );

        var width2 = parseInt( jQuery( this ).parent().parent().width() ) - 314;
        jQuery( 'p.comment-form-comment.textarea.user-not-logged-in textarea' ).css( { 'width' : width2 + 'px' } );
    });

    jQuery( '#cancel-comment-reply-link' ).click(function(){
        var width1 = parseInt( jQuery( 'div#comments' ).width() ) - 164;
        jQuery( 'p.comment-form-comment.textarea.user-logged-in textarea' ).css( { 'width' : width1 + 'px' } );

        var width2 = parseInt( jQuery( 'div#comments' ).width() ) - 314;
        jQuery( 'p.comment-form-comment.textarea.user-not-logged-in textarea' ).css( { 'width' : width2 + 'px' } );
    });

    jQuery(document).ready(function(){
        var width1 = parseInt( jQuery( 'p.comment-form-comment.textarea.user-logged-in' ).width() ) - 164;
        jQuery( 'p.comment-form-comment.textarea.user-logged-in textarea' ).css( { 'width' : width1 + 'px' } );

        var width2 = parseInt( jQuery( 'p.comment-form-comment.textarea.user-not-logged-in' ).parent().parent().width() ) - 314;
        jQuery( 'p.comment-form-comment.textarea.user-not-logged-in textarea' ).css( { 'width' : width2 + 'px' } );
    });
});

jQuery(function(){
    jQuery('div.hentry div.post-thumbnail').hover(function(){
        var h = jQuery( 'img' , this ).height();
        var w = jQuery( 'img' , this ).width();

        if( jQuery( 'div.zoom' , this ).length ){
            jQuery( 'div.zoom' , this ).css({ 'height' : h + "px" , 'width' : w + "px" });
        }
    },function(){
        if( jQuery( 'div.zoom' , this ).length ){
            jQuery( 'div.zoom' , this ).css({ 'height' : "0px" , 'width' : "0px" });
        }
    });
});
        
function get_projects( selector ){
    jQuery(document).ready(function(){
        jQuery('ul.projects-categories li').removeClass('mytheme-bkg');
        jQuery('ul.projects-categories li.' + selector ).addClass('mytheme-bkg');
        
        jQuery( 'div.mytheme_sc_post.thumbnail' ).each(function(){
            var w;
            if( !jQuery( this ).hasClass( selector ) && selector != 'all' ){
                w = jQuery( this ).width() - 20;
                var hw = 25;
                jQuery( this ).fadeTo( 500 , 0.3 );
                jQuery( 'img' , this ).animate({
                    'width' : ( w - 50 ) + 'px',
                    'height' : ( w - 50 ) + 'px'
                });
                
                jQuery( 'div.post-thumbnail' , this ).animate({
                    'margin-top' :  hw + 'px',
                    'margin-left' :  hw + 'px'
                })
                
                jQuery( 'div.text-content' , this ).hide();
            }else{
                w = jQuery( this ).width() - 20;
                jQuery( this ).fadeTo( 500 , 1 );
                jQuery( 'img' , this ).animate({
                    'width' : w + 'px',
                    'height' : w + 'px'
                });
                jQuery( 'div.post-thumbnail' , this ).animate({
                    'margin-top' : '0px',
                    'margin-left' : '0px'
                });
                
                jQuery( 'div.text-content' , this ).show();
            }
        });
    });
}


jQuery(function( ){
    jQuery( "div.my-custom-icon" ).each(function(){
        if( jQuery( this ).attr("ref").length > 0 ){
            jQuery( 'span.mytheme-bkg' , this ).css( { 'background-image' : "url(" + jQuery( this ).attr("ref") + ")" } );
        }
    });
    
    function my_menu( selector  ){
        
        jQuery( selector ).hover(function(){
            jQuery( this ).children('ul').show();
            jQuery( this ).children('ul').children('li').each(function( i ){
                var self = this;
                jQuery( self ).show( 400 );
            });
        },function(){
            jQuery( this ).children('ul').hide();
            jQuery( this ).children('ul').children('li').hide();
        });
    }
    
    my_menu( ".my-menu-list li" );
});
