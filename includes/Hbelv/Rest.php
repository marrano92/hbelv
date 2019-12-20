<?php


namespace Hbelv;


abstract class Rest {
	/**
	 * Namespace
	 */
	protected $namespace = '';

	/**
	 * @var Proxy $endpoint
	 */
	protected $endpoint;

	/**
	 * @var ActionComponents $comp
	 */
	protected $comp;

	public function __construct( Proxy $endpoint ) {
		$this->endpoint = $endpoint;
	}

	/**
	 * Factory prepares callbacks
	 *
	 * @codeCoverageIgnore
	 *
	 * @param Proxy $endpoint
	 *
	 * @return static
	 */
	public static function init( Proxy $endpoint): Rest {
		$obj = new static( $endpoint );

		add_action( 'rest_api_init', [ $obj, 'rest_api_init' ] );

		return $obj;
	}

	/**
	 * Declare a set of WP's register_rest_route
	 *
	 * @return void
	 */
	abstract public function rest_api_init();

	/**
	 * @return string
	 */
	public function get_namespace() {
		return $this->namespace;
	}
}
