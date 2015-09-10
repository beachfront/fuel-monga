<?php

namespace FuelMonga;

use \League\Monga;

class FuelMonga
{
	protected static $_instance;
	protected static $_defaultDSN;
	protected static $_defaultOptions;

	/**
	 * Initializes the default dsn and option values from the predefined configuration values.
	 *
	 * @throws \FuelException
	 */
	public static function _init()
	{
		\Config::load('db', true);
		$config = \Config::get('db.monga');
		static::setup_default($config);
	}

	/**
	 * Returns the instance of the Monga connection. If no instance of the instance is set then we create that instance,
	 * based off of the given values. If the user sends in an array with the dsn value set or the options value set then
	 * the instance will be recreated with the given config values.
	 *
	 * @param	array			$config		extra config array
	 * @return mixed
	 */
	public static function forge($config = array())
	{
		if (!isset(static::$_instance) || (array_key_exists("dsn", $config) || array_key_exists("options", $config))) {

			if (!isset(static::$_defaultDSN) || !isset(static::$_defaultOptions)) {
				static::_init();
			}

			$dsn = static::$_defaultDSN;
			$options = static::$_defaultOptions;

			if (isset($config['options'])) {
				$options = $config['options'];
			}

			if (isset($config['dsn'])) {
				$dsn = $config['dsn'];
			}

			static::$_instance = Monga::connection($dsn, $options);
		}
		return static::$_instance;
	}

	/**
	 * Returns the Monga instance. If the instance has not been created it will be forged.
	 *
	 * @return \Monga
	 */
	public static function instance()
	{
		if (!isset(self::$_instance)) {
			static::forge();
		}

		return static::$_instance;
	}

	/**
	 * Defines the default values for the dsn and options assocaited with Monga.
	 */
	protected static function setup_default($config)
	{
		if (!isset(static::$_defaultDSN) && array_key_exists('dsn', $config)) {
			static::$_defaultDSN = $config['dsn'];
		}

		if (!isset(static::$defaultOptions) && array_key_exists('options', $config)) {
			static::$_defaultOptions = $config['options'];
		}
	}
}