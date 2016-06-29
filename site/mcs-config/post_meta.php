<?php


$config = array();




	#_cmb_blog_options_

		$prefix = '_cmb_blog_options_';
		$config[]=array(
			'id' => 'metabox_blog_options',
			'prefix' => $prefix,
			'title' => 'Blog Entry Options',
			'object_types' => array( 'blog' ), // post type
			'context' => 'normal',
			'priority' => 'low',
			'show_names' => true, // Show field names on the left
			'fields' => array(

				array(
					'name' => 'Featured Blog Entry?',
					'desc' => 'Select featured blog',
					'id' => $prefix . 'featured_blog',
					'type'    => 'select',
					'options' => array(
						'no' => __( 'No', 'cmb2' ),
						'yes'   => __( 'Yes', 'cmb2' ),
					),
				),

				array(
					'name' => 'Featured on Front Page?',
					'desc' => 'Select if blog article featured on front page',
					'id' => $prefix . 'featured_on_front',
					'type'    => 'select',
					'options' => array(
						'no' => __( 'No', 'cmb2' ),
						'yes'   => __( 'Yes', 'cmb2' ),
					),
					//'default' => 'no',
					'show_option_none' => false,
				),

				 array(
				    'name'     => 'Blog Categories',
				    'desc'     => 'Select the blog categories for this entry',
				    'id' 	   => $prefix . 'categories',
				    'taxonomy' => 'blog_category', //Enter Taxonomy Slug
				    'type'     => 'taxonomy_multicheck',
				    // Optional:
				    'options' => array(
				        'no_terms_text' => 'Sorry, no terms could be found.' // Change default text. Default: "No terms"
				    ),
				)
			)
		);








	#_cmb_user_options_

		$prefix = '_cmb_user_options_';
		$config[]=array(
			'id' => 'metabox_user_articles_options',
			'prefix' => $prefix,
			'title' => 'User Profile Metabox',
			'object_types' => array( 'user' ), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
		    'new_user_section' => 'add-new-user', 
		    // where form will show on new user page. 'add-existing-user' is only other valid option.
			'fields' => array(

				array(
				    'name'     => __( 'Extra Info', 'cmb2' ),
				    'desc'     => __( 'Extra information for each user', 'cmb2' ),
				    'id'       => $prefix . 'extra_info',
				    'type'     => 'title',
				    'on_front' => false,
				),

				array(
					'name'         => __( 'User Profile Image', 'cmb2' ),
					'desc'         => __( 'Upload or add user profile photo.', 'cmb2' ),
					'id'           => $prefix . 'user_profile_image',
					'type'         => 'file',
					'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
				),

				array(
					'name' => __( 'Role', 'cmb2' ),
					'desc' => __( 'Type users role', 'cmb2' ),
					'id' => $prefix . 'role',
					'type'    => 'text',
	
				),

				array(
					'name' => __( 'Department', 'cmb2' ),
					'desc' => __( 'Type users dept.', 'cmb2' ),
					'id' => $prefix . 'dept',
					'type'    => 'text',
	
				),

			)

		);




return $config;