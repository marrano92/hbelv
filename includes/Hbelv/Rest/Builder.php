<?php

namespace Hbelv\Rest;

use Hbelv\BuilderInterface;
use Hbelv\Proxy;
use Hbelv\Rest\V1\Search;

class Builder implements BuilderInterface {

	public static function init() {
		$options = options_factory();
		$proxy   = new Proxy( $options );

		Search::init( $proxy );
	}
}
