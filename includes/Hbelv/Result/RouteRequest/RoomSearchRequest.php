<?php

namespace Hbelv\Result\RouteRequest;

use Hbelv\PluginOptions;
use Hbelv\Route;

class RoomSearchRequest {
	/**
	 * @var Route
	 */
	protected $route;

	/**
	 * @var PluginOptions
	 */
	protected $options;

	/**
	 * RoomSearchRequest constructor.
	 *
	 * @param PluginOptions $options
	 * @param Route $route
	 */
	public function __construct( PluginOptions $options, Route $route ) {
		$this->route   = $route;
		$this->options = $options;
	}

	/**
	 *
	 * @return string
	 */
	public function request() {
		// TODO: Implement __invoke() method.
		return '<h2>CAIOOOOOOOOOOOOOOOOOOOOOOOOOOO</h2>';
	}

}
