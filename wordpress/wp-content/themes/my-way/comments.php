<?php


global $myLayout;

if( comments_open() ){
    
    if( is_user_logged_in() ){
        echo '<div id="comments" class="comments-list user-logged-in">';
    }
    else{
        echo '<div id="comments" class="comments-list">';
    }

    if ( post_password_required() ){
        echo '<p class="nopassword">';
        _e( 'This post is password protected. Enter the password to view any comments.' , 'myThemes' );
        echo '</p>';
        echo '</div>';
        return;
    }

    /* IF EXISTS WORDPRESS COMMENTS */
    if ( have_comments() ) {
        $nr = get_comments_number();
        
        if( $nr == 1 )
            $title = __( 'Comment' , 'myThemes' );
        else
            $title = __( 'Comments' , 'myThemes' );

        echo '<h3 class="comments-title">';
        echo $title . ' ( <strong>' . number_format_i18n( $nr ) . '</strong> )'; 
        echo '</h3>';
		
        echo '<ol>';
        wp_list_comments( array( 'callback' =>  array( 'myThemes' , 'comment' ) , 'style' => 'ul' ) );
        echo '</ol>';
        
        /* WORDPRESS PAGINATION FOR COMMENTS */
        echo paginate_comments_links();
    }
	
    /* FORM SUBMIT COMMENTS */
    $commenter = wp_get_current_commenter();

    if( esc_attr( $commenter[ 'comment_author' ] ) )
        $name = esc_attr( $commenter[ 'comment_author' ] );
    else
        $name = __( 'Name*' , 'myThemes' );

    if( esc_attr( $commenter[ 'comment_author_email' ] ) )
        $email = esc_attr( $commenter[ 'comment_author_email' ] );
    else
        $email = __( 'Email*' , 'myThemes' );

    if( esc_attr( $commenter[ 'comment_author_url' ] ) )
        $web = esc_attr( $commenter[ 'comment_author_url' ] );
    else
        $web = __( 'Website' , 'myThemes' );

    $fields =  array(
        'author' => '<div class="field">'.
                '<div class="inputs">'.
                '<p class="comment-form-author input">'.
                '<input class="required" value="' . $name . '" onfocus="if (this.value == \'' . __( 'Name*' , 'myThemes' ). '\') {this.value = \'\';}" onblur="if (this.value == \'\' ) { this.value = \'' . __( 'Name*' , 'myThemes' ). '\';}" id="author" name="author" type="text" size="30"  />' .
            '</p>',
        'email'  => '<p class="comment-form-email input">'.
                '<input class="required" value="' . $email . '" onfocus="if (this.value == \'' . __( 'Email*' , 'myThemes' ). '\') {this.value = \'\';}" onblur="if (this.value == \'\' ) { this.value = \'' . __( 'Email*' , 'myThemes' ). '\';}" id="email" name="email" type="text" size="30" />' .
            '</p>',
        'url'    => '<p class="comment-form-url input">'.
                '<input value="' . $web . '" onfocus="if (this.value == \'' . __( 'Website' , 'myThemes' ). '\') {this.value = \'\';}" onblur="if (this.value == \'\' ) { this.value = \'' . __( 'Website' , 'myThemes' ). '\';}" id="url" name="url" type="text" size="30" />' .
            '</p></div>',
    );
    
    if( is_user_logged_in() ){
        $rett  = '<p class="comment-form-comment textarea user-logged-in">';
        $rett .= '<span class="current-user">';
        $rett .= get_avatar( get_current_user_id() , 120 );
        $rett .= '</span>';
        $rett .= '<textarea id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea>';
        $rett .= '</p>';
    }else{
        $rett  = '<div class="textarea"><p class="comment-form-comment textarea user-not-logged-in">';
        $rett .= '<textarea id="comment" name="comment" cols="45" rows="10" aria-required="true"></textarea>';
        $rett .= '</p></div><div class="clearfix"></div></div>';
    }

    $args = array(	
        'title_reply' => __( "Leave a reply" , 'myThemes' ),
        'comment_notes_after'   => '',
        'comment_notes_before'  => '<p class="comment-notes">' . __( 'Your email address will not be published.' , 'myThemes' ) . '</p>',
        'logged_in_as'          => '<p class="logged-in-as">' . __( 'Logged in as' , 'myThemes' ) . ' <a href="' . home_url('/wp-admin/profile.php') . '">' . get_the_author_meta( 'nickname' , get_current_user_id() ) . '</a>. <a href="' . wp_logout_url( get_permalink( $post -> ID ) ) .'" title="' . __( 'Log out of this account' , 'myThemes' ) . '">' . __( 'Log out?' , 'myThemes' ) . ' </a></p>',		
        'fields'                => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'         => $rett,
        'label_submit'          => __( 'Submit comment' , 'myThemes' )
    );

    comment_form( $args );
    echo '<div class="clearfix"></div>';
    echo '</div>';
}
?>