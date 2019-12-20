<?php

namespace Hbelv\Rest;

use Hbelv\BuilderInterface;
use Hbelv\Proxy;

class Builder implements BuilderInterface {

	public static function init() {
		$options = options_factory();
		$proxy   = new Proxy( $options );


	}
}
