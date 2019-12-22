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

	/**
	 * Setter
	 *
	 * @param $value
	 *
	 * @return $this
	 */
	protected function set( $value ) {
		$key = debug_backtrace()[1]['function'];

		if ( 'set_' == substr( $key, 0, 4 ) ) {
			$key = substr( $key, 4 );
		}

		$this->_result[ $key ] = $value;

		return $this;
	}

	/**
	 * @param array $arr
	 *
	 * @return $this
	 */
	public function set_rooms( array $arr ): self {
		return $this->set( $this->decorate_rooms( $arr ) );
	}

	/**
	 * Decorate_rooms
	 *
	 * @param array $arr
	 * @param string $decorator
	 *
	 * @return array
	 */
	protected function decorate_rooms( array $arr, $decorator = 'Hbelv\Decorator\DecoratorRooms' ) {
		$rooms = [];

		foreach ( $arr as $obj ) {
			$rooms[] = new $decorator( $obj );
		}

		return $rooms;
	}
}
