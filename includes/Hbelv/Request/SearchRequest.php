<?php


namespace Hbelv\Request;

/**
 * Class SearchRequest
 *
 * @package Hbelv\Request
 */
class SearchRequest extends Request implements PostRequestInterface {

	/**
	 * @inheritDoc
	 */
	public function make_request(): PostRequestInterface {
		$args = [
			'post_type' => 'rooms',
		];

		$query         = ( new \WP_Query( $args ) )->get_posts();
		$this->_result = $query;

		return $this;
	}

	public function get_result(){
		return $this->_result;
	}
}
