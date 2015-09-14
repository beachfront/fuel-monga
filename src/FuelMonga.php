<?php

namespace FuelMonga;

use \League\Monga;

class FuelMonga
{
	const MAX_CONNECTION_RETRY_COUNT = 3;
	const CANNOT_CONNECT_EXCEPTION = "Cannot connect to the MongoClient currently. Please check that your system is running.";

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
			try {
				static::$_instance = static::get_connection($dsn, $options);
			} catch (\Exception $e) {
				\Log::error('Exception thrown: (' . __FILE__ . '#' . __LINE__ . '): ' . $e->getMessage());
			}
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

	/**
	 * Goes and try's to create a connection to the MongoClient through the Monga Connection class. If a connection
	 * cannot be made it tries to attempt a new connection until it has reached its maximum retry's. If this is the
	 * case the function throws an exception stating that it cannot currently connect to the MongoDB Client. This code
	 * is based off of an issue in the PHP Legacy driver, issue PHP-854. The URL to that issue is:
	 *
	 * 		https://jira.mongodb.org/browse/PHP-854
	 *
	 * The workaround to the issue was posted on Nov 14 2013 07:21:18 PM GMT+0000 by Hannes Magnusson.
	 *
	 * @param 	string 			$dsn		The Information for what mongo client(s) to connect to.
	 * @param   array 			$options    All of the options for creating the MongoClient
	 * @param   int				$retry		How many times we should try and retry creating a connection
	 * @return  \Monga\Connection			The connection for the Monga object.
	 * @throws \Exception
	 */
	protected static function get_connection($dsn, $options, $retry = self::MAX_CONNECTION_RETRY_COUNT)
	{
		try {
			$instance = Monga::connection($dsn, $options);
			return $instance;
		} catch (\Exception $e) {
			\Log::error('Exception thrown: (' . __FILE__ . '#' . __LINE__ . '): ' . $e->getMessage());
		}

		if ($retry > 0) {
			return static::get_connection($dsn, $options, $retry);
		} else {
			throw new \Exception(self::CANNOT_CONNECT_EXCEPTION);
		}
	}
}