<?php

namespace Hbelv\Route;

use Hbelv\BuilderInterface;
use Hbelv\Proxy;
use Hbelv\Rewrites;

/**
 * Class RouteBuilder
 *
 * @package Hbelv\Route
 */
class Builder implements BuilderInterface {

	/**
	 * Route init
	 *
	 * @return void
	 */
	public static function init() {
		$options  = options_factory();
		$proxy    = new Proxy( $options );
		$rewrites = Rewrites::init( $options );

		$rewrites->add( new RoomSearch( $proxy ) );

		add_filter( 'hotel_route', function () {
			return \Hbelv\Registry::create()->get( 'route' );
		} );
	}

}
