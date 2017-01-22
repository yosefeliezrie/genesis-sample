
<?php

/**
 *
 * @package Genesis\Templates
 * @author  Yosef Eliezrie
 * @license GPL-2.0+
 * @link    https://github.com/yosefeliezrie/genesis-sample
 * Template Name: Full Width Page - Beaver Builder Template
 * Based on https://sridharkatakam.com/full-width-page-template-in-genesis-for-beaver-builder/
 */


add_filter( 'body_class', 'genesis_sample_beaver_body_class' );
/**
 * Adds a css class to the body element
 *
 * @param  array $classes the current body classes
 * @return array $classes modified classes
 */
function genesis_sample_beaver_body_class( $classes ) {
	$classes[] = 'fl-builder-full';
	return $classes;
}

if ( is_front_page() ) {
	//* Remove site header elements
	remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
	remove_action( 'genesis_header', 'genesis_do_header' );
	remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
}
//* Remove navigation
remove_theme_support( 'genesis-menus' );

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove Footer widgets on application page
/*if ( is_page('test') ){
	remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
}*/

add_filter( 'genesis_attr_site-inner', 'genesis_sample_attributes_site_inner' );
/**
 * Add attributes for site-inner element.
 *
 * @since 2.0.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return array Amended attributes.
 */
function genesis_sample_attributes_site_inner( $attributes ) {
	$attributes['role']     = 'main';
	$attributes['itemprop'] = 'mainContentOfPage';
	return $attributes;
}
// Remove div.site-inner's div.wrap
add_filter( 'genesis_structural_wrap-site-inner', '__return_empty_string' );
// Display Header
get_header();
// Display Content
the_post(); // sets the 'in the loop' property to true.
the_content();
// Display Footer
get_footer();
