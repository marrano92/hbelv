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
		static $obj = null;

		if ( empty( $obj ) ) {
			$obj  = new static();

			$args = [
				'post_type' => 'rooms',
			];

			$rooms = ( new \WP_Query( $args ) )->get_posts();

			foreach ( $rooms as $room ) {
				$meta       = get_post_meta( $room->ID );
				$room->meta = $meta;
			}

			$obj->set_rooms( $rooms );
		}

		return $obj;
	}

	public function get_result() {
		return $this->_result;
	}
}
