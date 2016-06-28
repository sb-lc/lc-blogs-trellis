<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
	'lib/timber.php', 			// Twig magic
  'lib/assets.php',    	// Scripts and stylesheets
  'lib/extras.php',    	// Custom functions
  'lib/setup.php',     	// Theme setup
  'lib/titles.php',    	// Page titles
  'lib/customizer.php' // Theme customizer,
];

foreach( $sage_includes as $file ){
  if ( ! $filepath = locate_template( $file ) ){
    trigger_error( sprintf( __( 'Error locating %s for inclusion', 'sage' ), $file ), E_USER_ERROR );
  }

  require_once $filepath;
}

unset($file, $filepath);


//not working
//maybe try with thumb resize plugin

/*add_image_size( 'medium-width', 480 );
add_image_size( 'medium-height', 9999, 480 );
add_image_size( 'medium-something', 480, 480 );

function wpshout_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
      'medium-width' => __( 'Medium Width' ),
      'medium-height' => __( 'Medium Height' ),
      'medium-something' => __( 'Medium Something' ),
    ) 
  );
}

add_filter( 'image_size_names_choose', 'wpshout_custom_sizes' );*/


#siedev

require_once('functions-lc-blogs-widgets.php');

function timber_set_product( $post ) {
    global $product;
    if ( is_woocommerce() ) {
        $product = get_product($post->ID);
    }
}



add_action( 'widget_archives_args', 'custom_widget_archives_args' );
function custom_widget_archives_args( $args ){
    add_filter( 'getarchives_where', 'custom_getarchives_where' );
    return $args;
}


function custom_getarchives_where( $where ){
    remove_filter( 'getarchives_where', 'custom_getarchives_where' );
    $where = str_replace( "post_type = 'post'", "post_type in ( 'blog' )", $where );
    return $where;
}



