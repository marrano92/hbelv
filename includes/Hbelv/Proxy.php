<?php


namespace Hbelv;

class Proxy {

	/**
	 * Protected class vars
	 *
	 * @var Api $_api
	 * @var string $_vtype ,
	 * @var array $_result
	 * @var array $_filters
	 * @var array $_facets
	 * @var array $_slide_factes
	 */
	protected
		$_result = [],
		$_filters = [];

	/**
	 * Constructor
	 *
	 * @param Api $api
	 * @param array $filters
	 */
	public function __construct(array $filters = [] ) {
		$this->set_filters( $filters );
	}

	/**
	 * Sets filters
	 *
	 * @param array $filters
	 *
	 * @return static
	 */
	public function set_filters( $filters ) {
		if ( is_array( $filters ) ) {
			foreach ( $filters as $key => $value ) {
				if ( ! is_array( $value ) || ! is_object( $value ) ) {
					$this->_filters[ $key ] = array_map( 'rawurldecode', explode( '|', $value ) );
				}
			}
		}

		return $this;
	}
}