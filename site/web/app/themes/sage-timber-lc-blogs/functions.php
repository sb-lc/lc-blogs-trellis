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


function get_custom_excerpt( $post, $count ){

  $permalink = get_permalink( $post->ID );
  
  $content = $post->post_content;
  $content = strip_tags( $content );

  $excerpt = substr( $content, 0, $count );
  $excerpt = $excerpt . '... <a href="' . $permalink . '"><span class="read-more">read more</span></a>';

  return $excerpt;
}

/*
add_filter( 'widget_archives_args', 'changeArchivesWidgetArgs');
function changeArchivesWidgetArgs($args){
  write_log($args );
}*/




add_filter('get_twig', 'addSplitSiteTitleToTwig');

function addSplitSiteTitleToTwig($twig) {
    /* this is where you can add your own fuctions to twig */
    $twig->addFilter(new Twig_SimpleFilter('splitSiteTitleFilter', 'splitSiteTitle'));
    return $twig;
}

function splitSiteTitle( $text )
{
    $arr = explode( " ", $text );
    $new = '';
    $new .= '<span>' . $arr[0] . ' ' . $arr[1] . '</span>' . ' ' . '<span>'.$arr[2].'</span>';
    return $new;
}


function themeslug_theme_customizer( $wp_customize ) {

  $wp_customize->add_section( 'themeslug_logo_section' , array(
      'title'       => __( 'Logo', 'themeslug' ),
      'priority'    => 30,
      'description' => 'Upload a logo to replace the default site name and description in the header',
  ) );
  
  $wp_customize->add_setting( 'themeslug_logo' );

  $wp_customize->add_control( 

    new WP_Customize_Image_Control(

    $wp_customize, 'themeslug_logo', 
      array(
        'label'    => __( 'Logo', 'themeslug' ),
        'section'  => 'themeslug_logo_section',
        'settings' => 'themeslug_logo',
      ) 
    ) 
  );

}

add_action( 'customize_register', 'themeslug_theme_customizer' );



function test_debug_log_file( ) {

  write_log("qwertyuio");

}

add_action( 'init', 'test_debug_log_file' );