<?php
/* Template Name: LC Blogs Home Page */

$context = Timber::get_context();

$context['sidebar'] = Timber::get_sidebar('sidebar.php');
//$context['blogs_shortcode'] = do_shortcode('[ajax_load_more post_type="blog" repeater="default" posts_per_page="5" transition="fade" button_label="Older Blogs "]'); 
Timber::render('templates/page-home.twig', $context); 