<?php
/**
 * Plugin Name: ACF Plugin Bundle
 * Version: 0.1
 * Description: Starter plugin for bundling ACF into a CPT.
 * Author: YOUR NAME HERE
 * Author URI: YOUR SITE HERE
 * Plugin URI: PLUGIN SITE HERE
 * Text Domain: acf-bundle
 * Domain Path: /languages
 * @package Acf-bundle
 */

# CPT INIT
function live_trader_session_init() {
	register_post_type( 'live-trader-session', array(
		'labels'            => array(
			'name'                => __( 'Live trader sessions', 'infinite-prosperity' ),
			'singular_name'       => __( 'Live trader session', 'infinite-prosperity' ),
			'all_items'           => __( 'All Live trader sessions', 'infinite-prosperity' ),
			'new_item'            => __( 'New live trader session', 'infinite-prosperity' ),
			'add_new'             => __( 'Add New', 'infinite-prosperity' ),
			'add_new_item'        => __( 'Add New live trader session', 'infinite-prosperity' ),
			'edit_item'           => __( 'Edit live trader session', 'infinite-prosperity' ),
			'view_item'           => __( 'View live trader session', 'infinite-prosperity' ),
			'search_items'        => __( 'Search live trader sessions', 'infinite-prosperity' ),
			'not_found'           => __( 'No live trader sessions found', 'infinite-prosperity' ),
			'not_found_in_trash'  => __( 'No live trader sessions found in trash', 'infinite-prosperity' ),
			'parent_item_colon'   => __( 'Parent live trader session', 'infinite-prosperity' ),
			'menu_name'           => __( 'Live trader sessions', 'infinite-prosperity' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-admin-post',
		'show_in_rest'      => true,
		'rest_base'         => 'live-trader-session',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'live_trader_session_init' );

function live_trader_session_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['live-trader-session'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Live trader session updated. <a target="_blank" href="%s">View live trader session</a>', 'infinite-prosperity'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'infinite-prosperity'),
		3 => __('Custom field deleted.', 'infinite-prosperity'),
		4 => __('Live trader session updated.', 'infinite-prosperity'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Live trader session restored to revision from %s', 'infinite-prosperity'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Live trader session published. <a href="%s">View live trader session</a>', 'infinite-prosperity'), esc_url( $permalink ) ),
		7 => __('Live trader session saved.', 'infinite-prosperity'),
		8 => sprintf( __('Live trader session submitted. <a target="_blank" href="%s">Preview live trader session</a>', 'infinite-prosperity'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Live trader session scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview live trader session</a>', 'infinite-prosperity'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Live trader session draft updated. <a target="_blank" href="%s">Preview live trader session</a>', 'infinite-prosperity'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'live_trader_session_updated_messages' );


















# ACF BUNDLE
add_filter('acf/settings/path', 'my_acf_settings_path');
 
function my_acf_settings_path( $path ) {
 
    // update path
    $path = plugin_dir_path( __FILE__ ) . '/acf/';
    
    // return
    return $path;
    
}
add_filter('acf/settings/dir', 'my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {
    $dir = plugin_dir_url( __FILE__ ) . '/acf/';
    return $dir;
}
 

# add_filter('acf/settings/show_admin', '__return_false');

$plugin_dir = array_reverse(explode("/", plugin_dir_path(__FILE__)));

include_once( plugin_dir_path(__FILE__) . '/acf/acf.php' );

# END ACF BUNDLE
