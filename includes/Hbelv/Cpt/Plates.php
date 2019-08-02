<?php


namespace Hbelv\Cpt;


use Hbelv\MetaBox;

class Plates extends CustomPostType implements CptInterface, MetaBoxInterface {

	/**
	 * @var string
	 */
	protected $post_type = 'plates_page';

	/**
	 * @return CustomPostType
	 */
	public function register_hooks(): CustomPostType {

		add_filter( 'query_vars', [ $this, 'query_vars' ] );

		return $this;
	}

	/**
	 * @return CptInterface
	 */
	public function register_post_type(): CptInterface {
		$labels = [
			'name'               => _x( 'Plates Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'singular_name'      => _x( 'Plate Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'menu_name'          => _x( 'Plate Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'name_admin_bar'     => _x( 'Plate Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'parent_item_colon'  => _x( 'Parent Item:', 'Plate Restaurant CPT', 'hbelv' ),
			'all_items'          => _x( 'All Plate Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'add_new_item'       => _x( 'Add New Plate Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'add_new'            => _x( 'Add New Plate', 'Plate Restaurant CPT', 'hbelv' ),
			'new_item'           => _x( 'New Plate Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'edit_item'          => _x( 'Edit Plate Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'update_item'        => _x( 'Update Plate Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'view_item'          => _x( 'View Plate Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'search_items'       => _x( 'Search Plate Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'not_found'          => _x( 'Not found', 'Plate Restaurant CPT', 'hbelv' ),
			'not_found_in_trash' => _x( 'Not found in Trash', 'Plate Restaurant CPT', 'hbelv' ),
		];
		$args   = [
			'label'               => _x( 'Plate Restaurant', 'Plate Restaurant CPT', 'hbelv' ),
			'description'         => _x( 'List menus of restaurant', 'Plate Restaurant CPT', 'hbelv' ),
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
			'taxonomies' => [
				'category'
			],
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		];

		register_post_type( 'plates_page', $args );

		return $this;
	}

	/**
	 * @return MetaBoxInterface
	 */
	public function setup_metabox(): MetaBoxInterface {
		$config = [
			$this->post_type => [
				'id'       => 'plates-meta-box',
				'title'    => 'Plate menu Options',
				'page'     => 'plates_page',
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => [
					[
						'name'  => __( 'Name dish', 'hbelv' ),
						'id'    => '_plate-name',
						'type'  => 'text',
						'std'   => '',
						'title' => __( 'Name dish', 'hbelv' ),
						'desc'  => __( 'Insert the name of dish', 'hbelv' )
					],
					[
						'name'  => __( 'Name dish in english', 'hbelv' ),
						'id'    => '_plate-eng-subtitle',
						'type'  => 'text',
						'std'   => '',
						'title' => __( 'Name dish in english', 'hbelv' ),
						'desc'  => __( 'Insert the name of dish in english', 'hbelv' )
					],
					[
						'name'        => __( 'Type of dish', 'hbelv' ),
						'id'          => '_plate-type',
						'type'        => 'select',
						'placeholder' => 'Select type',
						'options'     => [
							'Primi',
							'Secondi',
							'Dolci'
						],
						'std'         => '',
						'title'       => __( 'Type of dish', 'hbelv' ),
						'desc'        => __( 'Select the type of dish', 'hbelv' )
					],
					[
						'name'    => __( 'Price dish', 'hbelv' ),
						'id'      => '_plate-price',
						'type'    => 'number',
						'std'     => '',
						'title'   => __( 'Price dish', 'hbelv' ),
						'desc'    => __( 'Add price for dish', 'hbelv' )
					],
					[
						'name'  => __( 'Note', 'hbelv' ),
						'id'    => '_plate-note',
						'type'  => 'select',
						'options'     => [
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
							'Pellentesque in tellus ornare, blandit nulla eget, convallis felis.',
							'Sed egestas consectetur rutrum, Nunc et lorem varius, aliquet lectus ut.'
						],
						'std'   => '',
						'title' => __( 'Note', 'hbelv' ),
						'desc'  => __( 'Select a note to add', 'hbelv' )
					]
				]
			]
		];

		MetaBox::create()->add_config( $config );

		return $this;
	}
}