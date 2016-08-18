<?php
$context = Timber::get_context();

$post = Timber::query_post();
$context['post'] = $post;
$context['image'] = get_the_post_thumbnail($post, 'large-blog-800-425', array( "class" => "img-responsive"));

Timber::render('templates/page.twig', $context);