<?php

namespace FuelMonga;

use \League\Monga;

class MongaWrapper
{
	protected static $_defaults;
	protected static $_instance;
	/**
	 * Forge
	 *
	 * @param	array			$config		extra config array
	 */
	public static function forge($config = array())
	{
		if (!isset(static::$_instance))
		{
			if (!isset($config['options']))
			{
				$config['options'] = [];
			}
			static::$_instance = Monga::connection($config['server'], $config['options']);
		}
		return static::$_instance;
	}
}