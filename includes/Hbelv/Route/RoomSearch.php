<?php

namespace Hbelv\Route;

use Hbelv\Content\SearchBuildContent;
use Hbelv\Factories\Request\RequestFactory;
use Hbelv\Proxy;
use Hbelv\request\SearchRequest;
use Hbelv\Template;
use Hbelv\Route;

class RoomSearch extends Route {

	/**
	 * Protected class var
	 *
	 * @var string $_template
	 */
	protected
		$_template = 'parts/search.php';

	/**
	 * RoomSearch constructor.
	 *
	 * @param SearchRequest $request
	 * @param SearchBuildContent $content
	 * @param Proxy|null $endpoints
	 * @param array $request
	 */
	public function __construct( SearchRequest $request, SearchBuildContent $content, Proxy $endpoints = null ) {
		parent::__construct( $request, $content, $endpoints );

		$this->_slug = _x( 'RoomSearch', 'Route URI', 'dkwp' );
	}

	public function add_rewrite_rule( int $position ) {
		$rewrite = sprintf( 'index.php?hbelv_route=%s', $position );
		$uri     = apply_filters( __METHOD__, sprintf( '^%s', $this->_slug ) );

		add_rewrite_rule( $uri, $rewrite, 'top' );
	}

	/**
	 * Gets allowed AJAX object keys
	 *
	 * @return array
	 */
	public function get_ajax_keys(): array {
		$hash = [
			'cluster',
			'makeName',
			'makeAndSubModelCommercialName',
			'bodyType',
			'fuelType',
			'tag_internal_space',
			'tag_accessibility',
			'traction',
			'emissionsClass'
		];

		return apply_filters( __METHOD__, $hash );
	}

	/**
	 * Filter: wp_title
	 *
	 * @return string
	 */
	public function wp_title(): string {
		return 'title';
	}

	/**
	 * Filter: Changes the meta description here
	 *
	 * @return string
	 */
	public function wp_description(): string {
		return 'description';
	}


	/**
	 * Gets data
	 *
	 *
	 * @throws \Exception
	 */
	public function make_request() {
		static $data = null;

		if ( is_null( $data ) ) {
			$data = ( new RequestFactory( $this, $this->get_options() ) )->get_request();
		}

		return $data;
	}

	/**
	 * Filter: the_content
	 *
	 * @param string $content
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function the_content( string $content ): string {
		$data_request = $this->_request->make_request();

		$template = new Template( $this->_template );

		return $template->load_template_part( $data_request );
	}

}
