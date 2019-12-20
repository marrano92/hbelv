<?php


namespace Hbelv\Request;

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
		return new static();
	}
}
