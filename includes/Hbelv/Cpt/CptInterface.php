<?php

namespace Hbelv\Cpt;

/**
 * Interface CptInterface
 * @package Hbelv\Cpt
 */
interface CptInterface {

	/**
	 * @return CptInterface
	 */
	public function register_post_type(): CptInterface;

}