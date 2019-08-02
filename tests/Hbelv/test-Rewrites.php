<?php

namespace Hbelv\Tests\Hbelv;

use Hbelv\Tests\HBELV_Framework_TestCase;

/**
 * Class Rewrites
 */
class Rewrites extends HBELV_Framework_TestCase {

	public function get_test() {
		\WP_Mock::passthruFunction('add_filter');

		$plugin_option = $this->get_options();

		return new \Hbelv\Rewrites( $plugin_option );
	}

	public function test_init(){
		$test = $this->get_test();
		$plugin_option = $this->get_options();

		$this->assertInstanceOf(\Hbelv\Rewrites::class, $test->init($plugin_option) );
	}
}