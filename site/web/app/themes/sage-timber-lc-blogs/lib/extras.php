<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

#siedev

add_filter('woocommerce_show_page_title', '__return_false');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);



/**
 * Add <body> classes
 */
function body_class($classes) {
    // Add page slug if it doesn't exist
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    // Add class if sidebar is active
    if (Setup\display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');



add_filter( 'timber_context',  __NAMESPACE__ . '\\add_to_context' );

function add_to_context( $data ) {

    global $post;

    // Overrides / Fixes for default WordPress functions for use in Twig templates

    #$data['header_menu'] = get_the_widget( 'Medusa_Widgets_Menu', 'menu_src=menu&menu_location=main-menu-location&classes=navbar-nav, nav&id=nav&container_classes=navbar-collapse,collapse ' );
    #$data['footer_menu'] = get_the_widget( 'Medusa_Widgets_Menu', 'menu_src=menu&menu_location=footer-menu-location' );

    #needs if post is available

    $attr = array(
        'class' => 'image img-responsive',
        'alt'   => 'Leicester College Blogs',
        'title'   => 'Leicester College Blogs',
    );


    $headerImgId = attachment_url_to_postid( get_theme_mod( 'themeslug_logo' ) );
    $footerImgId = attachment_url_to_postid( get_theme_mod( 'themeslug_logo2' ) );

    $data['site_logo'] = wp_get_attachment_image( $headerImgId, 'header', false,  $attr );
    $data['footer_logo'] = wp_get_attachment_image( $footerImgId, 'header', false,  $attr );

    return $data;

}

function remove_plugin_assets() {

    wp_dequeue_style('lc-ajax-css');
    wp_dequeue_style('formidable');
    wp_dequeue_style('frm_fonts');
    wp_dequeue_style('sb_instagram_styles');
    wp_dequeue_style('owfes-jqueryui-css');
    wp_dequeue_style('ow-fe-actions-css');
    wp_dequeue_style('owf-modal-css');
    wp_dequeue_style('owf-oasis-workflow-css');
    wp_dequeue_style('editorial-comment-style');
    wp_dequeue_style('sb_instagram_icons');


    wp_dequeue_script('formidable');
    wp_dequeue_script('owf-workflow-inbox');
    wp_dequeue_script('owf-workflow-history');
    wp_dequeue_script('owf-workflow-util');
    wp_dequeue_script('owf_submit_step');
    wp_dequeue_script('ow-editorial-comment-js');
    wp_dequeue_script('jquery-simplemodal');
    wp_dequeue_script('ow-fe-actions-js');

    //wp_dequeue_script('jquery-ui-datepicker');

    //wp_dequeue_script('lc-ajax-script');
    //wp_dequeue_script('sb_instagram_scripts');

    //problems with localize
    //how to add wp assets in to pipeline (wp-emoji.js, wp-embed.js, twemoji.js, jquery.js, jquery-migrate.js)

}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\remove_plugin_assets', 99999);
