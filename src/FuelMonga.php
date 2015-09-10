<?php

namespace FuelMonga;

use \League\Monga;

class FuelMonga
{
	protected static $_defaults;
	protected static $_instance;
	protected static $_defaultMongoClient;

	public static function _init()
	{
		\Config::load('db', true);
		$mongo_config = \Config::get('db.monga.default');
		static::mongoClient($mongo_config);
	}

	/**
	 * Forge
	 *
	 * @param	array			$config		extra config array
	 */
	public static function forge($config = array())
	{
		if (!isset(static::$_instance))
		{
			static::_init();
			if (!isset($config['options']))
			{
				$config['options'] = [];
			}
			if (!isset($config['server']))
			{
				$config['server'] = static::mongoClient();
			}
			static::$_instance = Monga::connection($config['server'], $config['options']);
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
		if (!isset(self::$_instance))
		{
			static::forge();
		}
		return static::$instance;
	}

	/**
	 * Creates the mongo client from your current configurations stored in fuelphp, if the mongo client has already
	 * been created it simply returns the current client.
	 *
	 * @return \MongoClient
	 */
	protected static function mongoClient($config = array())
	{
		if (!isset(static::$_defaultMongoClient))
		{
			$mongo_config = $config;
			$mongo_client_string = 'mongodb://';

			foreach ($mongo_config['connections'] as $index => $connection)
			{
				if ($index > 0)
				{
					$mongo_client_string .= ',';
				}

				if (isset($connection['username']) && isset($connection['password']))
				{
					$mongo_client_string .= $connection['username'] . '@' . $connection['password'];
				}

				$mongo_client_string .= $connection['dsn'];
			}

			static::$_defaultMongoClient = new \MongoClient($mongo_client_string);
		}

		return static::$_defaultMongoClient;
	}
}