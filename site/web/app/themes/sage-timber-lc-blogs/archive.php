<?php

$year = get_query_var( 'year' );
$month = get_query_var( 'monthnum' );

$author = get_query_var( 'author' );
$blog_category = get_query_var( 'blog_category' );


$context = Timber::get_context( );
if( isset( $blog_category ) ) $context['blog_category'] = $blog_category;
if( isset( $year ) ) $context['year'] = $year;
if( isset( $month ) ) $context['month'] = $month;
if( isset( $author ) ) $context['author'] = $author;

Timber::render('templates/archive.twig', $context);