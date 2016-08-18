<?php

	$post2 = ( array ) $post;
	$post2['link'] = $post->guid;

	$post2['post_image'] = get_the_post_thumbnail( $post, 'large-blog-800-425', array( "class" => "thumb img-responsive") );

	$terms = get_the_terms( $post, 'blog_category' );

	$y = 0;
	if( ! empty( $terms ) ) :
		foreach( $terms as $t ) :
			$post2['terms'][$y]['term_link'] = get_term_link( $t );
			$post2['terms'][$y]['term_name'] = $t->name;
			$y++;
		endforeach;
	endif;

	$user_link = get_author_posts_url( 
		$post->post_author, 
		get_the_author_meta( 'user_nicename' ) 
	); 
	
	$post2['user_link'] = $user_link;

	$user_img_id = get_the_author_meta( '_cmb_user_options_user_profile_image_id', $post->post_author );
	
	$user_img = wp_get_attachment_image(
		$user_img_id,
		'thumbnail', 
		'',
		array( "class" => "contributor" )
	);

	$post2['user_img'] = $user_img;
	$post2['user_name'] = get_the_author_meta( 'user_nicename', $post->post_author );
	$post2['post_date_formatted'] = get_the_time( 'd-m-y', $post->ID );
	$post2['post_excerpt'] = get_custom_excerpt( $post, 800 );

	$context['post'] = $post2;

	Timber::render('templates/partials/post-summary.twig', $context);