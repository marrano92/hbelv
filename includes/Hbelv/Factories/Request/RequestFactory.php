<?php

namespace Hbelv\Factories\Request;

use Hbelv\PluginOptions;
use Hbelv\Result\RouteRequest\RoomSearchRequest;
use Hbelv\Route;

class RequestFactory implements FactoryInterface {

	/**
	 * @var object
	 */
	protected $request;


	/**
	 * BotFactory constructor.
	 *
	 * @param Route $route
	 * @param PluginOptions $options
	 */
	public function __construct( Route $route, PluginOptions $options ) {
		$this->set_route( $route, $options );
	}

	/**
	 * Get the logger wrapper
	 *
	 * @return mixed
	 */
	public function get_request() {
		return $this->request;
	}

	/**
	 * @inheritDoc
	 */
	protected function set_route( Route $route, PluginOptions $options ) {
		switch ( $route->get_type() ) {
			case 'RoomSearch':
				$this->request = ( new RoomSearchRequest( $options, $route ) )->request();
				break;
		}

		return $this;
	}

}
