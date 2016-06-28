<?php

use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\Post\PostTypes as PostTypes;

$pt = get_query_var( 'post_type' );
if( empty( $pt ) ) $pt = get_post_type( ); 


$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


$args = array(
  'posts_per_page' => 4,
  'paged' => $paged,
  'post_type' => $pt,
);


$context = Timber::get_context( );
$posts = Timber::get_posts( $args );


require 'MedusaGeneralImageFunctions.php';
require 'MedusaArchiveImageFunctions.php';


$medusaArchiveImageFunctions = new MedusaContentSuite\Images\MedusaArchiveImageFunctions( $posts );


//$medusaImageFunctions->getImageSourceType( )


write_log( $medusaArchiveImageFunctions->getImageSourceType( ) );


$context['posts'] = $posts;
$context['pagination'] = Timber::get_pagination( );
$context['page_title'] = PostTypes::getLabelByPt( $pt );
$context[$pt] = Timber::get_posts( false, 'TimberPostMcs' );

//$context['list_image'] = new TimberImage($cover_image_id);


Timber::render( array( 'templates/archive-' . $pt . '.twig', 'templates/archive.twig' ), $context );

