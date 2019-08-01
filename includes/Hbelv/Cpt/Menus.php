<?php

namespace Hbelv\Cpt;

use \Hbelv\MetaBox;

/**
 * Class Menus
 * @package Hbelv\Cpt
 */
class Menus extends CustomPostType implements CptInterface, MetaBoxInterface {

	/**
	 * @var string
	 */
	protected $post_type = 'menu_page';

	/**
	 * @return CustomPostType
	 */
	public function register_hooks(): CustomPostType {
		add_filter( 'query_vars', [ $this, 'query_vars' ] );

		return $this;
	}

	/**
	 * @return static
	 *
	 * @codeCoverageIgnore
	 */
	public function setup_metabox(): MetaBoxInterface {
		$config = [
			$this->post_type => [
				'id'       => 'menu-meta-box',
				'title'    => 'Menu Restaurant Options',
				'page'     => 'menu_page',
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => [
					[
						'name'  => __( 'Menu Restaurant subtitle', 'hbelv' ),
						'id'    => '_menu-subtitle',
						'type'  => 'textarea',
						'std'   => '',
						'title' => __( 'Menu Restaurant subtitle', 'hbelv' ),
						'desc'  => __( 'Insert the subtitle', 'hbelv' )
					],
					[
						'name'  => __( 'Menu Restaurant CTA', 'hbelv' ),
						'id'    => '_menu-cta',
						'type'  => 'textarea',
						'std'   => '',
						'title' => __( 'Menu Restaurant CTA', 'hbelv' ),
						'desc'  => __( 'Insert the CTA to show in the sidebar', 'hbelv' )
					],
					[
						'name'  => __( 'Menu Restaurant bottom text', 'hbelv' ),
						'id'    => '_menu-bottomtext',
						'type'  => 'wp_editor',
						'std'   => '',
						'title' => __( 'Menu Restaurant bottom text', 'hbelv' ),
						'desc'  => __( 'Insert the bottom text', 'hbelv' )
					],
					[
						'name'  => __( 'Shortcode Menu Restaurant', 'hbelv' ),
						'id'    => '_menu-shortcode',
						'type'  => 'textarea',
						'std'   => '',
						'title' => __( 'Shortcode Menu Restaurant', 'hbelv' ),
						'desc'  => __( 'Insert [dklandingsearch] shortcode. Example [dklandingsearch id="323,566,713,565,1279,148,688,1257,1204,1276" ] [dklandingsearch num=6 query="makeName=Audi"]', 'hbelv' )
					],
					[
						'name'  => __( 'Project ID', 'hbelv' ),
						'id'    => '_menu-projectId',
						'type'  => 'text',
						'std'   => '',
						'title' => __( 'Project ID', 'hbelv' ),
						'desc'  => __( 'Insert project ID', 'hbelv' )
					],
					[
						'name'  => __( 'Form CTA', 'hbelv' ),
						'id'    => '_menu-formcta',
						'type'  => 'text',
						'std'   => __( 'Request a quote', 'drivek' ),
						'title' => __( 'Form CTA', 'hbelv' ),
						'desc'  => __( 'Insert the CTA for the form', 'hbelv' )
					],
					[
						'name'  => __( 'Service Field Value', 'hbelv' ),
						'id'    => '_menu-servicevalue',
						'type'  => 'text',
						'std'   => '',
						'title' => __( 'Service Field Value', 'hbelv' ),
						'desc'  => __( 'Insert the value for the hidden field "service"', 'hbelv' )
					],
				]
			]
		];

		MetaBox::create()->add_config($config);

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