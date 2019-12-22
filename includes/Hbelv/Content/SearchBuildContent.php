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
		$rooms   = $request->get_result()['rooms'];
		$content = new \stdClass();

		foreach ( $rooms as $room ) {
			$components_room        = new \stdClass();
			$components_room->id    = $room->ID;
			$components_room->price = $room->get_price();
			$components_room->guest = $room->get_guests();
			$components_room->name  = $room->get_name();
			$components_room->bed   = $room->get_bed();
			$components_room->size  = $room->get_size();

			$content->rooms[] = $components_room;
		}

		return $content;
	}
}
