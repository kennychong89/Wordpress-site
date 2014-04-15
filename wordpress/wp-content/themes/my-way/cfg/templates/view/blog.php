<?php
    global $template;
    $catID = get_query_var( 'cat' );
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(  'blog-view' ); ?>>
    
    <!-- POST TITLE -->
    <h2 class="title">
        <a class="mytheme-color-hover mytheme-dark" href="<?php the_permalink( ); ?>" >
            <?php the_title(); ?>
        </a>
    </h2>
    
    <!-- TOP META -->
    <?php get_template_part( 'cfg/templates/post/top-meta' ); ?>
    
    <!-- THUMBNAIL -->
    <?php thumbnail::blogView( $template , $post , $catID ); ?>
    
    <!-- EXCERPT -->
    
    <?php the_content( __( 'Read More' , 'myThemes' ) . ' &rarr;' ); ?>
    
</div>