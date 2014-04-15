var first_run = true;
function owerflowStyle(  ){
    
    if( first_run ){
        first_run = false;
        return;
    }
            
    var color = jQuery( '#my-field-mytheme-general-color' ).val() , 
    
    cl1 = familyColor( color , -0.5 ),
    cl2 = color,
    cl3 = familyColor( color , 0.5 ),
    cl4 = familyColor( color , 0.3 ),
    cl5 = familyColor( color , 0.1 ),
    
    style =
    
    /* COLOR */
    'a,' +
    'body .mytheme-color,' +
    'body .mytheme-color-hover:hover,' +
    'body div.b.my-menu div.container div.grid_3_4 > ul li:hover > a,' +
    'body div.b.my-menu div.container div.grid_3_4 > div > ul li:hover > a,' +
    'body .mytheme-color-link-hover:hover a{' +
    'color: ' + color +';' +
    '} ' + "\n" +

    /* BACKGROUND */
    'body .mytheme-bkg,' +
    'body .mytheme-bkg-hover:hover,' +
    'body .mytheme-bkg-link-hover a:hover,' +
    'body .mytheme-bkg-icon-hover:hover .icon,' +
    'body .pagination .current,' +
    'body div.bbp-pagination-links span.page-numbers.current,' +
    'div.wpcf7 p input[type="submit"],' +
    'body div#bbpress-forums ul.bbp-forums li.bbp-header,' +
    'body div#bbpress-forums ul.bbp-forums li.bbp-footer,' +
    'body div#bbpress-forums ul.bbp-topics li.bbp-header,' +
    'body div#bbpress-forums ul.bbp-topics li.bbp-footer,' + 
    'body div#bbpress-forums ul.forums.bbp-replies li.bbp-header,' +
    'body div#bbpress-forums ul.forums.bbp-replies li.bbp-footer' + '{' +
    'background-color: ' + color +';' +
    '} ' + "\n" +

    /* BACKGROUND IMPORTANT */
    'body div.hentry ul.projects-categories li.mytheme-bkg{' +
    'background-color: ' + color + ' !important;' +
    '}' +
    /* BORDER */
    'body .mytheme-border-color,div.buddypress .activity-inner, div.hentry div#bbpress-forums .bbp-forums-list {' +
    'border-color: ' + color + ' !important;' +
    '}'  + "\n" +

    'div.b.my-menu div.container div.grid_3_4 > ul ul > li:first-child,' +
    'div.b.my-menu div.container div.grid_3_4 > div > ul ul > li:first-child{' +
        'border-top: 3px solid  ' + color + ' !important;' +
    '}' +
    
    "body .mytheme-color-button{" +
    'border:1px solid ' + cl1 + ';' +
    'background-color: ' + cl2 + ';' +

    /* For WebKit (Safari, Chrome, etc) */
    'background: ' + cl2 + ' -webkit-gradient(linear, left top, left bottom, from(' + cl3 + '), to(' + cl2 + ')) no-repeat;' +

    /* Mozilla,Firefox/Gecko */
    'background: ' + cl2 + ' -moz-linear-gradient(top, ' + cl3 + ', ' + cl2 + ') no-repeat;' +

    /* IE 5.5 - 7 */
    'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=' + cl3 + ', endColorstr=' + cl2 + ') no-repeat;' +

    /* IE 8 */
    '-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=' + cl3 + ', endColorstr=' + cl2 + ')" no-repeat;' +
    "}"  + "\n" +

    "body .mytheme-color-button span{" +
    'background-color: ' + cl2 + ';' +
    "}"  + "\n" +

    "body .mytheme-color-button span:hover{" +
    'background-color: ' + cl4 + ';' +

    /* For WebKit (Safari, Chrome, etc) */
    'background: ' + cl4 + ' -webkit-gradient(linear, left top, left bottom, from(' + cl5 + '), to(' + cl4 + ')) no-repeat;' +

    /* Mozilla,Firefox/Gecko */
    'background: ' + cl4 + ' -moz-linear-gradient(top, ' + cl5 + ', ' + cl4 + ') no-repeat;' +

    /* IE 5.5 - 7 */
    'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=' + cl5 + ', endColorstr=' + cl4 + ') no-repeat;' +

    /* IE 8 */
    '-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=' + cl5 + ', endColorstr=' + cl4 + ')" no-repeat;' +
    "}";

    jQuery( '#mytheme-color-css' ).html( style );
    jQuery.cookie( 'mytheme-color-css1' , color , {expires: 1 , path: '/'} );
}

function familyColor( hex , lum ) {
        hex = String(hex).replace(/[^0-9a-f]/gi, '');
        if (hex.length < 6) {
                hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
        }
        lum = lum || 0;
        var rgb = "#", c, i;
        for (i = 0; i < 3; i++) {
                c = parseInt(hex.substr(i*2,2), 16);
                c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                rgb += ("00"+c).substr(c.length);
        }
        return rgb;
}

jQuery(function(){
jQuery('.mytheme_demo_panel div.mytheme_demo_trigger a').toggle(function(){
    jQuery( this ).parent().parent().animate({
        "margin-left" : -3 + "px"
    });
    jQuery( this ).css( {"background-position" : "0px 0px"} );
} , function(){
    jQuery( this ).parent().parent().animate({
        "margin-left" : -150 + "px"
    });
    jQuery( this ).css( {"background-position" : "-25px 0px"} );
});
jQuery( '#my-field-mytheme-general-color').focus(function(){
    if( jQuery( this ).val().length > 2 ){
        owerflowStyle();
        jQuery('#link-pick-mytheme-general-color').css( { 'background-color' : jQuery( this ).val() } );
    }
});
jQuery( '#my-field-mytheme-general-color').focusout(function(){
    if( jQuery( this ).val().length > 2 ){
        owerflowStyle();
        jQuery('#link-pick-mytheme-general-color').css( { 'background-color' : jQuery( this ).val() } );
    }
});
jQuery( '#my-field-mytheme-general-color').keyup(function(){
    if( jQuery( this ).val().length > 2 ){
        owerflowStyle();
        jQuery('#link-pick-mytheme-general-color').css( { 'background-color' : jQuery( this ).val() } );
    }
});
});



