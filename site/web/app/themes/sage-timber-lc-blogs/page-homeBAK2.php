<?php

/* Template Name: LC Blogs Home Page */

$context = Timber::get_context( );
//$count_number = get_option('posts_per_page' );
$count_number = 5;

$args = array( 
	'posts_per_page' => $count_number,
    'post_type' => 'blog',
    //'page_id' => 194,
);

$posts = query_posts( $args );

$x = 0;
$posts_array = array( );

foreach( $posts as $post ) :
    $posts_array[] = require('post-summary.php');
	$x++;
endforeach;

/*echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
print_r($posts_array);
echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
*/

//print_r($posts2[0]['post_excerpt']);

$context['posts'] = $posts_array;

Timber::render('templates/page-home.twig', $context); 