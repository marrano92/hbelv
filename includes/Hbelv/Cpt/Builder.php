<?php

namespace Hbelv\Cpt;

use Hbelv\BuilderInterface;

/**
 * Class CptBuilder
 *
 * @package Hbelv\Cpt
 */
class Builder implements BuilderInterface {

	/**
	 * @codeCoverageIgnore
	 */
	public static function init() {
			Menus::init();

		Model::init();
	}

}