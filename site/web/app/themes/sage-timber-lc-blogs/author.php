<?php

$context = Timber::get_context( );

$author = get_query_var( 'author' );

if( isset( $author ) ) $context['author'] = $author;

$context['name'] = get_the_author_meta( 'display_name', $author );
$context['bio'] = get_the_author_meta( 'description', $author );
$context['role'] = get_the_author_meta( '_cmb_user_options_role', $author );
$context['dept'] = get_the_author_meta( '_cmb_user_options_dept', $author );

$context['image'] = wp_get_attachment_image(
	get_the_author_meta( '_cmb_user_options_user_profile_image_id', $author ), 
	'thumbnail', 
	"", 
	array( 
		"class" => "img-responsive"
	) 
);

Timber::render('templates/author.twig', $context);