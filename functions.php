<?php

// Include main-menu navigation Walker
require get_parent_theme_file_path ( '/includes/main-menu.php' );

/**
 * Register Mega Menu Post Type
 */
function grada_register_mega_menus() {

	$labels = array(
		'name'               => esc_html_x( 'Mega Menus', 'Post Type General Name', 'molino' ),
		'singular_name'      => esc_html_x( 'Mega Menu', 'Post Type Singular Name', 'molino' ),
		'menu_name'          => esc_html__( 'Mega Menu', 'molino' ),
		'name_admin_bar'     => esc_html__( 'Mega Menu', 'molino' ),
		'parent_item_colon'  => esc_html__( 'Parent Menu:', 'molino' ),
		'all_items'          => esc_html__( 'All Menus', 'molino' ),
		'add_new_item'       => esc_html__( 'Add New Menu', 'molino' ),
		'add_new'            => esc_html__( 'Add New', 'molino' ),
		'new_item'           => esc_html__( 'New Menu', 'molino' ),
		'edit_item'          => esc_html__( 'Edit Menu', 'molino' ),
		'update_item'        => esc_html__( 'Update Menu', 'molino' ),
		'view_item'          => esc_html__( 'View Menu', 'molino' ),
		'search_items'       => esc_html__( 'Search Menu', 'molino' ),
		'not_found'          => esc_html__( 'Not found', 'molino' ),
		'not_found_in_trash' => esc_html__( 'Not found in Trash', 'molino' ),
	);

	$args = array(
		'label'               => esc_html__( 'Mega Menus', 'molino' ),
		'description'         => esc_html__( 'GradaStudio Mega Menu', 'molino' ),
		'labels'              => $labels,
		'supports'            => array(
			'title',
			'editor',
			'revisions',
		),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-list-view',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => false,
		'capability_type'     => 'page',
	);

	register_post_type( 'grada_mega_menu', $args );
}
