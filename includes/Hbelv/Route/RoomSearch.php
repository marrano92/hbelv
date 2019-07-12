<?php


namespace Hbelv\Route;

use Hbelv\{Route};

class RoomSearch extends Route {


	public function get_data(){

		return new \stdClass();
	}

	public function add_rewrite_rule( int $position ){

	}

	/**
	 * Action: prints structured data into the head of a page
	 */
	public function wp_structured_data(){
		return '';
	}

	/**
	 * Filter: wp_title
	 *
	 * @return string
	 */
	public function wp_title(): string{
		return 'title';
	}

	/**
	 * Filter: Changes the meta description here
	 *
	 * @return string
	 */
	public function wp_description(): string {
		return 'description';
	}

	/**
	 * Filter: the_content
	 *
	 * @param string $content
	 *
	 * @return string
	 */
	public function the_content( string $content ): string {
		return 'content';
	}

}