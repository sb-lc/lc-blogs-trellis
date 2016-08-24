<?php
$context = Timber::get_context();

$post = Timber::query_post();
$context['post'] = $post;
$context['author'] = get_the_author();
$context['image'] = get_the_post_thumbnail($post, 'large-blog-800-425', array( "class" => "img-responsive"));


$user_link = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); 

$user_img = wp_get_attachment_image(

get_the_author_meta('_cmb_user_options_user_profile_image_id'), 'thumbnail', "", array( "class" => "contributor") );


$terms = get_the_terms( $post, 'blog_category');

if( ! empty( $terms ) ) :
	$x = 0;
	foreach( $terms as $c ):
		$cats[$x] = (array) $c;
		$cats[$x]['link'] = get_term_link( $c );
		$x++;
	endforeach;
	$context['terms'] = $cats;
endif;



$context['user_img'] = $user_img;
$context['user_link'] = $user_link;
$context['date'] = get_the_date('d-m-y');

Timber::render( array( 'templates/single-' . $post->ID . '.twig', 'templates/single-' . $post->post_type . '.twig', 'templates/single.twig' ), $context );

