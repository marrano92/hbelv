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
		return $this;
	}
}
