<?php


namespace Hbelv\Cpt;


use Hbelv\MetaBox;

class Rooms extends CustomPostType implements CptInterface, MetaBoxInterface {

	/**
	 * @var string
	 */
	protected $post_type = 'rooms';

	/**
	 * @return CptInterface
	 */
	public function register_post_type(): CptInterface {
		$labels = [
			'name'               => _x( 'Rooms', 'Room CPT', 'hbelv' ),
			'singular_name'      => _x( 'Room', 'Room CPT', 'hbelv' ),
			'menu_name'          => _x( 'Rooms', 'Room CPT', 'hbelv' ),
			'name_admin_bar'     => _x( 'Room', 'Room CPT', 'hbelv' ),
			'parent_item_colon'  => _x( 'Parent Item:', 'Room CPT', 'hbelv' ),
			'all_items'          => _x( 'All Room', 'Room CPT', 'hbelv' ),
			'add_new_item'       => _x( 'Add New Room', 'Room CPT', 'hbelv' ),
			'add_new'            => _x( 'Add New Room', 'Room CPT', 'hbelv' ),
			'new_item'           => _x( 'New Room', 'Room CPT', 'hbelv' ),
			'edit_item'          => _x( 'Edit Room', 'Room CPT', 'hbelv' ),
			'update_item'        => _x( 'Update Room', 'Room CPT', 'hbelv' ),
			'view_item'          => _x( 'View Room', 'Room CPT', 'hbelv' ),
			'search_items'       => _x( 'Search Room', 'Room CPT', 'hbelv' ),
			'not_found'          => _x( 'Not found', 'Room CPT', 'hbelv' ),
			'not_found_in_trash' => _x( 'Not found in Trash', 'Room CPT', 'hbelv' ),
		];
		$args   = [
			'label'               => _x( 'Room', 'Room CPT', 'hbelv' ),
			'description'         => _x( 'List menus of restaurant', 'Room CPT', 'hbelv' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail', 'custom-fields', 'page-attributes', ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-admin-network',
			'rewrite'             => [
				'slug' => 'rooms'
			],
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		];
		register_post_type( 'rooms', $args );

		$labels = array(
			'name'              => _x( 'Types Rooms', 'taxonomy general name', 'textdomain' ),
			'singular_name'     => _x( 'Type Room', 'taxonomy singular name', 'textdomain' ),
			'search_items'      => __( 'Search Type Room', 'textdomain' ),
			'all_items'         => __( 'All Types Rooms', 'textdomain' ),
			'parent_item'       => __( 'Parent Type Room', 'textdomain' ),
			'parent_item_colon' => __( 'Parent Type Room:', 'textdomain' ),
			'edit_item'         => __( 'Edit Type Room', 'textdomain' ),
			'update_item'       => __( 'Update Type Room', 'textdomain' ),
			'add_new_item'      => __( 'Add New Type Room', 'textdomain' ),
			'new_item_name'     => __( 'New Type Room Name', 'textdomain' ),
			'menu_name'         => __( 'Types Rooms', 'textdomain' ),
		);
		$args   = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'categories-rooms' ),
		);
		register_taxonomy( 'categories-rooms', 'rooms', $args );

		return $this;
	}

	/**
	 * @return MetaBoxInterface
	 */
	public function setup_metabox(): MetaBoxInterface {
		$config = [
			$this->post_type => [
				'id'       => 'rooms-meta-box',
				'title'    => 'Room menu Options',
				'page'     => 'rooms',
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => [
					[
						'name'  => __( 'Rooms name', 'hbelv' ),
						'id'    => '_room-name',
						'type'  => 'text',
						'std'   => '',
						'title' => __( 'Room name', 'hbelv' ),
						'desc'  => __( 'Insert the name of dish', 'hbelv' )
					],
					[
						'name'  => __( 'Room guest', 'hbelv' ),
						'id'    => '_room-guest',
						'type'  => 'number',
						'std'   => '',
						'title' => __( 'Room guest', 'hbelv' ),
						'desc'  => __( 'Insert the number of guest for this room', 'hbelv' )
					],
					[
						'name'  => __( 'Bed number', 'hbelv' ),
						'id'    => '_room-bed',
						'type'  => 'number',
						'std'   => '',
						'title' => __( 'Room bed', 'hbelv' ),
						'desc'  => __( 'Insert the number of bed for this room', 'hbelv' )
					],
					[
						'name'  => __( 'Room size', 'hbelv' ),
						'id'    => '_room-size',
						'type'  => 'number',
						'std'   => '',
						'title' => __( 'Room size', 'hbelv' ),
						'desc'  => __( 'Insert size of room', 'hbelv' )
					],
					[
						'name'  => __( 'Price Low Season', 'hbelv' ),
						'id'    => '_room-price-low',
						'type'  => 'currency',
						'std'   => '',
						'title' => __( 'Price Low Season', 'hbelv' ),
						'desc'  => __( 'Insert price of room in low season', 'hbelv' )
					],
					[
						'name'  => __( 'Price peak season', 'hbelv' ),
						'id'    => '_room-price-peak',
						'type'  => 'currency',
						'std'   => '',
						'title' => __( 'Price peak season', 'hbelv' ),
						'desc'  => __( 'Insert price of room in peak season', 'hbelv' )
					],
					[
						'name'  => __( 'Price high season', 'hbelv' ),
						'id'    => '_room-price-high',
						'type'  => 'currency',
						'std'   => '',
						'title' => __( 'Price high season', 'hbelv' ),
						'desc'  => __( 'Insert price of room in high season', 'hbelv' )
					],
					[
						'name'  => __( 'Room description', 'hbelv' ),
						'id'    => '_room-description',
						'type'  => 'wp_editor',
						'std'   => '',
						'title' => __( 'Room description', 'hbelv' ),
						'desc'  => __( 'Add rooms description', 'hbelv' )
					]
				]
			]
		];

		MetaBox::create()->add_config( $config );

		return $this;
	}
}
