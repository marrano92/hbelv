<?php

namespace Hbelv\Result;


/**
 * Interface ApiResultInterface
 *
 * @package Dkwp\Result
 *
 */
interface ApiResultInterface {

	/**
	 * Does the request
	 *
	 * @return ApiResultInterface
	 */
	public function make_request(): ApiResultInterface;

	/**
	 * Prepares the content object
	 *
	 * @return \stdClass
	 */
	public function build_content(): \stdClass;

}