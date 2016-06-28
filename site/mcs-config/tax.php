<?php

$config = array();
		
//TX - Blog Category
	$labels=array(
		'name' => _x( 'Blog Category', 'taxonomy general name' ),
		'singular_name' => _x( 'Blog Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Blog Categories' ),
		'all_items' => __( 'All Blog Categories' ),
		'parent_item' => __( 'Parent Location' ),
		'parent_item_colon' => __( 'Parent Blog Category:' ),
		'edit_item' => __( 'Edit Blog Category' ),
		'update_item' => __( 'Update Blog Category' ),
		'add_new_item' => __( 'Add New Blog Category' ),
		'new_item_name' => __( 'New Blog Category' ),
		'menu_name' => __( 'Blog Category' ),
	);
	// Control the slugs used for this taxonomy
	$args = array(
		'labels' => $labels,
		'slug' => 'blog-category', // This controls the base slug that will display before each term
		'with_front' => false, // Don't display the category base before "/locations/"
		'hierarchical' => false, // This will allow URL's like "/locations/boston/cambridge/"
		'show_ui' => true,
		'capabilities' => array(
			'manage_terms' => 'delete_others_posts',
			'edit_terms' => 'delete_others_posts',
			'delete_terms' => 'delete_others_posts',
			'assign_terms' => 'delete_others_posts'
		),
	);

	$tax = 'blog_category';

	$pt = array ( 
		array (
			'id' => 'blog', 
			'show_tax_meta' => true 
		)
	);

	$config[] = array ( 'args' => $args, 'pt' => $pt, 'tax' => $tax );

	return $config;#DO NOT DELETE

