<?php

namespace Hbelv\Content;


use Hbelv\Request\Request;

/**
 * Interface BuilderContentInterface
 *
 * @package Hbelv\Content
 */
interface BuilderContentInterface {

	public function build_content(Request $request): \stdClass;

}
