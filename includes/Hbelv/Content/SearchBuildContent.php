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
		$posts   = $request->get_result();
		$content = new \stdClass();

		foreach ( $posts as $post ) {
			$title = $post->post_title;
			$content->$title = $post;
		}

		return $content;
	}
}
