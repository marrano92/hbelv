<?php

namespace Hbelv\Cpt;

use KToolbox\MetaBox;

/**
 * Class Menus
 * @package Hbelv\Cpt
 */
class Menus extends CustomPostType implements CptInterface, MetaBoxInterface {

	/**
	 * Override the parent init method
	 *
	 * @return static
	 */
	public static function init() {
		$obj = new static();
		$obj->register_post_type();

		add_action( 'admin_menu', [ $obj, 'setup_metabox' ] );
		add_action( 'wp', [ $obj, 'populate_data_layer' ] );

		return $obj->register_hooks();
	}

	/**
	 * @return CustomPostType
	 */
	public function register_hooks(): CustomPostType {
		add_action( 'init', [ $this, 'add_promo_source_rewrite_url' ], 11 );
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
				'id'       => 'landing-editorial-meta-box',
				'title'    => 'Landing Editorial Options',
				'page'     => 'landing_editorial',
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => [
					[
						'name'    => _x( 'Vehicle type', 'Landing Page CPT admin', 'dkwp' ),
						'id'      => '_landing-editorial-vehicleType',
						'type'    => 'select',
						'std'     => '',
						'options' => [ 'auto', 'lcv' ],
						'title'   => _x( 'Vehicle type', 'Landing Page CPT admin', 'dkwp' ),
						'desc'    => _x( 'Select vehicle type', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Project ID', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-projectId',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Project ID', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert project ID', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Enable service select', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-service-select-enabled',
						'type'  => 'checkbox',
						'std'   => '',
						'title' => _x( 'Enable service select', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Enable the service switch. If toggled, you\'ll probably want to configure the appropriate service IDs below. Any service ID forced within the URL will be ignored.', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'First service name', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-first-service-name',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'First service name', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'The name of the first service.', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'First service ID', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-first-service-value',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'First service ID', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'The ID of the first service.', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Second service name', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-second-service-name',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Second service name', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'The name of the second service.', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Second service ID', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-second-service-value',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Second service ID', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'The ID of the second service.', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Lead channel', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-leadChannel',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Lead channel', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => sprintf( _x( 'Override the default lead channel for this form. Leave it blank to keep the default value. (%s)', 'Landing Page CPT admin', 'dkwp' ), apply_filters( 'dkwp/get_lead_channel', '' ) ),
					],
					[
						'name'  => _x( 'GTM code', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-gtmCode',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'GTM code', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => sprintf( _x( 'Override the default GTM code on this page. Leave it blank to keep the default value. (%s)', 'Landing Page CPT admin', 'dkwp' ), apply_filters( 'drivek_plugin_options', 'gtm_code', '' ) ),
					],
					[
						'name'  => _x( 'Vehicle Image', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-media',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Vehicle Image', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert the CDN url of the vehicle image you want to show', 'Landing Page CPT admin', 'dkwp' ),
					],
					[
						'name'    => _x( 'Make', 'Landing Page CPT admin', 'dkwp' ),
						'id'      => '_landing-editorial-maker',
						'type'    => 'select',
						'std'     => '',
						'options' => $this->get_makes_name(),
						'title'   => _x( 'Make', 'Landing Page CPT admin', 'dkwp' ),
						'desc'    => _x( 'Insert Make', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'    => _x( 'Model', 'Landing Page CPT admin', 'dkwp' ),
						'id'      => '_landing-editorial-model',
						'type'    => 'select',
						'std'     => '',
						'options' => [ __( 'Loading models...' ) ],
						'title'   => _x( 'Model', 'Landing Page CPT admin', 'dkwp' ),
						'desc'    => _x( 'Insert Model', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Submodel ID', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-submodelId',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Submodel ID', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert submodel ID', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Vehicle ID', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-vehicleId',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Vehicle ID', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert vehicle ID', 'Landing Page CPT admin', 'dkwp' ),
					],
					[
						'name'  => _x( 'Base price title', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-basePrice-title',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Base Price title', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert Base Price title', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Base price', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-basePrice',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Base Price', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert Base Price', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Discounted price title', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-promoPrice-title',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Discounted Price title', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert Discounted Price title', 'Landing Page CPT admin', 'dkwp' ),
					],
					[
						'name'  => _x( 'Discounted price', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-promoPrice',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Discounted Price', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert Discounted Price', 'Landing Page CPT admin', 'dkwp' ),
					],
					[
						'name'  => _x( 'Body', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-body',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Body', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert Body', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Doors', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-doors',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Doors', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert number of Doors', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Year', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-year',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Year', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert year', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'      => _x( 'Header Title', 'Landing Page CPT admin', 'dkwp' ),
						'id'        => '_landing-editorial-header-title',
						'type'      => 'text',
						'std'       => '',
						'title'     => _x( 'Header Title', 'Landing Page CPT admin', 'dkwp' ),
						'desc'      => _x( 'Insert Header Title', 'Landing Page CPT admin', 'dkwp' ),
						'maxlength' => '35'
					],
					[
						'name'      => _x( 'Header Subtitle', 'Landing Page CPT admin', 'dkwp' ),
						'id'        => '_landing-editorial-header-subtitle',
						'type'      => 'text',
						'std'       => '',
						'title'     => _x( 'Header Subtitle', 'Landing Page CPT admin', 'dkwp' ),
						'desc'      => _x( 'Insert Header Subtitle', 'Landing Page CPT admin', 'dkwp' ),
						'maxlength' => '255'
					],
					[
						'name'  => _x( 'Footer Copyright', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-footer-copyright',
						'type'  => 'text',
						'std'   => 'Copyright © DriveK Italia s.r.l, 2016. All Rights Reserved. Via Ludovico d\'Aragona 9, Milano - P.I. 07134830962',
						'title' => _x( 'Footer Copyright', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert Footer Copyright', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'  => _x( 'Logo Brand', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-logo-brand',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Logo Brand', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert the brand code, i.e. audi, alfa-romeo, bmw, ecc., or, if you want a custom logo, link the CDN url for it', 'Landing Page CPT admin', 'dkwp' )
					],
					[
						'name'      => _x( 'Content Title', 'Landing Page CPT admin', 'dkwp' ),
						'id'        => '_landing-editorial-content-title',
						'type'      => 'text',
						'std'       => '',
						'title'     => _x( 'Content Title', 'Landing Page CPT admin', 'dkwp' ),
						'desc'      => _x( 'Insert Content Title', 'Landing Page CPT admin', 'dkwp' ),
						'maxlength' => '75',
					],
					[
						'name'  => _x( 'Content Subtitle', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-content-subtitle',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Content Subtitle', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert Content Subtitle', 'Landing Page CPT admin', 'dkwp' ),
					],
					[
						'name'  => _x( 'Form title', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-form-title',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Form title', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert form title', 'Landing Page CPT admin', 'dkwp' ),
					],
					[
						'name'  => _x( 'Form CTA', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-form-cta',
						'type'  => 'text',
						'std'   => '',
						'title' => _x( 'Form CTA', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert form CTA', 'Landing Page CPT admin', 'dkwp' ),
					],
					[
						'name'  => _x( 'Content', 'Landing Page CPT admin', 'dkwp' ),
						'id'    => '_landing-editorial-content',
						'type'  => 'wp_editor',
						'std'   => '',
						'title' => _x( 'Content text', 'Landing Page CPT admin', 'dkwp' ),
						'desc'  => _x( 'Insert the HTML to print the landing page', 'Landing Page CPT admin', 'dkwp' )
					],
				]
			]
		];

		Metabox::create()->add_config( $config );

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