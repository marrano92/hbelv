<?php
/**
 * Rewrites
 */

namespace Hbelv;

/**
 * Class Rewrites
 * @package Hbelv
 */
class Rewrites {

	/**
	 * Protected class var
	 *
	 * @var PluginOptions $_options
	 */
	protected $_options;

	/**
	 * Private class var
	 *
	 * @var array $_routes
	 */
	private $_routes = [];

	/**
	 * Constructor
	 *
	 * @param PluginOptions $options
	 */
	public function __construct( PluginOptions $options ) {
		$this->_options = $options;
	}

	/**
	 * Creates the object and adds filter callbacks
	 *
	 * @codeCoverageIgnore
	 *
	 * @param PluginOptions $options
	 *
	 * @return Rewrites
	 */
	public static function init( PluginOptions $options ) {
		$obj = new self( $options );

		add_filter( 'query_vars', [ $obj, 'query_vars' ] );
		add_filter( 'request', [ $obj, 'request' ] );

		return $obj;
	}

	/**
	 * Adds a route to an internal container after a call to add_rewrite_rule and adds an dk/{class}::build_uri
	 * for every route
	 *
	 * @param Route $route
	 *
	 * @return Rewrites
	 */
	public function add( Route $route ) {
		$route->add_rewrite_rule( count( $this->_routes ) );

		$this->_routes[] = $route;

		return $this;
	}

	/**
	 * Filter: query vars
	 *
	 * @param $vars
	 *
	 * @return array
	 */
	public function query_vars( $vars ) {
		$arr = [ 'hbelv_route' ];

		return QueryVars::add( $vars, $arr );
	}

	/**
	 * Filter: request
	 *
	 * @param $request
	 *
	 * @return mixed
	 */
	public function request( $request ) {
		if ( isset( $request['hbelv_route'] ) ) {
			$endpoint = new Proxy( $this->_options, $_REQUEST );

			/**
			 * @var Route $route
			 */
			$route = $this->_routes[ $request['hbelv_route'] ];

			$route->add_hooks();
			$route->set_endpoints( $endpoint );
			$route->set_request( $request );

			Registry::create()->set( 'route', $route );
		}

		return $request;
	}
}
