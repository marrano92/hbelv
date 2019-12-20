<?php


namespace Hbelv\Request;

/**
 * Class Request
 *
 * @package Hbelv\Request
 */
class Request {

	/**
	 * Protected class var
	 *
	 * @var \stdClass $_result
	 */
	protected
		$_result;

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
