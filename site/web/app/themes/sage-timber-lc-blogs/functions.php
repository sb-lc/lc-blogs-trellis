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




function get_custom_excerpt( $post, $count ){

  $permalink = get_permalink( $post->ID );
  
  $content = $post->post_content;
  $content = strip_tags( $content );

  $excerpt = substr( $content, 0, $count );
  $excerpt = $excerpt . '... <a href="' . $permalink . '"><span class="btn read-more">read more</span></a>';

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
      'title'       => __( 'Logos', 'themeslug' ),
      'priority'    => 30,
      'description' => 'Upload a logo to replace the default site name and description in the header',
  ) );
  
  $wp_customize->add_setting( 'themeslug_logo' );
  $wp_customize->add_setting( 'themeslug_logo2' );

  $wp_customize->add_control( 

    new WP_Customize_Image_Control(

      $wp_customize, 'themeslug_logo', 
      array(
        'label'    => __( 'Header Logo', 'themeslug' ),
        'section'  => 'themeslug_logo_section',
        'settings' => 'themeslug_logo',
      ) 
    ) 

  );

  $wp_customize->add_control( 

    new WP_Customize_Image_Control(

      $wp_customize, 'themeslug_logo2', 
      array(
        'label'    => __( 'Footer Logo', 'themeslug' ),
        'section'  => 'themeslug_logo_section',
        'settings' => 'themeslug_logo2',
      ) 
    ) 
    
  );


}

add_action( 'customize_register', 'themeslug_theme_customizer' );



function test_debug_log_file( ) {

  #write_log("qwertyuio");

}

add_action( 'init', 'test_debug_log_file' );






function wp_get_archives_array( $archive_str ){

  $archi = explode( '</li>' , $archive_str );
  $links = array();

  foreach( $archi as $link ) {
    $link = str_replace( array( '<li>' , "\n" , "\t" , "\s" ), '' , $link );
    if( '' != $link )
      $links[] = $link;
    else
      continue;
  }

  return $links;

}








function wp_get_monthly_archives_array( $args = '' ) {
  global $wpdb, $wp_locale;

  $defaults = array(
    'type' => 'monthly', 'limit' => '',
    'format' => 'html', 'before' => '',
    'after' => '', 'show_post_count' => false,
    'echo' => 1, 'order' => 'DESC',
    'post_type' => 'post'
  );

  $r = wp_parse_args( $args, $defaults );

  $post_type_object = get_post_type_object( $r['post_type'] );
  if ( ! is_post_type_viewable( $post_type_object ) ) {
    return;
  }
  $r['post_type'] = $post_type_object->name;

  if ( '' == $r['type'] ) {
    $r['type'] = 'monthly';
  }

  if ( ! empty( $r['limit'] ) ) {
    $r['limit'] = absint( $r['limit'] );
    $r['limit'] = ' LIMIT ' . $r['limit'];
  }

  $order = strtoupper( $r['order'] );
  if ( $order !== 'ASC' ) {
    $order = 'DESC';
  }

  // this is what will separate dates on weekly archive links
  $archive_week_separator = '&#8211;';

  $sql_where = $wpdb->prepare( "WHERE post_type = %s AND post_status = 'publish'", $r['post_type'] );

  /**
   * Filter the SQL WHERE clause for retrieving archives.
   *
   * @since 2.2.0
   *
   * @param string $sql_where Portion of SQL query containing the WHERE clause.
   * @param array  $r         An array of default arguments.
   */
  $where = apply_filters( 'getarchives_where', $sql_where, $r );

  /**
   * Filter the SQL JOIN clause for retrieving archives.
   *
   * @since 2.2.0
   *
   * @param string $sql_join Portion of SQL query containing JOIN clause.
   * @param array  $r        An array of default arguments.
   */
  $join = apply_filters( 'getarchives_join', '', $r );

  $output = '';

  $last_changed = wp_cache_get( 'last_changed', 'posts' );
  if ( ! $last_changed ) {
    $last_changed = microtime();
    wp_cache_set( 'last_changed', $last_changed, 'posts' );
  }

  $limit = $r['limit'];

  if ( 'monthly' == $r['type'] ) {
    $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date $order $limit";
    $key = md5( $query );
    $key = "wp_get_archives:$key:$last_changed";
    if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
      $results = $wpdb->get_results( $query );
      wp_cache_set( $key, $results, 'posts' );
    }
    if ( $results ) {
      $after = $r['after'];
      foreach ( (array) $results as $result ) {
        $url = get_month_link( $result->year, $result->month );
        if ( 'post' !== $r['post_type'] ) {
          $url = add_query_arg( 'post_type', $r['post_type'], $url );
        }
        /* translators: 1: month name, 2: 4-digit year */
        $text = sprintf( __( '%1$s %2$d' ), $wp_locale->get_month( $result->month ), $result->year );
        if ( $r['show_post_count'] ) {
          $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
        }



        $output[] = array( 'link' => $url, 'text' => $text, 'before' => $r['before'], 'after' => $r['after'] );
        //$output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
      }
    }
  } 


  if ( $r['echo'] ) {
    echo $output;
  } else {
    return $output;
  }


}



