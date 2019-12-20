<?php

namespace Hbelv\Rest\V1;

use Hbelv\Content\SearchBuildContent;
use Hbelv\Proxy;
use Hbelv\request\SearchRequest;
use Hbelv\Rest\HbelvV1;
use Hbelv\Route\RoomSearch;

class Search extends HbelvV1 {

	/**
	 * @inheritDoc
	 */
	public function rest_api_init() {
		register_rest_route(
			$this->get_namespace(),
			'/search', [
				'methods'  => \WP_REST_Server::READABLE,
				'callback' => [ $this, 'search' ],
			]
		);
	}

	/**
	 * Search Endpoint
	 *
	 * @param \WP_REST_Request $request
	 *
	 * @return mixed|\WP_REST_Response
	 */
	public function search( \WP_REST_Request $request ){
		$options = options_factory();
		$proxy   = new Proxy( $options );

		$route = RoomSearch::init(SearchRequest::init(), SearchBuildContent::init(), $proxy);

		return rest_ensure_response( $route->get_rest_result() );
	}
}
