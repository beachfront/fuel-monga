<?php

namespace Monga;

class Monga
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
		if (!isset(static::$_instannce))
		{
			if (!isset($config['options']))
			{
				$config['options'] = [];
			}
			static::$_instance = new \League\Monga($config['server'], $config['options']);
		}
		return static::$_instance;
	}
}