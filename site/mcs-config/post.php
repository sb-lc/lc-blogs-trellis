<?php

$config = array( );




//PT - Blog
	$prefix = '_blog_';
	$labels = array(
		'name'               => _x( 'Blog Entries', 'post type general name' ),
		'singular_name'      => _x( 'Blog Entry', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Blog' ),
		'add_new_item'       => __( 'Add New Blog Entry' ),
		'edit_item'          => __( 'Edit Blog Entry' ),
		'new_item'           => __( 'New Blog Entry' ),
		'all_items'          => __( 'All Blogs Entries' ),
		'view_item'          => __( 'View Blog Entries' ),
		'not_found'          => __( 'No blog entry found' ),
		'not_found_in_trash' => __( 'No blog entry found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Blog Entries',
	);

	$rewrite = array(
        'slug'=>'blog',
        'with_front'=> true,
        'feed'=> true,
        'pages'=> true
	);

	$columns = array(
		'config'=>array(

		),
		'fields'=>array(

		),
	);

	$args = array(
		'labels'        => $labels,
		'rewrite'        => $rewrite,
		'description'   => 'Holds our blog entries and blog entry data',
		'public'        => true,
		'menu_position' => 20,
		'supports'      => array( 'title', 'editor', 'attributes', 'thumbnail' ), //'excerpt', , 'comments', 'page-attributes'
		'has_archive'   => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'menu_icon' => 'dashicons-admin-page',
		#'capability_type' => null, #array('news', 'news'), #plural
		#'capabilities' => null,
		#'map_meta_cap' => null,
		#'register_meta_box_cb' => null,
		#'taxonomies' => null,
		#'query_var' => 'blog',
		'can_export' => true,

	);

	$types = 'blog';
	
	$extras = array(
		'sidebars'=>false,
		'list_page'=>739,
		'mu_main_site_only'=>false,
		'sub_site_only'=>false,
		'columns'=>$columns,
		'default_category_tax'=>true,
		'is_product_pt'=>false,
		'show_in_nav_menu'=>true,
		'nav_menu_position'=>1,
		'show_posts_in_nav_menu'=>true,
		'create_dummy_posts'=>false,
		'url_query_vars'=>array( 'page_id' ),
	);

	$config[] = array ( 'args' => $args, 'types' => $types, 'extras' => $extras );




//PT - Contributors
	$prefix = '_profile_';
	$labels = array(
		'name'               => _x( 'Contributors', 'post type general name' ),
		'singular_name'      => _x( 'Contributor', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Contributor' ),
		'add_new_item'       => __( 'Add Contributor' ),
		'edit_item'          => __( 'Edit Contributor' ),
		'new_item'           => __( 'New Contributor' ),
		'all_items'          => __( 'All Contributors' ),
		'view_item'          => __( 'View Contributors' ),
		'not_found'          => __( 'No profile found' ),
		'not_found_in_trash' => __( 'No profile found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Contributors',
	);

	$rewrite = array(
        'slug'=>'profile',
        'with_front'=> true,
        'feed'=> true,
        'pages'=> true
	);

	$columns = array(
		'config'=>array(
			'pt'=>'dfdfdfdfdf',
			'image_src'=>'custom',
			'image_custom_field'=>'_cmb_news_article_images',
			'image_show_multiple'=>true,
			'image_size_thumb'=>'thumb-square-80',
			'image_size_display'=>'display-width-1000',
		),
		'fields'=>array(

		),
	);

	$args = array(
		'labels'        => $labels,
		'rewrite'        => $rewrite,
		'description'   => 'Holds our contributor and contributor data',
		'public'        => true,
		'menu_position' => 20,
		'supports'      => array( 'title', 'attributes' ), //'excerpt', , 'comments', 'thumbnail', 'page-attributes'
		'has_archive'   => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'menu_icon' => 'dashicons-admin-page',
		#'capability_type' => null, #array('news', 'news'), #plural
		#'capabilities' => null,
		#'map_meta_cap' => null,
		#'register_meta_box_cb' => null,
		#'taxonomies' => null,
		'query_var' => 'contributor',
		'can_export' => true,

	);

	$types = 'contributor';
	
	$extras = array(
		'sidebars'=>false,
		'list_page'=>739,
		'mu_main_site_only'=>false,
		'sub_site_only'=>false,
		'columns'=>$columns,
		'default_category_tax'=>true,
		'is_product_pt'=>false,
		'show_in_nav_menu'=>true,
		'nav_menu_position'=>1,
		'show_posts_in_nav_menu'=>true,
		'create_dummy_posts'=>false,
		'url_query_vars'=>array( 'page_id' ),
	);

	$config[] = array ( 'args' => $args, 'types' => $types, 'extras' => $extras );







return $config;