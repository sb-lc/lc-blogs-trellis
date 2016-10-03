<?php
    global $post;


    $posts2 = ( array ) $post;
    $posts2['link'] = get_permalink( $post->ID );
    
    $posts2['post_image'] = get_the_post_thumbnail( $post, 'large-blog-800-425', array( "class" => "thumb img-responsive") );
    
    $terms = get_the_terms( $post, 'blog_category' );
    
    $y = 0;
    if( ! empty( $terms ) ) :
        foreach( $terms as $t ) :
            $posts2['terms'][$y]['term_link'] = get_term_link( $t );
            $posts2['terms'][$y]['term_name'] = $t->name;
            $y++;
        endforeach;
    endif;
    
    $user_link = get_author_posts_url(
        $post->post_author,
        get_the_author_meta( 'user_nicename' )
    );
    
    $posts2['user_link'] = $user_link;
    
    $user_img_id = get_the_author_meta( '_cmb_user_options_user_profile_image_id', $post->post_author );
    
    $user_img = wp_get_attachment_image(
        $user_img_id,
        'thumbnail',
        '',
        array( "class" => "contributor" )
    );
    
    $posts2['user_img'] = $user_img;
    $posts2['user_name'] = get_the_author_meta( 'user_nicename', $post->post_author );
    $posts2['post_date_formatted'] = get_the_time( 'd-m-y', $post->ID );
    $posts2['post_excerpt'] = get_custom_excerpt( $post, 400 );

    return $posts2;

	//Timber::render('templates/partials/post-summary.twig', $context);