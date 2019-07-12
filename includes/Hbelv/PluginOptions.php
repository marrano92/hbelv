<?php


namespace Hbelv;


class PluginOptions {

	/**
	 * Factory
	 *
	 * @codeCoverageIgnore
	 *
	 * @param Locale $locale
	 * @param string $options_name
	 * @param array $default_values
	 *
	 * @return PluginOptions
	 */
	public static function create( Locale $locale, $options_name = 'hbelv_options', $default_values = [] ) {
		$registry = Registry::create();
		$object   = $registry->get( __CLASS__ );

		if ( ! $object ) {
			if ( empty( $default_values ) ) {

				$default_values = [
					'plugin_lang'               => $locale->get_language(),
					'results_per_page'       => '12',
				];

			}

			$object = new self( $locale, $options_name, $default_values );

			$registry->set( __CLASS__, $object );

			add_action( 'dkwp/set_plugin_option', [ $object, 'set' ], 10, 2 );
			add_filter( 'drivek_plugin_options', [ $object, 'get' ], 10, 2 );
		}

		return $object;
	}
}