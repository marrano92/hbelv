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
			'name'               => _x( 'LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'singular_name'      => _x( 'LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'menu_name'          => _x( 'LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'name_admin_bar'     => _x( 'LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'parent_item_colon'  => _x( 'Parent Item:', 'Landing Page CPT', 'dkwp' ),
			'all_items'          => _x( 'All LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'add_new_item'       => _x( 'Add New LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'add_new'            => _x( 'Add New Multimodel', 'Landing Page CPT', 'dkwp' ),
			'new_item'           => _x( 'New LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'edit_item'          => _x( 'Edit LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'update_item'        => _x( 'Update LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'view_item'          => _x( 'View LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'search_items'       => _x( 'Search LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'not_found'          => _x( 'Not found', 'Landing Page CPT', 'dkwp' ),
			'not_found_in_trash' => _x( 'Not found in Trash', 'Landing Page CPT', 'dkwp' ),
		];
		$args   = [
			'label'               => _x( 'LP Multimodel', 'Landing Page CPT', 'dkwp' ),
			'description'         => _x( 'Multimodel Landing Pages', 'Landing Page CPT', 'dkwp' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail', 'custom-fields', 'page-attributes', ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-format-aside',
			'rewrite'             => [
				'slug' => 'promo'
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