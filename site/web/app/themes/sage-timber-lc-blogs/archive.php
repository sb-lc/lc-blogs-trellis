<?php
$count_number = get_option('posts_per_page' );
$year = get_query_var( 'year' );
$month = get_query_var( 'monthnum' );
$yearmonth = get_query_var( 'm' );
$blog_category = get_query_var( 'blog_category' );

$context = Timber::get_context( );
$date_args = array();

if( isset( $blog_category ) ) $context['blog_category'] = $blog_category;
if( isset( $year ) ) $context['year'] = $year;
if( isset( $month ) ) $context['month'] = $month;

$tax_query = false;

if( $blog_category ) :
	$tax_query = 
		array( 
			array( 
				'taxonomy' => 'blog_category',
				'field'    => 'slug',
				'terms'    => $blog_category	
			) 
		);
endif;

$args = array(
	'posts_per_page' => $count_number, 
	'post_type' => 'blog',
	'm' => get_query_var( 'm' ),
	'tax_query' => $tax_query
);

#print_html_r( $args );

$posts = query_posts( $args );

#echo count( $posts );

$x = 0;
$posts2 = array( );

foreach( $posts as $post ) :

	$posts2[$x] = ( array ) $post;
	$posts2[$x]['link'] = $post->guid;

	$posts2[$x]['post_image'] = get_the_post_thumbnail( $post, 'large-blog-800-425', array( "class" => "thumb img-responsive") );

	$terms = get_the_terms( $post, 'blog_category' );
	
	$y = 0;
	if( ! empty( $terms ) ) :
		foreach( $terms as $t ) :
			$posts2[$x]['terms'][$y]['term_link'] = get_term_link( $t );
			$posts2[$x]['terms'][$y]['term_name'] = $t->name;
			$y++;
		endforeach;
	endif;

	$user_link = get_author_posts_url( 
		$post->post_author, 
		get_the_author_meta( 'user_nicename' ) 
	); 
	
	$posts2[$x]['user_link'] = $user_link;

	$user_img_id = get_the_author_meta( '_cmb_user_options_user_profile_image_id', $post->post_author );
	$user_img = wp_get_attachment_image(
		$user_img_id,
		'thumbnail', 
		'',
		array( "class" => "contributor" ) 
	);

	$posts2[$x]['user_img'] = $user_img;
	$posts2[$x]['user_name'] = get_the_author_meta( 'user_nicename', $post->post_author );
	$posts2[$x]['post_date_formatted'] = get_the_time( 'd-m-y', $post->ID );
	$posts2[$x]['post_excerpt'] = get_custom_excerpt( $post, 800 );

	$x++;

endforeach;

$context['posts'] = $posts2;
Timber::render('templates/archive.twig', $context);