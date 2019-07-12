<?php

namespace Hbelv\Cpt;

/**
 * Class Menus
 * @package Hbelv\Cpt
 */
class Menus extends CustomPostType implements CptInterface {

	/**
	 * @return CustomPostType
	 */
	public function register_hooks(): CustomPostType {

		return $this;
	}

	/**
	 * @codeCoverageIgnore
	 *
	 * @return static
	 */
	public function register_post_type(): CptInterface {
		$labels = [
			'name'               => _x( 'Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'singular_name'      => _x( 'Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'menu_name'          => _x( 'Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'name_admin_bar'     => _x( 'Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'parent_item_colon'  => _x( 'Parent Item:', 'Menu Restaurant CPT', 'hbelv' ),
			'all_items'          => _x( 'All Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'add_new_item'       => _x( 'Add New Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'add_new'            => _x( 'Add New Menu', 'Menu Restaurant CPT', 'hbelv' ),
			'new_item'           => _x( 'New Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'edit_item'          => _x( 'Edit Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'update_item'        => _x( 'Update Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'view_item'          => _x( 'View Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'search_items'       => _x( 'Search Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'not_found'          => _x( 'Not found', 'Menu Restaurant CPT', 'hbelv' ),
			'not_found_in_trash' => _x( 'Not found in Trash', 'Menu Restaurant CPT', 'hbelv' ),
		];
		$args   = [
			'label'               => _x( 'Menu Restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'description'         => _x( 'List menus of restaurant', 'Menu Restaurant CPT', 'hbelv' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail', 'custom-fields', 'page-attributes', ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-media-text',
			'rewrite'             => [
				'slug' => 'menu'
			],
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		];
		register_post_type( 'menu_page', $args );

		return $this;
	}

}