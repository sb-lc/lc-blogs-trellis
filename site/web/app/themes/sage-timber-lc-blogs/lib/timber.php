<?php
use Roots\Sage\Setup;

use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\CMB\Meta\PostMeta as PostMeta;


/**
 * Timber
 */

class TwigSageTheme extends TimberSite {
    function __construct() {
        add_filter( 'timber_context', array( $this, 'add_to_context' ) );
        parent::__construct();
    }
    function add_to_context( $context ) {

        /* Add extra data */
        $context['foo'] = 'I am some other typical value set in your functions.php file, unrelated to the menu';

        /* Menu */
        $context['menu'] = new TimberMenu('primary_navigation');

        /* Site info */
        $context['site'] = $this;

        /* Site info */
        $context['display_sidebar'] = Setup\display_sidebar();

        $context['sidebar_primary'] = Timber::get_widgets('sidebar-primary');

        return $context;

    }
}
new TwigSageTheme();

/**
 * Timber
 *
 * Check if Timber is activated
 */

if ( ! class_exists( 'Timber' ) ) {

    add_action( 'admin_notices', function() {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
    } );
    return;

}








class TimberPostMcs extends TimberPost
{
    public function __construct( $post= null )
    {
        $pt = get_post_type( $post );

        if ( empty( $pt ) ) :
            $pt = get_query_var( 'post_type' );
        endif;

        $fieldNames = PostMeta::getMetaBoxFieldNames( $pt );
        $fieldMeta = PostMeta::getMetaValues( $fieldNames, '_cmb_' );

        if( ! empty( $fieldMeta ) ) :
            foreach( $fieldMeta as $k => $v ) :
                $post->$k = $v;
            endforeach;
            
            $post->post_meta = $fieldMeta; 
        endif;

        parent::__construct( $post );
    }
}





