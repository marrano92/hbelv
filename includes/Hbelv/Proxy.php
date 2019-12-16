<?php


namespace Hbelv;

class Proxy {

	/**
	 * @var array
	 */
	protected
		$_result = [],
		$_filters = [];

	/**
	 * @var PluginOptions
	 */
	protected $options;

	/**
	 * Constructor
	 *
	 * @param PluginOptions $options
	 * @param array $filters
	 */
	public function __construct(PluginOptions $options,array $filters = [] ) {
		$this->options = $options;
		$this->set_filters( $filters );
	}

	public function get_options(){
		return $this->options;
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
