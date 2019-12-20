<?php


namespace Hbelv\request;

/**
 * Class Request
 *
 * @package Hbelv\request
 */
class Request {

	/**
	 * Request constructor.
	 */
	public function __construct() {
	}

	/**
	 * @return Request
	 */
	public static function init() {
		return new self();
	}
}
