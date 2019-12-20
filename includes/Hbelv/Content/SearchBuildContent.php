<?php

namespace Hbelv\Content;

use Hbelv\Request\Request;

class SearchBuildContent extends BuildContent implements BuilderContentInterface {

	/**
	 *
	 * @param Request $request
	 *
	 * @return \stdClass
	 */
	public function build_content( Request $request ): \stdClass {
		return (object) ['var1' => 'result'];
	}
}
