<?php

namespace Hbelv\Rest\V1;

use Hbelv\Rest\HbelvV1;

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
	 */
	public function search( \WP_REST_Request $request ){
		$options = options_factory();

	}
}
